<?php

namespace App\Http\Controllers;

use PDF;
use Exception;
use App\Accounts;
use App\SaleMaster;
use App\TransactionTable;
use App\SaleMasterProduct;
use App\ProductRegistration;
use Illuminate\Http\Request;
use App\CustomerRegistration;
use App\SaleMasterInvoiceImages;
use Illuminate\Support\Facades\DB;
use App\PurchaseMasterProductTable;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;

class SaleMasterController extends Controller
{

    public function getCost(Request $request){

        $slePrice = ProductRegistration::where('id', $request->id)->pluck('slae_price');
//        dd($slePrice);
        return response()->json($slePrice);

    }

    public function view($id){

        $saleMas = SaleMaster::where('id', $id)->first();
        $cusName = Accounts::where('id', $saleMas->cus_name)->first();
        $saleMasPros = SaleMasterProduct::where('sale_mas_id',$id)->get();
        return view( 'dashboard.admin-panel.saleMaster.view', [ 'saleMasPros'=>$saleMasPros, 'cusName'=>$cusName, 'saleMas' => $saleMas ] );

    }

    public function downloadPDF($id){
        $saleMas = SaleMaster::find($id);
        $cusName = Accounts::where('id', $saleMas->cus_name)->first();
        $saleMasPros = SaleMasterProduct::where('sale_mas_id',$id)->get();

        $pdf = PDF::loadView('dashboard.admin-panel.saleMaster.pdf', compact('saleMas', 'cusName', 'saleMasPros'));
        return $pdf->stream('invoice.pdf');

    }

    public function index()
    {
        $saleMas = DB::table('sale_masters')
            ->leftJoin('customer_registrations', 'sale_masters.cus_name', '=', 'customer_registrations.id')
            ->select('sale_masters.*', 'customer_registrations.name as cusName')
            ->get();
        return view( 'dashboard.admin-panel.saleMaster.index', [ 'saleMas' => $saleMas ] );

    }

    public function create()
    {
        $products = ProductRegistration::get();
        //$products = DB::table('purchase_master_product_tables')->select('id','item')->distinct('item')->get();
        $cusRegis = CustomerRegistration::select('id', 'name')->get();
        return view( 'dashboard.admin-panel.saleMaster.new', [ 'products'=>$products, 'cusRegis'=>$cusRegis ] );
    }

    public function store(Request $request)
    {
        $rules = [
            'date'         =>  'required|max:25',
            'cus_name'     =>  'required|max:25',
            'gross_total'  =>  'required|max:300',
            'discount'     =>  'max:300',
            'net_total'    =>  'required|max:300',
            'paid_amount'  =>  'required|max:300',
            'bal_amount'   =>  'required|max:300',
        ];

        $messages = [
            'date.required'         =>  'Please Select Date!.',
            'cus_name.required'     =>  'Please enter Supplier Name',
            'gross_total.required'  =>  'Please enter Gross Total!.',
            'net_total.required'    =>  'Please enter Net Total!.',
            'paid_amount.required'  =>  'Please enter Paid Amount!.',
            'bal_amount.required'   =>  'Please Balance Amount!.',
        ];

        $this->validate($request, $rules, $messages);

        try{
            DB::transaction(function () use($request) {
                $lastInvoiceId = SaleMaster::latest()->take(1)->first();
                if(!$lastInvoiceId){
                    $lastInvoiceId = 10000;
                }else
                    $lastInvoiceId = ($lastInvoiceId->cus_invoice_no) + 1;
                $saleMas = new SaleMaster();
                $saleMas->date = date( 'Y-m-d', strtotime($request->input('date')) );
                $saleMas->cus_invoice_no = $lastInvoiceId;
                $saleMas->cus_name = $request->input('cus_name');
                $saleMas->gross_total = $request->input('gross_total');
                $saleMas->discount = $request->input('discount');
                $saleMas->net_total = $request->input('net_total');
                $saleMas->paid_amount = $request->input('paid_amount');
                $saleMas->bal_amount = $request->input('bal_amount');
                $saleMas->detail = $request->input('detail');
                $saleMas->save();
        
                /**
                 * Sale Items to Database
                 */
                if( $request->has('item') ){
                    $product = array(
                        'item' => $request->get('item'),
                        'quantity' => $request->get('quantity'),
                        'cost_price' => $request->get('sale_price'),
                        'per_item_dis' => $request->get('per_item_dis'),
                        'total' => $request->get('total'),
                    );
                    $x = 0;
                    foreach( $request->get('item') as $key=>$item ){
                        $productTable = new SaleMasterProduct();
                        $productTable->sale_mas_id = $saleMas->id;
                        $productTable->item = $product['item'][$key];
                        $productTable->quantity = $product['quantity'][$key];
                        $productTable->cost_price = $product['cost_price'][$key];
                        $productTable->per_item_dis = $product['per_item_dis'][$key];
                        $productTable->total = $product['total'][$key];
                        $productTable->save();
                        $x++;
                    }
        
                }
        
                /**
                 * Sale Invoice Images
                 */
                if( $request->hasFile('image') ) {
        
                    foreach( $request->image as $key=>$image ) {
                        $purMasInvoiceImage = new SaleMasterInvoiceImages();
                        $apk_file =  $image;
                        $ext = $apk_file->extension();
                        $name = uniqid();
                        $imageName = $name . '.' . $ext;
                        $s_path = 'uploads/saleMasterInvoiceImage/s';
                        $m_path =  'uploads/saleMasterInvoiceImage/m';
                        if (!file_exists($s_path))
                            mkdir($s_path, 777, true);
                        if (!file_exists($m_path))
                            mkdir($m_path, 777, true);
                        Image::make($apk_file)->resize(100, 60)->save($s_path . '/' . $imageName);
                        Image::make($apk_file)->resize(220, 220)->save($m_path . '/' . $imageName);
                        $apk_file->move( 'uploads/saleMasterInvoiceImage', $imageName);
                        $purMasInvoiceImage->image = $imageName;
                        $purMasInvoiceImage->sale_invoice_img_id = $saleMas->id;
                        $purMasInvoiceImage->save();
                    }
        
                }

                /**
                 * Save Transactions
                 */
                $customer           = CustomerRegistration::find($request->input('cus_name'));
                $customerAccount    = $customer->accounts->account;
                $customerAccountId  = $customerAccount->id;
                $details = 'Sale Products to '.$customer->name.'. Stock Going to Cr. with '.$request->net_total.'Rs/-. and Customer going to Dr. with '.$request->net_total.'Rs/-.';
        
                /**
                 * Transaction 1 Customer Debit
                 */
                TransactionTable::create([
                    'account_id'    => $customerAccountId,
                    'sr'            => 1,
                    'date'          => date( 'Y-m-d', strtotime($request->date)),
                    'detail'        => $details,
                    'dr'            => $request->net_total,
                    'cr'            => 0,
                    'sale_invoice'  => $saleMas->id,
                ]);
        
            
                /**
                 * Transaction 2 Sales Credit
                 */
                TransactionTable::create([
                    'account_id'    => Accounts::SALES_ACCOUNT,
                    'sr'            => 2,
                    'date'          => date( 'Y-m-d', strtotime($request->date)),
                    'detail'        => $details,
                    'dr'            => 0,
                    'cr'            => $request->net_total,
                    'sale_invoice'  => $saleMas->id,
                ]);
                /**
                 * Transaction 3 CGS Debit
                 */
                TransactionTable::create([
                    'account_id'    => Accounts::CGS_ACCOUNT,
                    'sr'            => 3,
                    'date'          => date( 'Y-m-d', strtotime($request->date)),
                    'detail'        => $details,
                    'dr'            => $request->net_total,
                    'cr'            => 0,
                    'sale_invoice'  => $saleMas->id,
                ]);
        
            
                /**
                 * Transaction 4 Stock Credit
                 */
                TransactionTable::create([
                    'account_id'    => Accounts::STOCK_ACCOUNT,
                    'sr'            => 4,
                    'date'          => date( 'Y-m-d', strtotime($request->date)),
                    'detail'        => $details,
                    'dr'            => 0,
                    'cr'            => $request->net_total,
                    'sale_invoice'  => $saleMas->id,
                ]);
        
                /**
                 * if We Pay we have Two other Transactions
                 */
        
                if ($request->paid_amount > 0) :
                    /**
                     * Transaction 5 Cash Debit 
                     */
                    TransactionTable::create([
                        'account_id'    => Accounts::CASH_ACCOUNT,
                        'sr'            => 5,
                        'date'          => date( 'Y-m-d', strtotime($request->date)),
                        'detail'        => $details,
                        'dr'            => $request->paid_amount,
                        'cr'            => 0,
                        'sale_invoice'  => $saleMas->id,
                    ]); 
                    /**
                     * Transaction 6 Customer Credit
                     */
        
                    TransactionTable::create([
                        'account_id'    => $customerAccountId,
                        'sr'            => 6,
                        'date'          => date( 'Y-m-d', strtotime($request->date)),
                        'detail'        => $details,
                        'dr'            => 0,
                        'cr'            => $request->paid_amount,
                        'sale_invoice'  => $saleMas->id,
                    ]); 
                endif;
                Session::flash("Success", "Sale Master item successfully created!. Invoice Number is: ".$lastInvoiceId);
            });
        }catch(Exception $ex){
            Session::flash("Success", "Sale Master Error: ".$ex->getMessage());
        }
        return redirect('/dashboard/sale-master');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
        $products = ProductRegistration::get();
        $saleMas = SaleMaster::find($id);
        $saleMasPros = SaleMasterProduct::where('sale_mas_id',$id)->get();
        $saleMasImages = SaleMasterInvoiceImages::where('sale_invoice_img_id',$id)->get();
        $supplierRegis = CustomerRegistration::select('id', 'name')->get();
        return view( 'dashboard.admin-panel.saleMaster.edit', [ 'products'=>$products, 'saleMas'=>$saleMas, 'saleMasPros'=>$saleMasPros, 'saleMasImages'=>$saleMasImages, 'supplierRegis'=>$supplierRegis ] );

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

        try{
            DB::transaction(function () use($request,$id) {
                $saleMas = SaleMaster::find($id);
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
                        'cost_price' => $request->get('sale_price'),
                        'per_item_dis' => $request->get('per_item_dis'),
                        'total' => $request->get('total'),
                    );
                    $x = 0;
                    foreach( $request->get('item') as $key=>$item ){
                        $productTable = SaleMasterProduct::findOrNew($key);
        
                        $productTable->sale_mas_id = $saleMas->id;
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
                        $purMasInvoiceImage = SaleMasterInvoiceImages::findOrNew($key);
                        $apk_file =  $image;
                        $ext = $apk_file->extension();
                        $name = uniqid();
                        $imageName = $name . '.' . $ext;
                        $s_path =  'uploads/saleMasterInvoiceImage/s';
                        $m_path =  'uploads/saleMasterInvoiceImage/m';
                        if (!file_exists($s_path))
                            mkdir($s_path, 777, true);
                        if (!file_exists($m_path))
                            mkdir($m_path, 777, true);
                        Image::make($apk_file)->resize(100, 60)->save($s_path . '/' . $imageName);
                        Image::make($apk_file)->resize(220, 220)->save($m_path . '/' . $imageName);
                        $apk_file->move( 'uploads/saleMasterInvoiceImage', $imageName);
                        $purMasInvoiceImage->image = $imageName;
                        $purMasInvoiceImage->sale_invoice_img_id = $saleMas->id;
                        $purMasInvoiceImage->save();
                    }
        
                }
        
                if( $saleMas->update() ) {
                    
                    /**
                     * Save Transactions
                     */
                    $customer           = CustomerRegistration::find($request->input('cus_name'));
                    $customerAccount    = $customer->accounts->account;
                    $customerAccountId  = $customerAccount->id;
                    $details = 'Sale Products to '.$customer->name.'. Stock Going to Cr. with '.$request->net_total.'Rs/-. and Customer going to Dr. with '.$request->net_total.'Rs/-.';
                
                    /**
                     * Transaction 1 Customer Debit
                     */
                    TransactionTable::firstOrCreate(['sr'=>1,'sale_invoice'=>$saleMas->id])->create([
                        'account_id'    => $customerAccountId,
                        'sr'            => 1,
                        'date'          => date( 'Y-m-d', strtotime($request->date)),
                        'detail'        => $details,
                        'dr'            => $request->net_total,
                        'cr'            => 0,
                        'sale_invoice'  => $saleMas->id,
                    ]);
                
                    
                    /**
                     * Transaction 2 Sales Credit
                     */
                    TransactionTable::firstOrCreate(['sr'=>2,'sale_invoice'=>$saleMas->id])->create([
                        'account_id'    => Accounts::SALES_ACCOUNT,
                        'sr'            => 2,
                        'date'          => date( 'Y-m-d', strtotime($request->date)),
                        'detail'        => $details,
                        'dr'            => 0,
                        'cr'            => $request->net_total,
                        'sale_invoice'  => $saleMas->id,
                    ]);
                    /**
                     * Transaction 3 CGS Debit
                     */
                    TransactionTable::firstOrCreate(['sr'=>3,'sale_invoice'=>$saleMas->id])->create([
                        'account_id'    => Accounts::CGS_ACCOUNT,
                        'sr'            => 3,
                        'date'          => date( 'Y-m-d', strtotime($request->date)),
                        'detail'        => $details,
                        'dr'            => $request->net_total,
                        'cr'            => 0,
                        'sale_invoice'  => $saleMas->id,
                    ]);
                
                    
                    /**
                     * Transaction 4 Stock Credit
                     */
                    TransactionTable::firstOrCreate(['sr'=>4,'sale_invoice'=>$saleMas->id])->create([
                        'account_id'    => Accounts::STOCK_ACCOUNT,
                        'sr'            => 4,
                        'date'          => date( 'Y-m-d', strtotime($request->date)),
                        'detail'        => $details,
                        'dr'            => 0,
                        'cr'            => $request->net_total,
                        'sale_invoice'  => $saleMas->id,
                    ]);
                
                    /**
                     * if We Pay we have Two other Transactions
                     */
                
                    if ($request->paid_amount > 0) :
                            /**
                             * Transaction 5 Cash Debit 
                             */
                            TransactionTable::firstOrCreate(['sr'=>5,'sale_invoice'=>$saleMas->id])->create([
                                'account_id'    => Accounts::CASH_ACCOUNT,
                                'sr'            => 5,
                                'date'          => date( 'Y-m-d', strtotime($request->date)),
                                'detail'        => $details,
                                'dr'            => $request->paid_amount,
                                'cr'            => 0,
                                'sale_invoice'  => $saleMas->id,
                            ]); 
                            /**
                             * Transaction 6 Customer Credit
                             */
                
                            TransactionTable::firstOrCreate(['sr'=>6,'sale_invoice'=>$saleMas->id])->create([
                                'account_id'    => $customerAccountId,
                                'sr'            => 6,
                                'date'          => date( 'Y-m-d', strtotime($request->date)),
                                'detail'        => $details,
                                'dr'            => 0,
                                'cr'            => $request->paid_amount,
                                'sale_invoice'  => $saleMas->id,
                            ]); 
                    endif;
                    Session::flash("Success", "Sale Master item successfully Updated!. Invoice Number is: ".$saleMas->cus_invoice_no);
                }
            });
        }catch(Exception $ex){
            Session::flash("Success", "Sale Master Update Error. Error: ".$ex->getMessage());
        }
        return redirect('/dashboard/sale-master');

    }

    public function destroy($id)
    {
        //
        $saleMas = SaleMaster::find($id);
        $saleMas->delete();
        $saleMasPros = SaleMasterProduct::where('sale_mas_id',$id)->delete();
        $saleMasImages = SaleMasterInvoiceImages::where('sale_invoice_img_id',$id)->get();
        foreach( $saleMasImages as $saleMasImage ) {
            if (\File::exists(public_path('uploads/saleMasterInvoiceImage/m/' . $saleMasImage->image))) {
                \File::delete(public_path('uploads/saleMasterInvoiceImage/m/' . $saleMasImage->image));
                \File::delete(public_path('uploads/saleMasterInvoiceImage/s/' . $saleMasImage->image));
                \File::delete(public_path('uploads/saleMasterInvoiceImage/' . $saleMasImage->image));
            }
            TransactionTable::where('sale_invoice',$id)->delete();
            $saleMasImage->delete();
        }
        return redirect('/dashboard/sale-master');

    }

    public function productDel(Request $request)
    {
        SaleMasterProduct::where('id',$request->proId)->delete();

    }

}
