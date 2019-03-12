<?php

namespace App\Http\Controllers;

use App\DistributerDepositAmount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DistributerRegistration;
use Illuminate\Support\Facades\Session;

class DistributerDepositAmountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disDpstAmnts = DistributerDepositAmount::where('dis_id',\Auth::guard('distributer')->Id())->get();

        return view( 'dashboard.admin-panel.disDpstAmnt.index',compact('disDpstAmnts') );

    }
    public function adminindex()
    {
        $disDpstAmnts = DistributerDepositAmount::all();
        return view( 'dashboard.admin-panel.deposits.index', compact('disDpstAmnts') );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $disRegis = DistributerRegistration::select('id', 'name')->get();
        return view( 'dashboard.admin-panel.disDpstAmnt.new', [ 'disRegis'=>$disRegis ] );
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
            'slip_name'   =>  'required|max:300',
            'bank_name'   =>  'max:300',
            'amount'   =>  'required|max:300',
        ];

        $messages = [
            'date.required'    =>  'Please Select Date!.',
            'slip_name.required'       =>  'Please enter Slip Name',
            'amount.required'   =>  'Please enter Amount!.',
        ];

        $this->validate($request, $rules, $messages);

        $disSalesOdrs = new DistributerDepositAmount();
        $disSalesOdrs->date = date( 'Y-m-d', strtotime($request->input('date')) );
        $disSalesOdrs->dis_id       = \Auth::guard('distributer')->Id();
        $disSalesOdrs->dis_name     = \Auth::guard('distributer')->user()->name;
        $disSalesOdrs->slip_name = $request->input('slip_name');
        $disSalesOdrs->bank_name = $request->input('bank_name');
        $disSalesOdrs->amount = $request->input('amount');
        $disSalesOdrs->save();


        Session::flash("Success","Distributer deposit amount successfully register!.");
        return redirect('/dashboard/distributer-deposit-amount');

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
        $disDpstAmnt = DistributerDepositAmount::find($id);
        $disRegis = DistributerRegistration::select('id', 'name')->get();
        return view( 'dashboard.admin-panel.disDpstAmnt.edit', [ 'disDpstAmnt'=>$disDpstAmnt, 'disRegis'=>$disRegis ] );

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
        //dd($id);
        //

        $rules = [
            'date'    =>  'required|max:25',
            'slip_name'   =>  'required|max:300',
            'bank_name'   =>  'max:300',
            'amount'   =>  'required|numeric',
        ];

        $messages = [
            'date.required'    =>  'Please Select Date!.',
            'slip_name.required'       =>  'Please enter Slip Name',
            'amount.required'   =>  'Please enter Amount!.',
        ];

        $this->validate($request, $rules, $messages);
        
        $disSalesOdrs = DistributerDepositAmount::findOrNew($id);
        
        $disSalesOdrs->date = date( 'Y-m-d', strtotime($request->input('date')) );
        $disSalesOdrs->slip_name    = $request->input('slip_name');
        $disSalesOdrs->bank_name    = $request->input('bank_name');
        $disSalesOdrs->amount       = $request->input('amount');
        $disSalesOdrs->save();


        Session::flash("Success","Distributer deposit amount successfully updated!.");
        return redirect('/dashboard/distributer-deposit-amount');

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

        $disOdrBks = DistributerDepositAmount::find($id);
        $disOdrBks->delete();

        Session::flash("Success","Distributer deposit amount successfully deleted!.");
        return redirect('/dashboard/distributer-deposit-amount');

    }

    public function approveAmount($id){
        $record  = DistributerDepositAmount::find($id);
        $record->approved  = true;
        $record->save();
        Session::flash("Success","Distributer Deposited amount successfully Approved!.");
        return back();
    }

}
