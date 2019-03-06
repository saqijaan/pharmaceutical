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
        $disOrderBooks = DB::table('distributer_order_books')
            ->leftJoin('distributer_registrations', 'distributer_order_books.dis_name', '=', 'distributer_registrations.id')
            ->select('distributer_order_books.*', 'distributer_registrations.name as disName')
            ->get();
        return view( 'dashboard.admin-panel.disOrderBook.index', [ 'disOrderBooks' => $disOrderBooks ] );

    }
    public function adminindex()
    {
        //
//        dd();
//        $purchaseMas = disOrderBook::get();
        $disOrderBooks = DB::table('distributer_order_books')
            ->leftJoin('distributer_registrations', 'distributer_order_books.dis_name', '=', 'distributer_registrations.id')
            ->select('distributer_order_books.*', 'distributer_registrations.name as disName')
            ->get();
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
        $disRegis = DistributerRegistration::select('id', 'name')->get();
        return view( 'dashboard.admin-panel.disOrderBook.new', [ 'products'=>$products, 'disRegis'=>$disRegis ] );
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
            'dis_name'     =>  'required|max:25',
            'gross_total'   =>  'required|max:300',
            'discount'   =>  'required|max:300',
            'net_total'   =>  'max:300',
        ];

        $messages = [
            'date.required'    =>  'Please Select Date!.',
            'dis_name.required'     =>  'Please Select Distributer Name',
            'gross_total.required'       =>  'Please enter Gross Total',
            'net_total.required'   =>  'Please enter Net Total!.',
        ];

        $this->validate($request, $rules, $messages);

        $disOdrBk = new DistributerOrderBook();

        if( $request->has('date') ){
            $disOdrBk->date = date( 'Y,m,d', strtotime($request->input('date')) );
        }

        if( $request->has('dis_name') ){
            $disOdrBk->dis_name = $request->input('dis_name');
        }

        if( $request->has('gross_total') ){
            $disOdrBk->gross_total = $request->input('gross_total');
        }

        if( $request->has('discount') ){
            $disOdrBk->discount = $request->input('discount');
        }

        if( $request->has('net_total') ){
            $disOdrBk->net_total = $request->input('net_total');
        }

        $disOdrBk->save();

        if( $request->has('item') ){
            $product = array(
                'item' => $request->get('item'),
                'quantity' => $request->get('quantity'),
                'cost_price' => $request->get('cost_price'),
                'total' => $request->get('total'),
            );
            $x = 0;
            foreach( $request->get('item') as $item ){
                $productTable = new DistributerOrderBookItem();
                $productTable->dis_odr_book_id = $disOdrBk->id;
                $productTable->item = $product['item'][$x];
                $productTable->quantity = $product['quantity'][$x];
                $productTable->cost_price = $product['cost_price'][$x];
                $productTable->total = $product['total'][$x];
                $productTable->save();
                $x++;
            }
        }


        Session::flash("Success","Distributer Order Book items successfully register!.");
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
        $disRegis = DistributerRegistration::select('id', 'name')->get();
        return view( 'dashboard.admin-panel.disOrderBook.edit', [ 'products'=>$products, 'disOdrBks'=>$disOdrBks, 'disOdrBkItems'=>$disOdrBkItems, 'disRegis'=>$disRegis ] );

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
            'dis_name'     =>  'required|max:25',
            'gross_total'   =>  'required|max:300',
            'discount'   =>  'required|max:300',
            'net_total'   =>  'max:300',
        ];

        $messages = [
            'date.required'    =>  'Please Select Date!.',
            'dis_name.required'     =>  'Please Select Distributer Name',
            'gross_total.required'       =>  'Please enter Gross Total',
            'net_total.required'   =>  'Please enter Net Total!.',
        ];

        $this->validate($request, $rules, $messages);

        $disOdrBk = DistributerOrderBook::find($id);

        if( $request->has('date') ){
            $disOdrBk->date = date( 'Y,m,d', strtotime($request->input('date')) );
        }

        if( $request->has('dis_name') ){
            $disOdrBk->dis_name = $request->input('dis_name');
        }

        if( $request->has('gross_total') ){
            $disOdrBk->gross_total = $request->input('gross_total');
        }

        if( $request->has('discount') ){
            $disOdrBk->discount = $request->input('discount');
        }

        if( $request->has('net_total') ){
            $disOdrBk->net_total = $request->input('net_total');
        }



        if( $request->has('item') ){
            $product = array(
                'item' => $request->get('item'),
                'quantity' => $request->get('quantity'),
                'cost_price' => $request->get('cost_price'),
                'total' => $request->get('total'),
            );
            $x = 0;
            foreach( $request->get('item') as $key=>$item ){
                $productTable = DistributerOrderBookItem::findOrNew($key);
//                dd($item);
                $productTable->dis_odr_book_id = $disOdrBk->id;
                $productTable->item = $product['item'][$key];
                $productTable->quantity = $product['quantity'][$key];
                $productTable->cost_price = $product['cost_price'][$key];
                $productTable->total = $product['total'][$key];
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


    public function productDel(Request $request)
    {
        //
        DistributerOrderBookItem::where('id',$request->proId)->delete();

    }
}
