<?php

namespace App\Http\Controllers;

use App\BrandRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BrandRegistrationController extends Controller
{


    public function view($id){
        $quizs = BrandRegistration::where('id', $id)->first();
        return view( 'dashboard.admin-panel.brandRegistrations.view', [ 'quizs'=>$quizs ] );
    }


    public function index()
    {
        //
        $brandRegistrations = BrandRegistration::all();
        return view('dashboard.admin-panel.brandRegistrations.index',[ 'brandRegistrations'=>$brandRegistrations ] );
//        return view( 'news.index', ['news'=>$news] );
    }


    public function create()
    {
        //
        return view('dashboard.admin-panel.brandRegistrations.new');
    }


    public function store(Request $request)
    {
        //

        $this->validate($request, array(
            'name'  =>  'required|max:150',
            'detail'    =>  'max:500'
        ));

        $brandRegistraions = new BrandRegistration();

        if( $request->has('name') ){
            $brandRegistraions->name = $request->input('name');
        }

        if( $request->has('detail') ){
            $brandRegistraions->detail = $request->input('detail');
        }

        $brandRegistraions->save();

        Session::flash('Success', 'Brand post has been Successfully Added');
        return redirect('/dashboard/brand-registration');


    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
        $brandRegistration = BrandRegistration::find($id);
        return view( 'dashboard.admin-panel.brandRegistrations.edit', [ 'brandRegistration'=>$brandRegistration ]);
    }


    public function update(Request $request, $id)
    {
        //
        $this->validate($request, array(
            'name'  =>  'required|max:150',
            'detail'    =>  'max:500'
        ));

        $brandRegistrations = BrandRegistration::find($id);

        if( $request->has('name') ){
            $brandRegistrations->name = $request->input('name');
        }

        if( $request->has('detail') ){
            $brandRegistrations->detail = $request->input('detail');
        }

        $brandRegistrations->update();

        Session::flash('Success', $id.' Brand Registration post has been successfully updated' );
        return redirect('/dashboard/brand-registration' );

    }


    public function destroy($id)
    {
        //

        $brandRegistrations = BrandRegistration::find($id);
        $brandRegistrations->delete();
        Session::flash("Success", ' Brand Registration post has been successfully deleted!. ');
        return redirect('/dashboard/brand-registration');
    }
}
