<?php

namespace App\Http\Controllers;

use App\Accounts;
use App\Distributer;
use App\OneToOneAccounts;
use Illuminate\Http\Request;
use App\DistributerRegistration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class DistributerRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
            $distributerRegis = DistributerRegistration::all();
        return view( 'dashboard.admin-panel.distributerRegistrations.index', ['distributerRegis'=>$distributerRegis] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view( 'dashboard.admin-panel.distributerRegistrations.new' );

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

        $distributerRegis = new DistributerRegistration();

        if( $request->has('name') ){
            $distributerRegis->name = $request->input('name');
        }

        if( $request->has('email') ){
            $distributerRegis->email = $request->input('email');
        }

        if( $request->has('nic') ){
            $distributerRegis->nic = $request->input('nic');
        }

        if( $request->has('mobile') ){
            $distributerRegis->mobile = $request->input('mobile');
        }

        if( $request->has('phone') ){
            $distributerRegis->phone = $request->input('phone');
        }

        if( $request->has('address') ){
            $distributerRegis->address = $request->input('address');
        }

        if( $request->has('username_auto') ){
            $distributerRegis->username_auto = $request->input('username_auto');
        }

        if( $request->has('password_auto') ){
            $distributerRegis->password_auto = $request->input('password_auto');
        }

        if( $request->has('joining_date') ){
            $distributerRegis->joining_date = $request->input('joining_date');
        }

        if( $request->has('designation') ){
            $distributerRegis->designation = $request->input('designation');
        }


        if($apk_file =  $request->file('image')) {

            $ext = $apk_file->extension();
            $name = uniqid();
            $imageName = $name.'.'.$ext;
            $s_path = 'uploads/distributerRegister/s';
            $m_path = 'uploads/distributerRegister/m';
            if(!file_exists($s_path))
                mkdir($s_path, 777, true);
            if(!file_exists($m_path))
                mkdir($m_path, 777, true);
            Image::make($apk_file)->resize(100, 60)->save($s_path.'/'.$imageName);
            Image::make($apk_file)->resize(220, 220)->save($m_path.'/'.$imageName);
            $apk_file->move('uploads/distributerRegister',$imageName);
            $distributerRegis->image = $imageName;

        }
        $distributerRegis->save();

        Distributer::create([
            'id' => $distributerRegis->id,
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  bcrypt($request->password_auto)
            ]);

        // Account table create data
        $accountRegis = new Accounts();
        if( $request->has('name') ){
            $accountRegis->name = $request->input('name');
        }
        if( $request->has('name') ){
            $accountRegis->head_id = 1;
        }
        if( $request->has('name') ){
            $accountRegis->sub_head_id = 4;
        }
        $accountRegis->save();

        // One to ONe Account table create data
        $oneToOneAcc = new OneToOneAccounts();
        if( $request->has('name') ){
            $oneToOneAcc->account_id = $accountRegis->id;
        }
        if( $request->has('name') ){
            $oneToOneAcc->distributer_id = $distributerRegis->id;
        }
        $oneToOneAcc->save();


        Session::flash('Success','Distributer has been successfully registered!.');
        return redirect('/dashboard/distributer-registration');

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
        $distributerRegis = DistributerRegistration::find($id);
        return view( 'dashboard.admin-panel.distributerRegistrations.edit', ['distributerRegis'=>$distributerRegis] );

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

        $distributerRegis = DistributerRegistration::find($id);

        if( $request->has('name') ){
            $distributerRegis->name = $request->input('name');
        }

        if( $request->has('email') ){
            $distributerRegis->email = $request->input('email');
        }

        if( $request->has('nic') ){
            $distributerRegis->nic = $request->input('nic');
        }

        if( $request->has('mobile') ){
            $distributerRegis->mobile = $request->input('mobile');
        }

        if( $request->has('phone') ){
            $distributerRegis->phone = $request->input('phone');
        }

        if( $request->has('address') ){
            $distributerRegis->address = $request->input('address');
        }

        if( $request->has('username_auto') ){
            $distributerRegis->username_auto = $request->input('username_auto');
        }

        if( $request->has('password_auto') ){
            $distributerRegis->password_auto = $request->input('password_auto');
        }

        if( $request->has('joining_date') ){
            $distributerRegis->joining_date = $request->input('joining_date');
        }

        if( $request->has('designation') ){
            $distributerRegis->designation = $request->input('designation');
        }

        if($apk_file =  $request->file('image')) {

            $ext = $apk_file->extension();
            $name = uniqid();
            $imageName = $name.'.'.$ext;
            $s_path = 'uploads/distributerRegister/s';
            $m_path = 'uploads/distributerRegister/m';
            if(!file_exists($s_path))
                mkdir($s_path, 777, true);
            if(!file_exists($m_path))
                mkdir($m_path, 777, true);
            Image::make($apk_file)->resize(100, 60)->save($s_path.'/'.$imageName);
            Image::make($apk_file)->resize(220, 220)->save($m_path.'/'.$imageName);
            $apk_file->move('uploads/distributerRegister',$imageName);
            $distributerRegis->image = $imageName;

        }

        $distributerRegis->update();

        // Account table Update
        $get1To1Acc = OneToOneAccounts::where('distributer_id', $distributerRegis->id)->first();
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



        Session::flash('Success', $id.' Distributer has been successfully updated!.');
        return redirect('/dashboard/distributer-registration');

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
        $distributerRegis = DistributerRegistration::find($id);
        if(\File::exists(public_path('uploads/distributerRegister/m/' . $distributerRegis->image))){
            \File::delete(public_path('uploads/distributerRegister/m/' . $distributerRegis->image));
            \File::delete(public_path('uploads/distributerRegister/s/' . $distributerRegis->image));
            \File::delete(public_path('uploads/distributerRegister/' . $distributerRegis->image));
        }
        
        Distributer::find($distributerRegis->id)->delete();
        $distributerRegis->delete();
        // Account table delete
        $get1To1Acc = OneToOneAccounts::where('distributer_id', $id)->first();
        $accountRegis = Accounts::find($get1To1Acc->account_id);
        $accountRegis->delete();

        // One to One Account table delete
        OneToOneAccounts::where('distributer_id', $get1To1Acc->distributer_id)->delete();



        Session::flash('Success', $id.' Distributer has been successfully deleted!.');
        return redirect('/dashboard/distributer-registration');

    }

    public function login($id){
        
        Session::put('impersonate',auth()->Id());
        Auth::guard('distributer')->loginUsingId($id);
        return redirect('/dashboard/distributer-order-book');
    }

    public function profile($id)
    {
        //
        $distributerRegis   =   DistributerRegistration::find($id);
        return view( 'dashboard.admin-panel.distributerRegistrations.distributer-profile', [ 'distributerRegis'=>$distributerRegis ] );
    }
}
