<?php

namespace App\Http\Controllers;

use App\Accounts;
use App\EmployeeRegistration;
use App\OneToOneAccounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class EmployeeRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $employeeRegis = EmployeeRegistration::all();
        return view( 'dashboard.admin-panel.employeeRegistrations.index', ['employeeRegis'=>$employeeRegis] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view( 'dashboard.admin-panel.employeeRegistrations.new' );

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
            'mobile'    =>  'required|max:25',
            'phone'     =>  'max:25',
            'nic'       =>  'max:25',
            'email'     =>  'unique:users',
            'address'   =>  'max:300',
            'image'     =>  'image|mimes:jpeg,jpg,png,gif,svg|max:10000'
        ));

        $employeeRegis = new EmployeeRegistration();
        $employeeRegis->name            = $request->input('name');
        $employeeRegis->email           = $request->input('email');
        $employeeRegis->nic             = $request->input('nic');
        $employeeRegis->mobile          = $request->input('mobile');
        $employeeRegis->phone           = $request->input('phone');
        $employeeRegis->address         = $request->input('address');
        $employeeRegis->username_auto   = $request->input('email');
        $employeeRegis->password_auto   = $request->input('email');
        $employeeRegis->joining_date    = $request->input('joining_date');
        $employeeRegis->designation     = $request->input('designation');

        if($apk_file =  $request->file('image')) {

            $ext = $apk_file->extension();
            $name = uniqid();
            $imageName = $name.'.'.$ext;
            $s_path = 'uploads/employeeRegister/s';
            $m_path = 'uploads/employeeRegister/m';
            if(!file_exists($s_path))
                mkdir($s_path, 777, true);
            if(!file_exists($m_path))
                mkdir($m_path, 777, true);
            Image::make($apk_file)->resize(100, 60)->save($s_path.'/'.$imageName);
            Image::make($apk_file)->resize(220, 220)->save($m_path.'/'.$imageName);
            $apk_file->move('uploads/employeeRegister',$imageName);
            $employeeRegis->image = $imageName;

        }
        $employeeRegis->save();

        // Account table create data
        $accountRegis = new Accounts();
        $accountRegis->name = $request->input('name');
        $accountRegis->head_id = 2;
        $accountRegis->sub_head_id = 8;
        $accountRegis->save();

        // One to ONe Account table create data
        $oneToOneAcc = new OneToOneAccounts();
        $oneToOneAcc->account_id = $accountRegis->id;
        $oneToOneAcc->employe_id = $employeeRegis->id;
        $oneToOneAcc->save();



        Session::flash('Success','Employee has been successfully registered!.');
        return redirect('/dashboard/employee-registration');

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
        $employeeRegis = EmployeeRegistration::find($id);
        return view( 'dashboard.admin-panel.employeeRegistrations.edit', ['employeeRegis'=>$employeeRegis] );

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
            'mobile'    =>  'required|max:25',
            'phone'     =>  'max:25',
            'nic'       =>  'max:25',
            'email'     =>  'unique:users',
            'address'   =>  'max:300',
            'image'     =>  'image|mimes:jpeg,jpg,png,gif,svg|max:10000'
        ));
        
        $employeeRegis = EmployeeRegistration::find($id);
        $employeeRegis->name        = $request->input('name');
        $employeeRegis->email       = $request->input('email');
        $employeeRegis->nic         = $request->input('nic');
        $employeeRegis->mobile      = $request->input('mobile');
        $employeeRegis->phone       = $request->input('phone');
        $employeeRegis->address     = $request->input('address');
        $employeeRegis->username_auto= $request->input('email');
        $employeeRegis->password_auto= $request->input('email');
        $employeeRegis->joining_date = $request->input('joining_date');
        $employeeRegis->designation  = $request->input('designation');

        if($apk_file =  $request->file('image')) {

            $ext = $apk_file->extension();
            $name = uniqid();
            $imageName = $name.'.'.$ext;
            $s_path = 'uploads/employeeRegister/s';
            $m_path = 'uploads/employeeRegister/m';
            if(!file_exists($s_path))
                mkdir($s_path, 777, true);
            if(!file_exists($m_path))
                mkdir($m_path, 777, true);
            Image::make($apk_file)->resize(100, 60)->save($s_path.'/'.$imageName);
            Image::make($apk_file)->resize(220, 220)->save($m_path.'/'.$imageName);
            $apk_file->move('uploads/employeeRegister',$imageName);
            $employeeRegis->image = $imageName;

        }
        $employeeRegis->update();

        // Account table Update
        $get1To1Acc = OneToOneAccounts::where('employe_id', $employeeRegis->id)->first();
        $accountRegis = Accounts::find($get1To1Acc->account_id);
        $accountRegis->name = $request->input('name');
        $accountRegis->head_id = 2;
        $accountRegis->sub_head_id = 8;
        $accountRegis->update();

        // One to One Account table Update
        $oneToOneAcc['account_id'] = $accountRegis->id;
        $oneToOneAcc['employe_id'] = $employeeRegis->id;
        OneToOneAccounts::where('employe_id', $get1To1Acc->employe_id)->update($oneToOneAcc);



        Session::flash('Success', $id.' Employee has been successfully updated!.');
        return redirect('/dashboard/employee-registration');

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
        $employeeRegis = EmployeeRegistration::find($id);
        if(\File::exists(public_path('uploads/employeeRegister/m/' . $employeeRegis->image))){
            \File::delete(public_path('uploads/employeeRegister/m/' . $employeeRegis->image));
            \File::delete(public_path('uploads/employeeRegister/s/' . $employeeRegis->image));
            \File::delete(public_path('uploads/employeeRegister/' . $employeeRegis->image));
        }
        $employeeRegis->delete();


        // Account table delete
        $get1To1Acc = OneToOneAccounts::where('employe_id', $id)->first();
        $accountRegis = Accounts::find($get1To1Acc->account_id);
        $accountRegis->delete();

        // One to One Account table delete
        OneToOneAccounts::where('employe_id', $get1To1Acc->employe_id)->delete();


        Session::flash('Success', $id.' Employee has been successfully deleted!.');
        return redirect('/dashboard/employee-registration');

    }


    public function profile($id)
    {
        //
        $employeeRegis   =   EmployeeRegistration::find($id);
        return view( 'dashboard.admin-panel.employeeRegistrations.employee-profile', [ 'employeeRegis'=>$employeeRegis ] );
    }
}
