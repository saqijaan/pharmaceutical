<?php

namespace App\Http\Controllers;

use App\DistributerOrderBook;
use App\DistributerOrderBookItem;
use App\DistributerRegistration;
use App\ProductRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;
use PDF;
class DistributerOrderBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        //
//        dd();
//        $purchaseMas = disOrderBook::get();
        $disOrderBooks = DistributerOrderBook::where( 'dist_id', \Auth::guard('distributer')->Id() )->get();
        return view( 'dashboard.admin-panel.disOrderBook.index', [ 'disOrderBooks' => $disOrderBooks ] );

    }
    public function adminindex()
    {
        //
//        dd();
//        $purchaseMas = disOrderBook::get();
        $disOrderBooks = DistributerOrderBook::all();
        return view( 'dashboard.admin-panel.orders.index', [ 'disOrderBooks' => $disOrderBooks ] );

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
        return view( 'dashboard.admin-panel.disOrderBook.new', [ 'products'=>$products ] );
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
        ];

        $messages = [
            'date.required'    =>  'Please Select Date!.',
            'dis_name.required'     =>  'Please Select Distributer Name',
            'gross_total.required'       =>  'Please enter Gross Total',
            'net_total.required'   =>  'Please enter Net Total!.',
        ];

        $this->validate($request, $rules, $messages);

        $lastPoIdOrder = DistributerOrderBook::latest()->take(1)->first();
        $PoID = 10000;
        if ($lastPoIdOrder){
            $PoID = ($lastPoIdOrder->po_id)+1;
        }
        $disOdrBk = new DistributerOrderBook;
        $disOdrBk->po_id        =  $PoID;
        $disOdrBk->dist_id      =  \Auth::guard('distributer')->Id();
        $disOdrBk->dist_name    =  \Auth::guard('distributer')->user()->name;
        $disOdrBk->created_at = date( 'Y-m-d H:i:s', strtotime($request->input('date')) );

        $disOdrBk->save();

        if( $request->has('item') ){
            $product = array(
                'item' => $request->get('item'),
                'quantity' => $request->get('quantity'),
            );
            $x = 0;
            foreach( $request->get('item') as $item ){
                $productTable = new DistributerOrderBookItem();
                $productTable->dis_odr_book_id = $disOdrBk->id;
                $productTable->item_id      = $product['item'][$x];
                $productTable->item_name    = ProductRegistration::find($product['item'][$x]) ? ProductRegistration::find($product['item'][$x])->name : 'undefined';
                $productTable->quantity     = $product['quantity'][$x];
                $productTable->save();
                $x++;
            }
        }


        Session::flash("Success","Distributer Order Book successfully register!.Order Id is: ".$PoID);
        return redirect('/dashboard/distributer-order-book');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $disOdrBks = DistributerOrderBook::find($id);
        $disOdrBkItems = DistributerOrderBookItem::where('dis_odr_book_id',$id)->get();
        return view( 'dashboard.admin-panel.disOrderBook.edit', [ 'products'=>$products, 'disOdrBks'=>$disOdrBks, 'disOdrBkItems'=>$disOdrBkItems ] );

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
        ];

        $messages = [
            'date.required'    =>  'Please Select Date!.',
            'dis_name.required'     =>  'Please Select Distributer Name',
            'gross_total.required'       =>  'Please enter Gross Total',
            'net_total.required'   =>  'Please enter Net Total!.',
        ];

        $this->validate($request, $rules, $messages);

        $disOdrBk = DistributerOrderBook::find($id);

        $lastPoIdOrder = DistributerOrderBook::latest()->take(1)->first();
        $disOdrBk->dist_id      =  \Auth::guard('distributer')->Id();
        $disOdrBk->dist_name    =  \Auth::guard('distributer')->user()->name;
        $disOdrBk->created_at   = date( 'Y-m-d', strtotime($request->input('date')) );



        //dd($request->all());
        if( $request->has('item') ){
            $product = array(
                'item' => $request->get('item'),
                'quantity' => $request->get('quantity'),
            );
            $x = 1;
            foreach( $request->get('item') as $key=>$item ){
                $productTable = DistributerOrderBookItem::findOrNew($item);
                $productTable->dis_odr_book_id = $disOdrBk->id;
                $productTable->item_id      = $product['item'][$key];
                $productTable->item_name    = ProductRegistration::find($product['item'][$key]) ? ProductRegistration::find($product['item'][$key])->name : 'undefined';
                $productTable->quantity     = $product['quantity'][$key];
                $productTable->save();
                $x++;
            }

        }


        if($disOdrBk->update()) {
            Session::flash("Success", "Distributer Order Book items successfully updated!.");
            return redirect('/dashboard/distributer-order-book');
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

        $disOdrBks = DistributerOrderBook::find($id);
        $disOdrBks->delete();
        $disOdrBkItems = DistributerOrderBookItem::where('dis_odr_book_id',$id)->delete();

        return redirect('/dashboard/distributer-order-book');

    }

    public function view($id){
        $order = DistributerOrderBook::find($id);
        return view( 'dashboard.admin-panel.orders.view', compact('order') );
    }

    public function downloadPDF($id){
        $order = DistributerOrderBook::find($id);

        $pdf = PDF::loadView('dashboard.admin-panel.orders.pdf', compact('order') );
        return $pdf->stream('invoice.pdf');

    }
    public function deliverOrder($id){
        DistributerOrderBook::find($id)->update([
            'delivered' => true
        ]);
        Session::flash("Success", "Distributer Order Delivered!.");
        return back();
    }
    public function productDel(Request $request)
    {
        //
        DistributerOrderBookItem::where('id',$request->proId)->delete();

    }
}
