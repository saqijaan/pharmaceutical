<?php

namespace App\Http\Controllers;

use App\AccountHead;
use App\Accounts;
use App\AccountSubHead;
use App\OneToOneAccounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
//        $accountHeads = AccountHead::all();
//        $accountSubHeads = AccountSubHead::all();
        $accounts = DB::table('accounts')
            ->leftJoin('account_heads', 'accounts.head_id', '=', 'account_heads.id')
            ->leftJoin('account_sub_heads', 'accounts.sub_head_id', '=', 'account_sub_heads.id')
            ->select( 'account_heads.name as headTitle','account_sub_heads.name as subHeadTitle', 'accounts.*')
            ->orderBy('id','desc')->get();
        return view( 'dashboard.admin-panel.accountRegis.index', [ 'accounts'=>$accounts ] );
    }

    public function getSubHead( Request $request )
    {
        //
//        dd($request->check);
        $check = $request->check;
        $accountSubHeads = AccountSubHead::where('head_id',$request->main_cate)->get();
        $accounts = '';
        return response()->json( view('dashboard.admin-panel.accountRegis.get-sub-head-ajax', [ 'check'=>$check, 'accounts'=>$accounts, 'accountSubHeads'=>$accountSubHeads ])->render());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $check = '';
        $accountSubHeads = AccountSubHead::all();
        $accountHeads = AccountHead::all();
        $accounts = DB::table('accounts')
            ->leftJoin('account_heads', 'accounts.head_id', '=', 'account_heads.id')
            ->leftJoin('account_sub_heads', 'accounts.sub_head_id', '=', 'account_sub_heads.id')
            ->select( 'account_heads.name as headTitle','account_sub_heads.name as subHeadTitle', 'accounts.*')
            ->orderBy('id','desc')->get();
        return view( 'dashboard.admin-panel.accountRegis.new', [ 'check'=>$check, 'accountHeads'=>$accountHeads, 'accounts'=>$accounts, 'accountSubHeads'=>$accountSubHeads ] );
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
            'sub_head_id'  =>  'required|max:99',
        ];

        $message = [
            'name:required'  =>  'The Account Sub-Head Name filled must be required',
            'head_id:required'  =>  'The Account Head Name filled must be required',
            'sub_head_id:required'  =>  'The Account Sub-Head Name filled must be required',
        ];

        $this->validate($request, $rules, $message);

        $accounts = new Accounts();

        if( $request->has('name') ){
            $accounts->name = $request->input('name');
        }

        if( $request->has('sub_head_id') ){
            $accounts->sub_head_id = $request->input('sub_head_id');
        }

        if( $request->has('head_id') ){
            $accounts->head_id = $request->input('head_id');
        }

        $accounts->save();

        Session::flash('Success', 'Account has been successfully registered');

        return redirect('/dashboard/account-regis');

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
        $check = 'update';
        $accounts = Accounts::find($id);
        $accountSubHeads = AccountSubHead::where('head_id', $accounts->head_id)->get();
        $accountHeads = AccountHead::all();
        return view( 'dashboard.admin-panel.accountRegis.edit', [ 'check'=>$check, 'accounts'=>$accounts, 'accountHeads'=>$accountHeads, 'accountSubHeads'=>$accountSubHeads ] );
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
            'sub_head_id'  =>  'required|max:99',
        ];

        $message = [
            'name:required'  =>  'The Account Sub-Head Name filled must be required',
            'head_id:required'  =>  'The Account Head Name filled must be required',
            'sub_head_id:required'  =>  'The Account Sub-Head Name filled must be required',
        ];

        $this->validate($request, $rules, $message);

        $accounts = Accounts::find($id);

        if( $request->has('name') ){
            $accounts->name = $request->input('name');
        }

        if( $request->has('sub_head_id') ){
            $accounts->sub_head_id = $request->input('sub_head_id');
        }

        if( $request->has('head_id') ){
            $accounts->head_id = $request->input('head_id');
        }
        $accounts->update();


        // Account table Update
        $get1To1Acc = OneToOneAccounts::where('account_id', $id)->first();

        $accountRegis = Accounts::find($get1To1Acc->account_id);
        if( $request->has('name') ){
            $accountRegis->name = $request->input('name');
        }
        if( $request->has('name') ){
            $accountRegis->head_id = 1;
        }
        if( $request->has('name') ){
            $accountRegis->sub_head_id = 4;
        }
        $accountRegis->update();

        // One to One Account table Update
        if( $request->has('name') ){
            $oneToOneAcc['account_id'] = $accountRegis->id;
        }
        if( $request->has('name') ){
            $oneToOneAcc['distributer_id'] = $distributerRegis->id;
        }
        OneToOneAccounts::where('distributer_id', $get1To1Acc->distributer_id)->update($oneToOneAcc);


        Session::flash('Success', 'Account has been successfully updates');

        return redirect('/dashboard/account-regis');

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
        $accounts = Accounts::find($id);
        $accounts->delete();

        Session::flash('Success', $id.' Account has been successfully deleted');
        return redirect('/dashboard/account-regis');

    }
}
