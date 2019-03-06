<?php

namespace App\Http\Controllers;

use App\AccountHead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AccountHeadController extends Controller
{
    public function index()
    {
        //
        $accountHeads = AccountHead::all();
        return view( 'dashboard.admin-panel.accountHead.index', [ 'accountHeads'=>$accountHeads ] );
    }

    public function create()
    {
        //
        $accountHeads = AccountHead::all();
        return view( 'dashboard.admin-panel.accountHead.new', [ 'accountHeads'=>$accountHeads ] );
    }

    public function store(Request $request)
    {
        //
        $rules = [
            'name'  =>  'required|max:99',
        ];

        $message = [
            'name:required'  =>  'The Session Name filled must be required',
        ];

        $this->validate($request, $rules, $message);

        $accountHeads = new AccountHead();

        if( $request->has('name') ){
            $accountHeads->name = $request->input('name');
        }

        $accountHeads->save();

        Session::flash('Success', 'Account Head has been successfully registered');

        return redirect('/dashboard/account-head');

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
        $accountHeads = AccountHead::find($id);
        return view( 'dashboard.admin-panel.accountHead.edit', ['accountHeads'=>$accountHeads] );
    }

    public function update(Request $request, $id)
    {
        //

        $rules = [
            'name'  =>  'required|max:99',
        ];

        $customMessages = [
            'name:required' => 'The Session Name field is required.',
        ];

        $this->validate($request, $rules, $customMessages);
        $accountHeads = AccountHead::find($id);

        if( $request->has('name') ){
            $accountHeads->name = $request->input('name');
        }

        $accountHeads->update();
        Session::flash('Success', $id.' Account Head has been successfully updated');

        return redirect('/dashboard/account-head');

    }

    public function destroy($id)
    {
        //
        $accountHeads = AccountHead::find($id);
        $accountHeads->delete();

        Session::flash('Success', $id.' Account Head has been successfully deleted');
        return redirect('/dashboard/account-head');

    }
}
