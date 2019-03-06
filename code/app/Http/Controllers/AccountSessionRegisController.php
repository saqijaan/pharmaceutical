<?php

namespace App\Http\Controllers;

use App\AccountSessionRegis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AccountSessionRegisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $acSessionRegis = AccountSessionRegis::all();
        return view( 'dashboard.admin-panel.accountSessionRegis.index', [ 'acSessionRegis'=>$acSessionRegis ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $acSessionRegis = AccountSessionRegis::all();
        return view( 'dashboard.admin-panel.accountSessionRegis.new', [ 'acSessionRegis'=>$acSessionRegis ] );
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
            'session_name'  =>  'required|max:99',
            'start_date'    =>  'required|max:50',
            'end_date'    =>  'required|max:50',
        ];

        $message = [
            'session_name:required'  =>  'The Session Name filled must be required',
            'start_date:required'    =>  'The Start Date filled must be required',
            'end_date:required'    =>  'The End Date filled must be required',
        ];


        $this->validate($request, $rules, $message);

        $acSessionRegis = new AccountSessionRegis();

        $acSessionRegis->session_name = $request->input('session_name');
        $acSessionRegis->start_date = date('Y-m-d', strtotime($request->input('start_date')));
        $acSessionRegis->end_date = date('Y-m-d', strtotime($request->input('end_date')));
        
        $acSessionRegis->save();

        Session::flash('Success', 'Account Session has been successfully registered');

        return redirect('/dashboard/account-session-registration');

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
        $acSessionRegis = AccountSessionRegis::find($id);
        return view( 'dashboard.admin-panel.accountSessionRegis.edit', ['acSessionRegis'=>$acSessionRegis] );
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
            'session_name'  =>  'required|max:99',
            'start_date'    =>  'required|max:50',
            'end_date'    =>  'required|max:50',
        ];

        $customMessages = [
            'session_name:required' => 'The Session Name field is required.',
            'start_date:required' => 'The Start-Date field is required.',
            'end_date:required' => 'The End-Date field is required.',
        ];

        $this->validate($request, $rules, $customMessages);
        $acSessionRegis = AccountSessionRegis::find($id);

        if( $request->has('session_name') ){
            $acSessionRegis->session_name = $request->input('session_name');
        }

        if( $request->has('start_date') ){
            $acSessionRegis->start_date = date('Y-m-d', strtotime($request->input('start_date')));
        }

        if( $request->has('end_date') ){
            $acSessionRegis->end_date = date('Y-m-d', strtotime($request->input('end_date')));
        }

        $acSessionRegis->save();
        Session::flash('Success', $id.' Account Session has been successfully updated');

        return redirect('/dashboard/account-session-registration');

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
        $acSessionRegis = AccountSessionRegis::find($id);
        $acSessionRegis->delete();

        return redirect('/dashboard/account-session-registration');

    }
}
