<?php

namespace App\Http\Controllers;

use App\DistributerRegistration;
use App\DistributerSalesOrder;
use App\DistributerSalesOrderItems;
use App\ProductRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DistributerSalesOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disSalesOdrs = DistributerSalesOrder::where('dis_id', \Auth::guard('distributer')->Id() )->get();
        return view( 'dashboard.admin-panel.disSaleOrder.index', compact('disSalesOdrs') );
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $products = ProductRegistration::get();
        return view( 'dashboard.admin-panel.disSaleOrder.new', [ 'products'=>$products ] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $rules = [
            'date'    =>  'required|max:25',
            'gross_total'   =>  'required|max:300',
            'discount'   =>  'max:300',
            'net_total'   =>  'max:300',
        ];

        $messages = [
            'date.required'    =>  'Please Select Date!.',
            'gross_total.required'       =>  'Please enter Gross Total',
            'net_total.required'   =>  'Please enter Net Total!.',
        ];

        $this->validate($request, $rules, $messages);

        $disSalesOdrs               = new DistributerSalesOrder();
        $disSalesOdrs->date         = date( 'Y-m-d', strtotime($request->input('date')) );
        $disSalesOdrs->dis_id       = \Auth::guard('distributer')->Id();
        $disSalesOdrs->dis_name     = \Auth::guard('distributer')->user()->name;
        $disSalesOdrs->gross_total  = $request->input('gross_total');
        $disSalesOdrs->discount     = $request->input('discount');
        $disSalesOdrs->net_total    = $request->input('net_total');
        $disSalesOdrs->detail       = $request->input('detail');
        $disSalesOdrs->save();

        if( $request->has('item') ){
            $product = array(
                'item' => $request->get('item'),
                'quantity' => $request->get('quantity'),
                'cost_price' => $request->get('cost_price'),
                'total' => $request->get('total'),
            );
            $x = 0;
            foreach( $request->get('item') as $item ){
                $productTable = new DistributerSalesOrderItems();
                $productTable->dis_sls_odr_id = $disSalesOdrs->id;
                $productTable->item = $product['item'][$x];
                $productTable->quantity = $product['quantity'][$x];
                $productTable->cost_price = $product['cost_price'][$x];
                $productTable->total = $product['total'][$x];
                $productTable->save();
                $x++;
            }
        }


        Session::flash("Success","Distributer Sale Order items successfully register!.");
        return redirect('/dashboard/distributer-sale-orders');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $disSalesOdrs = DistributerSalesOrder::where('id',$id)->where('dis_id', \Auth::guard('distributer')->Id())->first();
        return view( 'dashboard.admin-panel.disSaleOrder.view', compact('disSalesOdrs') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $products = ProductRegistration::get();
        $disSlsOdrs = DistributerSalesOrder::find($id);
        $disSlsOdrItems = DistributerSalesOrderItems::where('dis_sls_odr_id',$id)->get();
        return view( 'dashboard.admin-panel.disSaleOrder.edit', [ 'products'=>$products, 'disSlsOdrs'=>$disSlsOdrs, 'disSlsOdrItems'=>$disSlsOdrItems ] );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $rules = [
            'date'    =>  'required|max:25',
            'gross_total'   =>  'required|max:300',
            'discount'   =>  'max:300',
            'net_total'   =>  'max:300',
        ];

        $messages = [
            'date.required'    =>  'Please Select Date!.',
            'gross_total.required'       =>  'Please enter Gross Total',
            'net_total.required'   =>  'Please enter Net Total!.',
        ];

        $this->validate($request, $rules, $messages);

        $disSalesOdrs = DistributerSalesOrder::find($id);
        $disSalesOdrs->date = date( 'Y-m-d', strtotime($request->input('date')) );
        $disSalesOdrs->gross_total = $request->input('gross_total');
        $disSalesOdrs->discount = $request->input('discount');
        $disSalesOdrs->net_total = $request->input('net_total');
        $disSalesOdrs->detail       = $request->input('detail');

        if( $request->has('item') ){
            $product = array(
                'item' => $request->get('item'),
                'quantity' => $request->get('quantity'),
                'cost_price' => $request->get('cost_price'),
                'total' => $request->get('total'),
            );
            $x = 0;
            foreach( $request->get('item') as $key=>$item ){
                $productTable = DistributerSalesOrderItems::findOrNew($key);
//                dd($item);
                $productTable->dis_sls_odr_id = $disSalesOdrs->id;
                $productTable->item = $product['item'][$key];
                $productTable->quantity = $product['quantity'][$key];
                $productTable->cost_price = $product['cost_price'][$key];
                $productTable->total = $product['total'][$key];
                $productTable->save();
                $x++;
            }

        }


        if($disSalesOdrs->update()) {
            Session::flash("Success","Distributer Sale Order items successfully updated!.");
            return redirect('/dashboard/distributer-sale-orders');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $disOdrBks = DistributerSalesOrder::find($id);
        $disOdrBks->delete();
        $disOdrBkItems = DistributerSalesOrderItems::where('dis_sls_odr_id',$id)->delete();

        return redirect('/dashboard/distributer-sale-orders');

    }


    public function productDel(Request $request)
    {
        //
        DistributerSalesOrderItems::where('id',$request->proId)->delete();

    }
}
