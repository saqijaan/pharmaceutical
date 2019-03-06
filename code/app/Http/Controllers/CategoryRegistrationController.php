<?php

namespace App\Http\Controllers;

use App\CategoryRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryRegistrationController extends Controller
{

    public function view($id){
        $cates = CategoryRegistration::where('id', $id)->first();
        return view( 'dashboard.admin-panel.categoryRegistrations.view', [ 'cates'=>$cates ] );
    }

    public function index()
    {
        //
        $cateRegistrations = CategoryRegistration::all();
        return view('dashboard.admin-panel.categoryRegistrations.index', ['cateRegistrations'=>$cateRegistrations]);
    }


    public function create()
    {
        //
        return view('dashboard.admin-panel.categoryRegistrations.new');
    }


    public function store(Request $request)
    {
        //
        $this->validate($request, array(
            'name'  =>  'required|max:150',
            'detail'    =>  'max:500',
        ));

        $cateRegistrations = new CategoryRegistration();

        if( $request->has('name') ){
            $cateRegistrations->name = $request->input('name');
        }

        if( $request->has('detail') ){
            $cateRegistrations->detail = $request->input('detail');
        }

        $cateRegistrations->save();

        Session::flash('Success','Category has been successfully registered');
        return redirect('/dashboard/category-registration');

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
        $cateRegistration = CategoryRegistration::find($id);
        return view( 'dashboard.admin-panel.categoryRegistrations.edit', ['cateRegistration'=>$cateRegistration]);
    }


    public function update(Request $request, $id)
    {
        //
        $this->validate($request, array(

            'name'  =>  'required|max:150',
            'detail'    =>  'max:500',
        ));

        $cateRegistrations = CategoryRegistration::find($id);

        if( $request->has('name') ){
            $cateRegistrations->name = $request->input('name');
        }

        if( $request->has('detail') ){
            $cateRegistrations->detail = $request->input('detail');
        }

        $cateRegistrations->update();

        Session::flash('Success',$id.' Category has been successfully updated');
        return redirect('/dashboard/category-registration');
    }


    public function destroy($id)
    {
        //
        $cateRegistrations = CategoryRegistration::find($id);
        $cateRegistrations->delete();

        Session::flash("Success", $id." Category has been successfully deleted");
        return redirect('/dashboard/category-registration');

    }
}
