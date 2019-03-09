<?php

namespace App\Http\Controllers;

use App\Accounts;
use App\CustomerRegistration;
use App\ProductRegistration;
use App\SaleReturn;
use App\SaleReturnInvoiceImages;
use App\SaleReturnProduct;
use App\TransactionTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;
use PDF;

class SaleReturnController extends Controller
{

    public function getCost($id){

        $slePrice = ProductRegistration::where('id', $id)->pluck('slae_price');
        return response()->json($slePrice);

    }

    public function view($id){
        $saleMas = SaleReturn::where('id', $id)->first();
        $cusName = Accounts::where('id', $saleMas->cus_name)->first();
        $saleMasPros = SaleReturnProduct::where('sale_return_id',$id)->get();
        return view( 'dashboard.admin-panel.saleReturn.view', [ 'saleMasPros'=>$saleMasPros, 'cusName'=>$cusName, 'saleMas' => $saleMas ] );

    }

    public function downloadPDF($id){
        $saleMas = SaleReturn::find($id);
        $cusName = Accounts::where('id', $saleMas->cus_name)->first();
        $saleMasPros = SaleReturnProduct::where('sale_return_id',$id)->get();

        $pdf = PDF::loadView('dashboard.admin-panel.saleReturn.pdf', compact('saleMas', 'cusName', 'saleMasPros'));
        return $pdf->stream('invoice.pdf');

    }

    public function index()
    {
        $saleMas = DB::table('sale_returns')
            ->leftJoin('accounts', 'sale_returns.cus_name', '=', 'accounts.id')
            ->select('sale_returns.*', 'accounts.name as cusName')
            ->get();
        return view( 'dashboard.admin-panel.saleReturn.index', [ 'saleMas' => $saleMas ] );

    }

    public function create()
    {
        //
        $products = ProductRegistration::get();
//        $products = DB::table('purchase_master_product_tables')->select('id','item')->distinct('item')->get();
        $cusRegis = CustomerRegistration::select('id', 'name')->get();
        return view( 'dashboard.admin-panel.saleReturn.new', [ 'products'=>$products, 'cusRegis'=>$cusRegis ] );
    }

    public function store(Request $request)
    {
        //


        $rules = [
            'date'    =>  'required|max:25',
            'cus_invoice_no'     =>  'required|max:25',
            'cus_name'       =>  'required|max:25',
            'gross_total'   =>  'required|max:300',
            'discount'   =>  'max:300',
            'net_total'   =>  'required|max:300',
            'paid_amount'   =>  'required|max:300',
            'bal_amount'   =>  'required|max:300',
        ];

        $messages = [
            'date.required'    =>  'Please Select Date!.',
            'cus_invoice_no.required'     =>  'Please enter your Supplier Invoice Number!.',
            'cus_name.required'       =>  'Please enter Supplier Name',
            'gross_total.required'   =>  'Please enter Gross Total!.',
            'net_total.required'   =>  'Please enter Net Total!.',
            'paid_amount.required'   =>  'Please enter Paid Amount!.',
            'bal_amount.required'   =>  'Please Balance Amount!.',
        ];

        $this->validate($request, $rules, $messages);
        
        $saleMas = new SaleReturn();
        $saleMas->date = date( 'Y-m-d', strtotime($request->input('date')) );
        $saleMas->cus_invoice_no = $request->input('cus_invoice_no');
        $saleMas->cus_name = $request->input('cus_name');
        $saleMas->gross_total = $request->input('gross_total');
        $saleMas->discount = $request->input('discount');
        $saleMas->net_total = $request->input('net_total');
        $saleMas->paid_amount = $request->input('paid_amount');
        $saleMas->bal_amount = $request->input('bal_amount');
        $saleMas->detail = $request->input('detail');
        $saleMas->save();

        if( $request->has('item') ){
            $product = array(
                'item' => $request->get('item'),
                'quantity' => $request->get('quantity'),
                'sale_price' => $request->get('sale_price'),
                'per_item_dis' => $request->get('per_item_dis'),
                'total' => $request->get('total'),
            );
            $x = 0;
            foreach( $request->get('item') as $key=>$item ){
                $productTable = new SaleReturnProduct();
                $productTable->sale_return_id = $saleMas->id;
                $productTable->item = $product['item'][$key];
                $productTable->quantity = $product['quantity'][$key];
                $productTable->cost_price = $product['sale_price'][$key];
                $productTable->per_item_dis = $product['per_item_dis'][$key];
                $productTable->total = $product['total'][$key];
                $productTable->save();
                $x++;
            }

        }

        if( $request->hasFile('image') ) {

            foreach( $request->image as $key=>$image ) {
                $purMasInvoiceImage = new saleReturnInvoiceImages();
                $apk_file =  $image;
                $ext = $apk_file->extension();
                $name = uniqid();
                $imageName = $name . '.' . $ext;
                $s_path = 'uploads/saleReturnInvoiceImage/s';
                $m_path = 'uploads/saleReturnInvoiceImage/m';
                if (!file_exists($s_path))
                    mkdir($s_path, 777, true);
                if (!file_exists($m_path))
                    mkdir($m_path, 777, true);
                Image::make($apk_file)->resize(100, 60)->save($s_path . '/' . $imageName);
                Image::make($apk_file)->resize(220, 220)->save($m_path . '/' . $imageName);
                $apk_file->move( 'uploads/saleReturnInvoiceImage', $imageName);
                $purMasInvoiceImage->image = $imageName;
                $purMasInvoiceImage->sale_return_id = $saleMas->id;
                $purMasInvoiceImage->save();
            }

        }

//            dd($request->supplier_name);
        $supplier = CustomerRegistration::where("id", $request->cus_name)->first();
        $accountId = Accounts::where('name', $supplier->name)->first();

        $params['account_id'] = $accountId->id;
        $params['date'] = date( 'Y-m-d', strtotime($request->date));
        $params['detail'] = 'Sale Products to '.$supplier->name.'. Stock Going to Cr. with '.$request->net_total.'Rs/-. and Customer going to Dr. with '.$request->net_total.'Rs/-.';
        $params['dr'] = $request->net_total;
        $params['cr'] = $request->net_total;
        $params['voucher_type'] = 'customer';
        $params['purchase_invoice'] = $saleMas->id;
        TransactionTable::firstOrCreate($params);


        Session::flash("Success", "Purchase Master item successfully created!.");


        return redirect('/dashboard/sale-return');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
        $products = ProductRegistration::get();
        $saleMas = SaleReturn::find($id);
        $saleMasPros = SaleReturnProduct::where('sale_return_id',$id)->get();
        $saleMasImages = SaleReturnInvoiceImages::where('sale_return_id',$id)->get();
        $supplierRegis = CustomerRegistration::select('id', 'name')->get();
        return view( 'dashboard.admin-panel.saleReturn.edit', [ 'products'=>$products, 'saleMas'=>$saleMas, 'saleMasPros'=>$saleMasPros, 'saleMasImages'=>$saleMasImages, 'supplierRegis'=>$supplierRegis ] );

    }

    public function update(Request $request, $id)
    {

        $rules = [
            'date'    =>  'required|max:25',
            'cus_invoice_no'     =>  'required|max:25',
            'cus_name'       =>  'required|max:25',
            'gross_total'   =>  'required|max:300',
            'discount'   =>  'max:300',
            'net_total'   =>  'required|max:300',
            'paid_amount'   =>  'required|max:300',
            'bal_amount'   =>  'required|max:300',
        ];

        $messages = [
            'date.required'    =>  'Please Select Date!.',
            'cus_invoice_no.required'     =>  'Please enter your Customer Invoice Number!.',
            'cus_name.required'       =>  'Please enter Customer Name',
            'gross_total.required'   =>  'Please enter Gross Total!.',
            'net_total.required'   =>  'Please enter Net Total!.',
            'paid_amount.required'   =>  'Please enter Paid Amount!.',
            'bal_amount.required'   =>  'Please Balance Amount!.',
        ];

        $this->validate($request, $rules, $messages);

        $saleMas = SaleReturn::find($id);
        $saleMas->date = date( 'Y-m-d', strtotime($request->input('date')) );
        $saleMas->cus_invoice_no = $request->input('cus_invoice_no');
        $saleMas->cus_name = $request->input('cus_name');
        $saleMas->gross_total = $request->input('gross_total');
        $saleMas->discount = $request->input('discount');
        $saleMas->net_total = $request->input('net_total');
        $saleMas->paid_amount = $request->input('paid_amount');
        $saleMas->bal_amount = $request->input('bal_amount');
        $saleMas->detail = $request->input('detail');

        if( $request->has('item') ){
            $product = array(
                'item' => $request->get('item'),
                'quantity' => $request->get('quantity'),
                'sale_price' => $request->get('sale_price'),
                'per_item_dis' => $request->get('per_item_dis'),
                'total' => $request->get('total'),
            );
            $x = 0;
            foreach( $request->get('item') as $key=>$item ){
                $productTable = SaleReturnProduct::findOrNew($key);
//                dd($product);
                $productTable->sale_return_id = $saleMas->id;
                $productTable->item = $product['item'][$key];
                $productTable->quantity = $product['quantity'][$key];
                $productTable->cost_price = $product['sale_price'][$key];
                $productTable->per_item_dis = $product['per_item_dis'][$key];
                $productTable->total = $product['total'][$key];
                $productTable->save();
                $x++;
            }

        }

        
        
        if( $request->hasFile('image') ) {

            foreach( $request->image as $key=>$image ) {
                $purMasInvoiceImage = SaleReturnInvoiceImages::findOrNew($key);
                $apk_file =  $image;
                $ext = $apk_file->extension();
                $name = uniqid();
                $imageName = $name . '.' . $ext;
                $s_path =  'uploads/saleReturnInvoiceImage/s';
                $m_path =  'uploads/saleReturnInvoiceImage/m';
                if (!file_exists($s_path))
                    mkdir($s_path, 0777, true);
                if (!file_exists($m_path))
                    mkdir($m_path, 0777, true);
                Image::make($apk_file)->resize(100, 60)->save($s_path . '/' . $imageName);
                Image::make($apk_file)->resize(220, 220)->save($m_path . '/' . $imageName);
                $apk_file->move( 'uploads/saleReturnInvoiceImage', $imageName);
                $purMasInvoiceImage->image = $imageName;
                $purMasInvoiceImage->sale_return_id = $saleMas->id;
                $purMasInvoiceImage->save();
            }

        }

        if( $saleMas->update() ) {

//            dd($request->supplier_name);
            $supplier = CustomerRegistration::where("id", $request->cus_name)->first();
            $accountId = Accounts::where('name', $supplier->name)->first();

            $params['account_id'] = $accountId->id;
            $params['date'] = date( 'Y-m-d', strtotime($request->date));
            $params['detail'] = 'Sale Products to '.$supplier->name.'. Stock Going to Cr. with '.$request->net_total.'Rs/-. and Customer going to Dr. with '.$request->net_total.'Rs/-.';
            $params['dr'] = $request->net_total;
            $params['cr'] = $request->net_total;
            $params['voucher_type'] = 'customer';
            $params['purchase_invoice'] = $saleMas->id;
            TransactionTable::firstOrCreate($params);


            Session::flash("Success", "Sales Return items successfully updated!.");

        }
        return redirect('/dashboard/sale-return');

    }

    public function destroy($id)
    {
        //
        $saleMas = SaleReturn::find($id);
        $saleMas->delete();
        $saleMasPros = SaleReturnProduct::where('sale_return_id',$id)->delete();
        $saleMasImages = SaleReturnInvoiceImages::where('sale_return_id',$id)->get();
        foreach( $saleMasImages as $saleMasImage ) {
            if (\File::exists(public_path('uploads/saleReturnInvoiceImage/m/' . $saleMasImage->image))) {
                \File::delete(public_path('uploads/saleReturnInvoiceImage/m/' . $saleMasImage->image));
                \File::delete(public_path('uploads/saleReturnInvoiceImage/s/' . $saleMasImage->image));
                \File::delete(public_path('uploads/saleReturnInvoiceImage/' . $saleMasImage->image));
            }
            $saleMasImage->delete();
        }
        return redirect('/dashboard/sale-return');

    }

    public function productDel(Request $request)
    {
        SaleReturnProduct::where('id',$request->proId)->delete();

    }

    
}
