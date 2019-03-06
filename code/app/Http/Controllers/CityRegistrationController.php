<?php

namespace App\Http\Controllers;

use App\CityRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CityRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cityRegistrations = CityRegistration::all();
        return view( 'dashboard.admin-panel.cityRegistrations.index', ['cityRegistrations'=>$cityRegistrations] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.admin-panel.cityRegistrations.new');
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
        $this->validate($request, array(
            'name'  =>  'required|max:150',
            'detail'    =>  'max:500',
        ));

        $cityRegistrations = new cityRegistration();

        if( $request->has('name') ){
            $cityRegistrations->name = $request->input('name');
        }

        $cityRegistrations->save();

        Session::flash('Success','City has been successfully registered');
        return redirect('/dashboard/city-registration');

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
        $cityRegistrations = CityRegistration::find($id);
        return view( 'dashboard.admin-panel.cityRegistrations.edit', ['cityRegistrations'=>$cityRegistrations]);
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
        $this->validate($request, array(

            'name'  =>  'required|max:150',
        ));

        $cityRegistrations = CityRegistration::find($id);

        if( $request->has('name') ){
            $cityRegistrations->name = $request->input('name');
        }

        $cityRegistrations->update();

        Session::flash('Success',$id.' City post has been successfully updated');
        return redirect('/dashboard/city-registration');
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
        $cityRegistrations = CityRegistration::find($id);
        $cityRegistrations->delete();

        Session::flash("Success", $id." City post has been successfully deleted");
        return redirect('/dashboard/city-registration');

    }
}
