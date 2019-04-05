<?php

namespace App\Http\Controllers;

use App\DoctorRegis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DoctorRegisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $docs = DoctorRegis::get();
        return view('dashboard.admin-panel.doctorRegis.index', ['docs'=>$docs] );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $docs = DoctorRegis::get();
        return view( 'dashboard.admin-panel.doctorRegis.new', ['docs'=>$docs] );
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
            'name'  =>  'required|max:70',
            'address' => 'required'
        ];

        $message = [
            'name:required'  =>  'The Doctor Name filled must be required',
        ];

        $this->validate($request, $rules, $message);

        $doctorRegis = new DoctorRegis();

        if( $request->has('name') ){
            $doctorRegis->name = $request->input('name');
            $doctorRegis->address = $request->input('address');
        }

        $doctorRegis->save();

        Session::flash('Success', 'Doctor has been successfully registered');

        return redirect('/dashboard/doctor-regis');

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
        $docs = DoctorRegis::find($id);
        return view( 'dashboard.admin-panel.doctorRegis.edit', ['docs'=>$docs] );
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
            'address' => 'required',
        ];

        $customMessages = [
            'name:required' => 'The Doctor Name field is required.',
        ];

        $this->validate($request, $rules, $customMessages);
        $doctorRegis = DoctorRegis::find($id);

        if( $request->has('name') ){
            $doctorRegis->name = $request->input('name');
            $doctorRegis->address = $request->input('address');
        }

        $doctorRegis->update();
        Session::flash('Success', $id.' Doctor has been successfully updated');

        return redirect('/dashboard/doctor-regis');

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
        $doctorRegis = DoctorRegis::find($id);
        $doctorRegis->delete();

        Session::flash('Success', $id.' Doctor has been successfully deleted');
        return redirect('/dashboard/doctor-regis');

    }
}
