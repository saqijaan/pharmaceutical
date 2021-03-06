<?php

namespace App\Http\Controllers;

use PDF;
use Exception;
use App\Accounts;
use App\PurchaseMaster;
use App\TransactionTable;
use App\SupplyRegistration;
use App\ProductRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\PurchaseMasterProductTable;
use Illuminate\Support\Facades\Session;
use App\PurchaseMasterInvoiceImageTable;
use Intervention\Image\ImageManagerStatic as Image;

class PurchaseMasterController extends Controller
{

    public function getCost(Request $request){

        $slePrice = ProductRegistration::where('id', $request->id)->pluck('cost_price');
//        dd($slePrice);
        return response()->json($slePrice);
    }
    
    
    public function view(Request $request){
        $purchaseMas = PurchaseMaster::where('id', trim($request->id, '"'))->first();
        $supplierName = SupplyRegistration::where('id', $purchaseMas->supplier_name)->first();
        $purchaseMasPros = PurchaseMasterProductTable::where('pur_mas_id',trim($request->id, '"'))->get();
        return view( 'dashboard.admin-panel.purchaseMaster.view', [ 'purchaseMasPros'=>$purchaseMasPros, 'supplierName'=>$supplierName, 'purchaseMas' => $purchaseMas ] );

    }


    public function downloadPDF($id){
        $purchaseMas = PurchaseMaster::find($id);
        $supplierName = SupplyRegistration::where('id', $purchaseMas->supplier_name)->first();
        $purchaseMasPros = PurchaseMasterProductTable::where('pur_mas_id',$id)->get();

        $pdf = PDF::loadView('dashboard.admin-panel.purchaseMaster.pdf', compact('purchaseMas', 'supplierName', 'purchaseMasPros'));
        return $pdf->stream('invoice.pdf');

    }


    public function index()
    {
        $purchaseMas = DB::table('purchase_masters')
                        ->leftJoin('supply_registrations', 'purchase_masters.supplier_name', '=', 'supply_registrations.id')
                        ->select('purchase_masters.*', 'supply_registrations.name as supplierName')
                        ->get();
        return view( 'dashboard.admin-panel.purchaseMaster.index', [ 'purchaseMas' => $purchaseMas ] );

    }

    public function create()
    {
        //
        $products = ProductRegistration::get();
        $supplierRegis = SupplyRegistration::select('id', 'name')->get();
        return view( 'dashboard.admin-panel.purchaseMaster.new', [ 'products'=>$products, 'supplierRegis'=>$supplierRegis ] );
    }

    public function store(Request $request)
    {
        //

        $rules = [
            'date'    =>  'required|max:25',
            'supplier_invoice_no'     =>  'required|max:25',
            'supplier_name'       =>  'required|max:25',
            'cargo'   =>  'required|max:300',
            'gross_total'   =>  'required|max:300',
            'discount'   =>  'max:300',
            'cargo_charges'   =>  'required|max:300',
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

        try{
            DB::transaction(function () use($request){

                $purchaseMas = new PurchaseMaster();
                $purchaseMas->date = date( 'Y-m-d', strtotime($request->input('date')) );
                $purchaseMas->supplier_invoice_no = $request->input('supplier_invoice_no');
                $purchaseMas->supplier_name = $request->input('supplier_name');
                $purchaseMas->cargo = $request->input('cargo');
                $purchaseMas->gross_total = $request->input('gross_total');
                $purchaseMas->discount = $request->input('discount');
                $purchaseMas->cargo_charges = $request->input('cargo_charges');
                $purchaseMas->net_total = $request->input('net_total');
                $purchaseMas->paid_amount = $request->input('paid_amount');
                $purchaseMas->bal_amount = $request->input('bal_amount');
                $purchaseMas->detail = $request->input('detail');
                $purchaseMas->save();

                /**
                 * Save Items to Databse 
                 */
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
                        $productTable = new PurchaseMasterProductTable();
                        $productTable->pur_mas_id = $purchaseMas->id;
                        $productTable->item = $product['item'][$x];
                        $productTable->quantity = $product['quantity'][$x];
                        $productTable->cost_price = $product['cost_price'][$x];
                        $productTable->per_item_dis = $product['per_item_dis'][$x];
                        $productTable->total = $product['total'][$x];
                        $productTable->save();
                        $x++;
                    }
                }

                /**
                 * Save Images to Database
                 */
                if( $request->hasFile('image') ) {

                    foreach( $request->image as $image ) {
                        $purMasInvoiceImage = new PurchaseMasterInvoiceImageTable();
                        $apk_file =  $image;
                        $ext = $apk_file->extension();
                        $name = uniqid();
                        $imageName = $name . '.' . $ext;
                        $s_path =  'uploads/purMasterInvoiceImage/s';
                        $m_path =  'uploads/purMasterInvoiceImage/m';
                        if (!file_exists($s_path))
                            mkdir($s_path, 777, true);
                        if (!file_exists($m_path))
                            mkdir($m_path, 777, true);
                        Image::make($apk_file)->resize(100, 60)->save($s_path . '/' . $imageName);
                        Image::make($apk_file)->resize(220, 220)->save($m_path . '/' . $imageName);
                        $apk_file->move( 'uploads/purMasterInvoiceImage', $imageName);
                        $purMasInvoiceImage->image = $imageName;
                        $purMasInvoiceImage->pur_mas_invoice_img_id = $purchaseMas->id;
                        $purMasInvoiceImage->save();
                    }

                }

                /**
                 * Save Transactions
                 */
                $supplier           = SupplyRegistration::find($request->input('supplier_name'));
                $supplierAccount    = $supplier->accounts->account;
                $supplierAccountId  = $supplierAccount->id;

                $details = 'Purchase Products from '.$supplier->name.'. Stock Going to Dr. with '.$request->get('net_total').'Rs/-. and Supplier going to Cr. with '.$request->get('net_total').'Rs/-.';
                /**
                 * Transaction 1 Stock Debit
                 */
                TransactionTable::create([
                    'account_id'    => Accounts::STOCK_ACCOUNT,
                    'sr'            => 1,
                    'date'          => date( 'Y-m-d', strtotime($request->date)),
                    'detail'        => $details,
                    'dr'            => $request->net_total,
                    'cr'            => 0,
                    'purchase_invoice'  => $purchaseMas->id,
                ]);

            
                /**
                 * Transaction 2 Supplier Credit
                 */
                TransactionTable::create([
                    'account_id'    => $supplierAccountId,
                    'sr'            => 2,
                    'date'          => date( 'Y-m-d', strtotime($request->date)),
                    'detail'        => $details,
                    'dr'            => 0,
                    'cr'            => $request->net_total,
                    'purchase_invoice'  => $purchaseMas->id,
                ]);

                /**
                 * if We Pay we have Two other Transactions
                 */

                if ($request->paid_amount > 0) :
                    /**
                     * Transaction 3 Supplier Debit 
                     */
                    TransactionTable::create([
                        'account_id'    => Accounts::STOCK_ACCOUNT,
                        'sr'            => 3,
                        'date'          => date( 'Y-m-d', strtotime($request->date)),
                        'detail'        => $details,
                        'dr'            => $request->paid_amount,
                        'cr'            => 0,
                        'purchase_invoice'  => $purchaseMas->id,
                    ]); 
                    /**
                     * Transaction 4 Cash Credit
                     */

                    TransactionTable::create([
                        'account_id'    => Accounts::STOCK_ACCOUNT,
                        'sr'            => 4,
                        'date'          => date( 'Y-m-d', strtotime($request->date)),
                        'detail'        => $details,
                        'dr'            => 0,
                        'cr'            => $request->paid_amount,
                        'purchase_invoice'  => $purchaseMas->id,
                    ]); 
                endif;
            });
            Session::flash("Success","Purhcase Successfull");
        }catch(Exception $ex){
            Session::flash("Success","Purchase Error!. Erro:".$ex->getMessage());
        }
        return redirect('/dashboard/purchase-master');

    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
        $products = ProductRegistration::get();
        $purchaseMas = PurchaseMaster::find($id);
        $purchaseMasPros = PurchaseMasterProductTable::where('pur_mas_id',$id)->get();
        $purchaseMasImages = PurchaseMasterInvoiceImageTable::where('pur_mas_invoice_img_id',$id)->get();
        $supplierRegis = Accounts::select('id', 'name')->get();
        return view( 'dashboard.admin-panel.purchaseMaster.edit', [ 'products'=>$products, 'purchaseMas'=>$purchaseMas, 'purchaseMasPros'=>$purchaseMasPros, 'purchaseMasImages'=>$purchaseMasImages, 'supplierRegis'=>$supplierRegis ] );

    }

    public function update(Request $request, $id)
    {
        $rules = [
            'date'    =>  'required|max:25',
            'supplier_invoice_no'     =>  'required|max:25',
            'supplier_name'       =>  'required|max:25',
            'cargo'   =>  'required|max:300',
            'gross_total'   =>  'required|max:300',
            'discount'   =>  'max:300',
            'cargo_charges'   =>  'required|max:300',
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
        try{
            DB::transaction(function () use($request,$id) {
                $purchaseMas = PurchaseMaster::find($id);
                $purchaseMas->date = date( 'Y-m-d', strtotime($request->input('date')) );
                $purchaseMas->supplier_invoice_no = $request->input('supplier_invoice_no');
                $purchaseMas->supplier_name = $request->input('supplier_name');
                $purchaseMas->cargo = $request->input('cargo');
                $purchaseMas->gross_total = $request->input('gross_total');
                $purchaseMas->discount = $request->input('discount');
                $purchaseMas->cargo_charges = $request->input('cargo_charges');
                $purchaseMas->net_total = $request->input('net_total');
                $purchaseMas->paid_amount = $request->input('paid_amount');
                $purchaseMas->bal_amount = $request->input('bal_amount');
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
                        $productTable = PurchaseMasterProductTable::findOrNew($key);
                        $productTable->pur_mas_id = $purchaseMas->id;
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
                        $purMasInvoiceImage = PurchaseMasterInvoiceImageTable::findOrNew($key);
                        $apk_file =  $image;
                        $ext = $apk_file->extension();
                        $name = uniqid();
                        $imageName = $name . '.' . $ext;
                        $s_path =  'uploads/purMasterInvoiceImage/s';
                        $m_path =  'uploads/purMasterInvoiceImage/m';
                        if (!file_exists($s_path))
                            mkdir($s_path, 777, true);
                        if (!file_exists($m_path))
                            mkdir($m_path, 777, true);
                        Image::make($apk_file)->resize(100, 60)->save($s_path . '/' . $imageName);
                        Image::make($apk_file)->resize(220, 220)->save($m_path . '/' . $imageName);
                        $apk_file->move( 'uploads/purMasterInvoiceImage', $imageName);
                        $purMasInvoiceImage->image = $imageName;
                        $purMasInvoiceImage->pur_mas_invoice_img_id = $purchaseMas->id;
                        $purMasInvoiceImage->save();
                    }
    
                }
    
                if( $purchaseMas->update() ) {
    
                    /**
                     * Save Transactions
                     */
                    $supplier           = SupplyRegistration::find($request->input('supplier_name'));
                    $supplierAccount    = $supplier->accounts->account;
                    $supplierAccountId  = $supplierAccount->id;
    
                    $details = 'Purchase Products from '.$supplier->name.'. Stock Going to Dr. with '.$request->get('net_total').'Rs/-. and Supplier going to Cr. with '.$request->get('net_total').'Rs/-.';
    
                    /**
                     * Transaction 1 Stock Debit
                     */
                    TransactionTable::firstOrCreate(['sr'=>1,'purchase_invoice'=>$purchaseMas->id])->update([
                        'account_id'    => Accounts::STOCK_ACCOUNT,
                        'sr'            => 1,
                        'date'          => date( 'Y-m-d', strtotime($request->date)),
                        'detail'        => $details,
                        'dr'            => $request->net_total,
                        'cr'            => 0,
                        'purchase_invoice'  => $purchaseMas->id,
                    ]);
       
                    /**
                     * Transaction 2 Supplier Credit
                     */
                    TransactionTable::firstOrCreate(['sr'=>2,'purchase_invoice'=>$purchaseMas->id])->update([
                        'account_id'    => $supplierAccountId,
                        'sr'            => 2,
                        'date'          => date( 'Y-m-d', strtotime($request->date)),
                        'detail'        => $details,
                        'dr'            => 0,
                        'cr'            => $request->net_total,
                        'purchase_invoice'  => $purchaseMas->id,
                    ]);
    
                    /**
                     * if We Pay we have Two other Transactions
                     */
    
                    if ($request->paid_amount > 0) :
                        /**
                         * Transaction 3 Supplier Debit 
                         */
                        TransactionTable::firstOrCreate(['sr'=>3,'purchase_invoice'=>$purchaseMas->id])->update([
                            'account_id'    => Accounts::STOCK_ACCOUNT,
                            'sr'            => 3,
                            'date'          => date( 'Y-m-d', strtotime($request->date)),
                            'detail'        => $details,
                            'dr'            => $request->paid_amount,
                            'cr'            => 0,
                            'purchase_invoice'  => $purchaseMas->id,
                        ]); 
                        /**
                         * Transaction 4 Cash Credit
                         */
    
                        TransactionTable::firstOrCreate(['sr'=>4,'purchase_invoice'=>$purchaseMas->id])->update([
                            'account_id'    => Accounts::STOCK_ACCOUNT,
                            'sr'            => 4,
                            'date'          => date( 'Y-m-d', strtotime($request->date)),
                            'detail'        => $details,
                            'dr'            => 0,
                            'cr'            => $request->paid_amount,
                            'purchase_invoice'  => $purchaseMas->id,
                        ]);
                    else:
                        TransactionTable::whereIn('sr', [3,4])->where('purchase_invoice',$purchaseMas->id)->delete(); 
                    endif;
                
                    Session::flash("Success", "Purchase Master item successfully updated!.");
                }
            });
        }catch(Exception $ex){
            dd($ex);
            Session::flash("Success", "Purchase Update Error. Error: ".$ex->getMessage());
        }
        return redirect('/dashboard/purchase-master');

    }

    public function destroy($id)
    {
        //
        TransactionTable::where('purchase_invoice',$id)->delete();
        $purchaseMas = PurchaseMaster::find($id);
        $purchaseMas->delete();
        $purchaseMasPros = PurchaseMasterProductTable::where('pur_mas_id',$id)->delete();
        $purchaseMasImages = PurchaseMasterInvoiceImageTable::where('pur_mas_invoice_img_id',$id)->get();
        foreach( $purchaseMasImages as $purchaseMasImage ) {
            if (\File::exists(public_path('uploads/purMasterInvoiceImage/m/' . $purchaseMasImage->image))) {
                \File::delete(public_path('uploads/purMasterInvoiceImage/m/' . $purchaseMasImage->image));
                \File::delete(public_path('uploads/purMasterInvoiceImage/s/' . $purchaseMasImage->image));
                \File::delete(public_path('uploads/purMasterInvoiceImage/' . $purchaseMasImage->image));
            }
            $purchaseMasImage->delete();
        }
        return redirect('/dashboard/purchase-master');

    }


    public function productDel(Request $request)
    {
        PurchaseMasterProductTable::where('id',$request->proId)->delete();

    }
}
