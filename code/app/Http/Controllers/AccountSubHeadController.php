<?php

namespace App\Http\Controllers;

use App\AccountHead;
use App\AccountSubHead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AccountSubHeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $accountSubHeads = DB::table('account_sub_heads')
        ->leftJoin('account_heads', 'account_sub_heads.head_id', '=', 'account_heads.id')
        ->select( 'account_heads.name as headTitle', 'account_sub_heads.*' )
        ->get();
//        $accountHeads = AccountHead::all();
        return view( 'dashboard.admin-panel.accountSubHead.index', [ 'accountSubHeads'=>$accountSubHeads ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $accountSubHeads = DB::table('account_sub_heads')
            ->leftJoin('account_heads', 'account_sub_heads.head_id', '=', 'account_heads.id')
            ->select( 'account_heads.name as headTitle', 'account_sub_heads.*' )
            ->get();
        $accountHeads = AccountHead::all();
        return view( 'dashboard.admin-panel.accountSubHead.new', [ 'accountSubHeads'=>$accountSubHeads, 'accountHeads'=>$accountHeads ] );
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
            'name'  =>  'required|max:99',
            'head_id'  =>  'required|max:99',
        ];

        $message = [
            'name:required'  =>  'The Account Sub-Head Name filled must be required',
            'head_id:required'  =>  'The Account Head Name filled must be required',
        ];

        $this->validate($request, $rules, $message);

        $accountSubHeads = new AccountSubHead();

        if( $request->has('name') ){
            $accountSubHeads->name = $request->input('name');
        }

        if( $request->has('head_id') ){
            $accountSubHeads->head_id = $request->input('head_id');
        }

        if( $request->has('detail') ){
            $accountSubHeads->detail = $request->input('detail');
        }

        $accountSubHeads->save();

        Session::flash('Success', 'Account Sub-Head has been successfully registered');

        return redirect('/dashboard/account-sub-head');

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
        $accountSubHeads = AccountSubHead::find($id);
        $accountHeads = AccountHead::all();
        return view( 'dashboard.admin-panel.accountSubHead.edit', ['accountSubHeads'=>$accountSubHeads, 'accountHeads'=>$accountHeads ] );
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
            'name'  =>  'required|max:99',
            'head_id'  =>  'required|max:99',
        ];

        $message = [
            'name:required'  =>  'The Account Sub-Head Name filled must be required',
            'head_id:required'  =>  'The Account Head Name filled must be required',
        ];

        $this->validate($request, $rules, $message);

        $accountSubHeads = AccountSubHead::find($id);

        if( $request->has('name') ){
            $accountSubHeads->name = $request->input('name');
        }

        if( $request->has('head_id') ){
            $accountSubHeads->head_id = $request->input('head_id');
        }

        if( $request->has('detail') ){
            $accountSubHeads->detail = $request->input('detail');
        }

        $accountSubHeads->update();
        Session::flash('Success', $id.' Account Sub-Head has been successfully updated');

        return redirect('/dashboard/account-sub-head');

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
        $accountSubHeads = AccountSubHead::find($id);
        $accountSubHeads->delete();

        Session::flash('Success', $id.' Account Sub-Head has been successfully deleted');
        return redirect('/dashboard/account-sub-head');

    }
}
