<?php

namespace App\Http\Controllers;

use App\Accounts;
use App\ProductRegistration;
use App\PurchaseReturn;
use App\PurchaseReturnInvoiceImages;
use App\PurchaseReturnProducts;
use App\SupplyRegistration;
use App\TransactionTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;
use PDF;

class PurchaseReturnController extends Controller
{

    public function view(Request $request){
        $purchaseMas = PurchaseReturn::where('id', trim($request->id, '"'))->first();
        $supplierName = SupplyRegistration::where('id', $purchaseMas->supplier_name)->first();
        $purchaseMasPros = PurchaseReturnProducts::where('pur_return_id',trim($request->id, '"'))->get();
        return view( 'dashboard.admin-panel.purchaseReturn.view', [ 'purchaseMasPros'=>$purchaseMasPros, 'supplierName'=>$supplierName, 'purchaseMas' => $purchaseMas ] );

    }


    public function downloadPDF($id){
        $purchaseMas = PurchaseReturn::find($id);
        $supplierName = SupplyRegistration::where('id', $purchaseMas->supplier_name)->first();
        $purchaseMasPros = PurchaseReturnProducts::where('pur_return_id',$id)->get();

        $pdf = PDF::loadView('dashboard.admin-panel.purchaseReturn.pdf', compact('purchaseMas', 'supplierName', 'purchaseMasPros'));
        return $pdf->stream('invoice.pdf');

    }

    public function index()
    {
        $purchaseMas = DB::table('purchase_returns')
            ->leftJoin('supply_registrations', 'purchase_returns.supplier_name', '=', 'supply_registrations.id')
            ->select('purchase_returns.*', 'supply_registrations.name as supplierName')
            ->get();
        return view( 'dashboard.admin-panel.purchaseReturn.index', [ 'purchaseMas' => $purchaseMas ] );

    }

    public function create()
    {
        //
        $products = ProductRegistration::get();
        $supplierRegis = SupplyRegistration::select('id', 'name')->get();
        return view( 'dashboard.admin-panel.purchaseReturn.new', [ 'products'=>$products, 'supplierRegis'=>$supplierRegis ] );
    }

    public function store(Request $request)
    {
        //

        $rules = [
            'date'    =>  'required|max:25',
            'supplier_invoice_no'     =>  'required|max:25',
            'supplier_name'       =>  'required|max:25',
            'cargo'   =>  'max:300',
            'gross_total'   =>  'required|max:300',
            'discount'   =>  'max:300',
            'cargo_charges'   =>  'max:300',
            'net_total'   =>  'required|max:300',
            'paid_amount'   =>  'required|max:300',
            'bal_amount'   =>  'required|max:300',
        ];

        $messages = [
            'date.required'    =>  'Please Select Date!.',
            'supplier_invoice_no.required'     =>  'Please enter your Supplier Invoice Number!.',
            'supplier_name.required'       =>  'Please enter Supplier Name',
            'cargo.required'   =>  'please select Cargo!.',
            'gross_total.required'   =>  'Please enter Gross Total!.',
            'cargo_charges.required'   =>  'Please enter Cargo Charges!.',
            'net_total.required'   =>  'Please enter Net Total!.',
            'paid_amount.required'   =>  'Please enter Paid Amount!.',
            'bal_amount.required'   =>  'Please Balance Amount!.',
        ];

        $this->validate($request, $rules, $messages);

        $purchaseMas = new PurchaseReturn();

        if( $request->has('date') ){
            $purchaseMas->date = date( 'Y-m-d', strtotime($request->input('date')) );
        }

        if( $request->has('supplier_invoice_no') ){
            $purchaseMas->supplier_invoice_no = $request->input('supplier_invoice_no');
        }

        if( $request->has('supplier_name') ){
            $purchaseMas->supplier_name = $request->input('supplier_name');
        }

        if( $request->has('cargo') ){
            $purchaseMas->cargo = $request->input('cargo');
        }

        if( $request->has('gross_total') ){
            $purchaseMas->gross_total = $request->input('gross_total');
        }

        if( $request->has('discount') ){
            $purchaseMas->discount = $request->input('discount');
        }

        if( $request->has('cargo_charges') ){
            $purchaseMas->cargo_charges = $request->input('cargo_charges');
        }

        if( $request->has('net_total') ){
            $purchaseMas->net_total = $request->input('net_total');
        }

        if( $request->has('paid_amount') ){
            $purchaseMas->paid_amount = $request->input('paid_amount');
        }

        if( $request->has('bal_amount') ){
            $purchaseMas->bal_amount = $request->input('bal_amount');
        }
        $purchaseMas->detail = $request->input('detail');
        $purchaseMas->save();

        if( $request->has('item') ){
            $product = array(
                'item' => $request->get('item'),
                'quantity' => $request->get('quantity'),
                'cost_price' => $request->get('cost_price'),
                'per_item_dis' => $request->get('per_item_dis'),
                'total' => $request->get('total'),
            );
            $x = 0;
            foreach( $request->get('item') as $item ){
                $productTable = new PurchaseReturnProducts();
                $productTable->pur_return_id = $purchaseMas->id;
                $productTable->item = $product['item'][$x];
                $productTable->quantity = $product['quantity'][$x];
                $productTable->cost_price = $product['cost_price'][$x];
                $productTable->per_item_dis = $product['per_item_dis'][$x];
                $productTable->total = $product['total'][$x];
                $productTable->save();
                $x++;
            }
        }

        if( $request->hasFile('image') ) {

            foreach( $request->image as $image ) {
                $purMasInvoiceImage = new PurchaseReturnInvoiceImages();
                $apk_file =  $image;
                $ext = $apk_file->extension();
                $name = uniqid();
                $imageName = $name . '.' . $ext;
                $s_path =  'uploads/purReturnInvoiceImage/s';
                $m_path =  'uploads/purReturnInvoiceImage/m';
                if (!file_exists($s_path))
                    mkdir($s_path, 777, true);
                if (!file_exists($m_path))
                    mkdir($m_path, 777, true);
                Image::make($apk_file)->resize(100, 60)->save($s_path . '/' . $imageName);
                Image::make($apk_file)->resize(220, 220)->save($m_path . '/' . $imageName);
                $apk_file->move( 'uploads/purReturnInvoiceImage', $imageName);
                $purMasInvoiceImage->image = $imageName;
                $purMasInvoiceImage->pur_return_invoice_img_id = $purchaseMas->id;
                $purMasInvoiceImage->save();
            }

        }





        $supplier = SupplyRegistration::where("id", $request->input('supplier_name'))->first();
        $accountId = Accounts::where('name', $supplier->name)->first();
        $params['account_id'] = $accountId->id;
        $params['date'] = date( 'Y,m,d', strtotime($request->date));
        $params['detail'] = 'Purchase Products from '.$supplier->name.'. Stock Going to Dr. with '.$request->has('net_total').'Rs/-. and Supplier going to Cr. with '.$request->has('net_total').'Rs/-.';
        $params['dr'] = $request->has('net_total');
        $params['cr'] = $request->has('net_total');
        $params['voucher_type'] = 'supplier';
        $params['purchase_invoice'] = $purchaseMas->id;
        TransactionTable::create(
            $params
        );

        Session::flash("Success","Purchase Return item successfully register!.");
        return redirect('/dashboard/purchase-return');

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
        $products = ProductRegistration::get();
        $purchaseMas = PurchaseReturn::find($id);
        $purchaseMasPros = PurchaseReturnProducts::where('pur_return_id',$id)->get();
        $purchaseMasImages = PurchaseReturnInvoiceImages::where('pur_return_invoice_img_id',$id)->get();
        $supplierRegis = SupplyRegistration::select('id', 'name')->get();
        return view( 'dashboard.admin-panel.purchaseReturn.edit', [ 'products'=>$products, 'purchaseMas'=>$purchaseMas, 'purchaseMasPros'=>$purchaseMasPros, 'purchaseMasImages'=>$purchaseMasImages, 'supplierRegis'=>$supplierRegis ] );

    }

    public function update(Request $request, $id)
    {
        $rules = [
            'date'    =>  'required|max:25',
            'supplier_invoice_no'     =>  'required|max:25',
            'supplier_name'       =>  'required|max:25',
            'cargo'   =>  'max:300',
            'gross_total'   =>  'required|max:300',
            'discount'   =>  'max:300',
            'cargo_charges'   =>  'max:300',
            'net_total'   =>  'required|max:300',
            'paid_amount'   =>  'required|max:300',
            'bal_amount'   =>  'required|max:300',
        ];

        $messages = [
            'date.required'    =>  'Please Select Date!.',
            'supplier_invoice_no.required'     =>  'Please enter your Supplier Invoice Number!.',
            'supplier_name.required'       =>  'Please enter Supplier Name',
            'cargo.required'   =>  'please select Cargo!.',
            'gross_total.required'   =>  'Please enter Gross Total!.',
            'cargo_charges.required'   =>  'Please enter Cargo Charges!.',
            'net_total.required'   =>  'Please enter Net Total!.',
            'paid_amount.required'   =>  'Please enter Paid Amount!.',
            'bal_amount.required'   =>  'Please Balance Amount!.',
        ];

        $this->validate($request, $rules, $messages);

        $purchaseMas = PurchaseReturn::find($id);

        if( $request->has('date') ){
            $purchaseMas->date = date( 'Y-m-d', strtotime($request->input('date')) );
        }

        if( $request->has('supplier_invoice_no') ){
            $purchaseMas->supplier_invoice_no = $request->input('supplier_invoice_no');
        }

        if( $request->has('supplier_name') ){
            $purchaseMas->supplier_name = $request->input('supplier_name');
        }

        if( $request->has('cargo') ){
            $purchaseMas->cargo = $request->input('cargo');
        }

        if( $request->has('gross_total') ){
            $purchaseMas->gross_total = $request->input('gross_total');
        }

        if( $request->has('discount') ){
            $purchaseMas->discount = $request->input('discount');
        }

        if( $request->has('cargo_charges') ){
            $purchaseMas->cargo_charges = $request->input('cargo_charges');
        }

        if( $request->has('net_total') ){
            $purchaseMas->net_total = $request->input('net_total');
        }

        if( $request->has('paid_amount') ){
            $purchaseMas->paid_amount = $request->input('paid_amount');
        }

        if( $request->has('bal_amount') ){
            $purchaseMas->bal_amount = $request->input('bal_amount');
        }
        $purchaseMas->detail = $request->input('detail');

        if( $request->has('item') ){
            $product = array(
                'item' => $request->get('item'),
                'quantity' => $request->get('quantity'),
                'cost_price' => $request->get('cost_price'),
                'per_item_dis' => $request->get('per_item_dis'),
                'total' => $request->get('total'),
            );
            $x = 0;
            foreach( $request->get('item') as $key=>$item ){
                $productTable = PurchaseReturnProducts::findOrNew($key);
//                dd($item);
                $productTable->pur_return_id = $purchaseMas->id;
                $productTable->item = $product['item'][$key];
                $productTable->quantity = $product['quantity'][$key];
                $productTable->cost_price = $product['cost_price'][$key];
                $productTable->per_item_dis = $product['per_item_dis'][$key];
                $productTable->total = $product['total'][$key];
                $productTable->save();
                $x++;
            }

        }

        if( $request->hasFile('image') ) {

            foreach( $request->image as $key=>$image ) {
                $purMasInvoiceImage = PurchaseReturnInvoiceImages::findOrNew($key);
                $apk_file =  $image;
                $ext = $apk_file->extension();
                $name = uniqid();
                $imageName = $name . '.' . $ext;
                $s_path =  'uploads/purReturnInvoiceImage/s';
                $m_path =  'uploads/purReturnInvoiceImage/m';
                if (!file_exists($s_path))
                    mkdir($s_path, 777, true);
                if (!file_exists($m_path))
                    mkdir($m_path, 777, true);
                Image::make($apk_file)->resize(100, 60)->save($s_path . '/' . $imageName);
                Image::make($apk_file)->resize(220, 220)->save($m_path . '/' . $imageName);
                $apk_file->move( 'uploads/purReturnInvoiceImage', $imageName);
                $purMasInvoiceImage->image = $imageName;
                $purMasInvoiceImage->pur_return_invoice_img_id = $purchaseMas->id;
                $purMasInvoiceImage->save();
            }

        }

        if( $purchaseMas->update() ) {

//            dd($request->supplier_name);
            $supplier = SupplyRegistration::where("id", $request->supplier_name)->first();
            $accountId = Accounts::where('name', $supplier->name)->first();
            $params['account_id'] = $accountId->id;
            $params['date'] = date( 'Y,m,d', strtotime($request->date));
            $params['detail'] = 'Purchase Products from '.$supplier->name.'. Stock Going to Dr. with '.$request->net_total.'Rs/-. and Supplier going to Cr. with '.$request->net_total.'Rs/-.';
            $params['dr'] = $request->net_total;
            $params['cr'] = $request->net_total;
            $params['voucher_type'] = 'supplier';
            $params['purchase_invoice'] = $purchaseMas->id;
            TransactionTable::firstOrCreate($params);
//            $transaction->update();




            Session::flash("Success", "Purchase Return item successfully updated!.");
        }
        return redirect('/dashboard/purchase-return');

    }

    public function destroy($id)
    {
        //
        $purchaseMas = PurchaseReturn::find($id);
        $purchaseMas->delete();
        $purchaseMasPros = PurchaseReturnProducts::where('pur_return_id',$id)->delete();
        $purchaseMasImages = PurchaseReturnInvoiceImages::where('pur_return_invoice_img_id',$id)->get();
        foreach( $purchaseMasImages as $purchaseMasImage ) {
            if (\File::exists(public_path('uploads/purReturnInvoiceImage/m/' . $purchaseMasImage->image))) {
                \File::delete(public_path('uploads/purReturnInvoiceImage/m/' . $purchaseMasImage->image));
                \File::delete(public_path('uploads/purReturnInvoiceImage/s/' . $purchaseMasImage->image));
                \File::delete(public_path('uploads/purReturnInvoiceImage/' . $purchaseMasImage->image));
            }
            $purchaseMasImage->delete();
        }
        return redirect('/dashboard/purchase-return');

    }


    public function productDel(Request $request)
    {
        PurchaseReturnProducts::where('id',$request->proId)->delete();

    }
}
