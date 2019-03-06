<?php

namespace App\Http\Controllers;

use App\Accounts;
use App\CustomerRegistration;
use App\OneToOneAccounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class CustomerRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $customerRegis = CustomerRegistration::all();
        return view( 'dashboard.admin-panel.customerRegistrations.index', ['customerRegis'=>$customerRegis] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view( 'dashboard.admin-panel.customerRegistrations.new' );

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

        $customerRegis = new CustomerRegistration();
        $customerRegis->name        = $request->input('name');
        $customerRegis->email       = $request->input('email');
        $customerRegis->nic         = $request->input('nic');
        $customerRegis->mobile      = $request->input('mobile');
        $customerRegis->phone       = $request->input('phone');
        $customerRegis->address     = $request->input('address');
        $customerRegis->username_auto=$request->input('email');
        $customerRegis->password_auto=$request->input('email');

        if($apk_file =  $request->file('image')) {

            $ext = $apk_file->extension();
            $name = uniqid();
            $imageName = $name.'.'.$ext;
            $s_path = 'uploads/customerRegister/s';
            $m_path = 'uploads/customerRegister/m';
            if(!file_exists($s_path))
                mkdir($s_path, 777, true);
            if(!file_exists($m_path))
                mkdir($m_path, 777, true);
            Image::make($apk_file)->resize(100, 60)->save($s_path.'/'.$imageName);
            Image::make($apk_file)->resize(220, 220)->save($m_path.'/'.$imageName);
            $apk_file->move('uploads/customerRegister',$imageName);
            $customerRegis->image = $imageName;

        }
        $customerRegis->save();

        // Account table create data
        $accountRegis = new Accounts();
        $accountRegis->name = $request->input('name');
        $accountRegis->head_id = 1;
        $accountRegis->sub_head_id = 3;
        $accountRegis->save();

        // One to ONe Account table create data
        $oneToOneAcc = new OneToOneAccounts();
        $oneToOneAcc->account_id = $accountRegis->id;
        $oneToOneAcc->customer_id = $customerRegis->id;
        $oneToOneAcc->save();

        Session::flash('Success','Customer has been successfully registered!.');
        return redirect('/dashboard/customer-registration');

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
        $customerRegis = CustomerRegistration::find($id);
        return view( 'dashboard.admin-panel.customerRegistrations.edit', ['customerRegis'=>$customerRegis] );

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

        $customerRegis = CustomerRegistration::find($id);
        $customerRegis->name        = $request->input('name');
        $customerRegis->email       = $request->input('email');
        $customerRegis->nic         = $request->input('nic');
        $customerRegis->mobile      = $request->input('mobile');
        $customerRegis->phone       = $request->input('phone');
        $customerRegis->address     = $request->input('address');
        $customerRegis->username_auto = $request->input('email');
        $customerRegis->password_auto = $request->input('email');

        if($apk_file =  $request->file('image')) {

            $ext = $apk_file->extension();
            $name = uniqid();
            $imageName = $name.'.'.$ext;
            $s_path = 'uploads/customerRegister/s';
            $m_path = 'uploads/customerRegister/m';
            if(!file_exists($s_path))
                mkdir($s_path, 777, true);
            if(!file_exists($m_path))
                mkdir($m_path, 777, true);
            Image::make($apk_file)->resize(100, 60)->save($s_path.'/'.$imageName);
            Image::make($apk_file)->resize(220, 220)->save($m_path.'/'.$imageName);
            $apk_file->move('uploads/customerRegister',$imageName);
            $customerRegis->image = $imageName;

        }
        $customerRegis->update();

        // Account table Update
        $get1To1Acc = OneToOneAccounts::where('customer_id', $id)->first();
        $accountRegis = Accounts::find($get1To1Acc->account_id);
        $accountRegis->name = $request->input('name');
        $accountRegis->head_id = 1;
        $accountRegis->sub_head_id = 3;
        $accountRegis->update();

        // One to One Account table Update
        $oneToOneAcc['account_id'] = $accountRegis->id;
        $oneToOneAcc['customer_id'] = $customerRegis->id;
        OneToOneAccounts::where('customer_id', $get1To1Acc->customer_id)->update($oneToOneAcc);

        Session::flash('Success', $id.' Customer has been successfully updated!.');
        return redirect('/dashboard/customer-registration');

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
        $customerRegis = CustomerRegistration::find($id);
        if(\File::exists(public_path('uploads/customerRegister/m/' . $customerRegis->image))){
            \File::delete(public_path('uploads/customerRegister/m/' . $customerRegis->image));
            \File::delete(public_path('uploads/customerRegister/s/' . $customerRegis->image));
            \File::delete(public_path('uploads/customerRegister/' . $customerRegis->image));
        }
        $customerRegis->delete();

        // Account table delete
        $get1To1Acc = OneToOneAccounts::where('customer_id', $id)->first();
        $accountRegis = Accounts::find($get1To1Acc->account_id);
        $accountRegis->delete();

        // One to One Account table delete
        OneToOneAccounts::where('customer_id', $get1To1Acc->customer_id)->delete();



        Session::flash('Success', $id.' Customer has been successfully deleted!.');
        return redirect('/dashboard/customer-registration');

    }

    public function profile($id)
    {
        //
        $customerRegis   =   CustomerRegistration::find($id);
        return view( 'dashboard.admin-panel.customerRegistrations.customer-profile', [ 'customerRegis'=>$customerRegis ] );
    }


}
