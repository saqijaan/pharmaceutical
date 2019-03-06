<?php

namespace App\Http\Controllers;

use App\BankRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BankRegisterController extends Controller
{
    public function index()
    {
        //
        $bnkRgstrs = BankRegister::all();
        return view( 'dashboard.admin-panel.bankRegister.index', [ 'bnkRgstrs'=>$bnkRgstrs ] );
    }

    public function create()
    {
        //
        $bnkRgstrs = BankRegister::all();
        return view( 'dashboard.admin-panel.bankRegister.new', [ 'bnkRgstrs'=>$bnkRgstrs ] );
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

        $bnkRgstrs = new BankRegister();

        if( $request->has('name') ){
            $bnkRgstrs->name = $request->input('name');
        }

        $bnkRgstrs->save();

        Session::flash('Success', 'Account Head has been successfully registered');

        return redirect('/dashboard/bank-register');

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
        $bnkRgstrs = BankRegister::find($id);
        return view( 'dashboard.admin-panel.bankRegister.edit', ['bnkRgstrs'=>$bnkRgstrs] );
    }

    public function update(Request $request, $id)
    {
        //

        $rules = [
            'name'  =>  'required|max:99',
        ];

        $customMessages = [
            'name:required' => 'The Bank Name field is required.',
        ];

        $this->validate($request, $rules, $customMessages);
        $bnkRgstrs = BankRegister::find($id);

        if( $request->has('name') ){
            $bnkRgstrs->name = $request->input('name');
        }

        $bnkRgstrs->update();
        Session::flash('Success', $id.' Bank Name has been successfully updated');

        return redirect('/dashboard/bank-register');

    }

    public function destroy($id)
    {
        //
        $bnkRgstrs = BankRegister::find($id);
        $bnkRgstrs->delete();

        Session::flash('Success', $id.' Bank Name has been successfully deleted');
        return redirect('/dashboard/bank-register');

    }


}
