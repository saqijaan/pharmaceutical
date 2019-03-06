<?php

namespace App\Http\Controllers;

use App\Accounts;
use App\OneToOneAccounts;
use App\SupplyRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class SupplyRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $supRegis = SupplyRegistration::all();
        return view( 'dashboard.admin-panel.supplyRegistrations.index', ['supRegis'=>$supRegis] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view( 'dashboard.admin-panel.supplyRegistrations.new' );

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

        $supRegis = new SupplyRegistration();
        $supRegis->name         = $request->input('name');
        $supRegis->email        = $request->input('email');
        $supRegis->nic          = $request->input('nic');
        $supRegis->mobile       = $request->input('mobile');
        $supRegis->phone        = $request->input('phone');
        $supRegis->address      = $request->input('address');
        $supRegis->username_auto= $request->input('email');
        $supRegis->password_auto= $request->input('email');

        if($apk_file =  $request->file('image')) {

            $ext = $apk_file->extension();
            $name = uniqid();
            $imageName = $name.'.'.$ext;
            $s_path = 'uploads/supplyRegister/s';
            $m_path = 'uploads/supplyRegister/m';
            if(!file_exists($s_path))
                mkdir($s_path, 777, true);
            if(!file_exists($m_path))
                mkdir($m_path, 777, true);
            Image::make($apk_file)->resize(100, 60)->save($s_path.'/'.$imageName);
            Image::make($apk_file)->resize(220, 220)->save($m_path.'/'.$imageName);
            $apk_file->move('uploads/supplyRegister',$imageName);
            $supRegis->image = $imageName;

        }
        $supRegis->save();

        // Account table create data
        $accountRegis = new Accounts();
        $accountRegis->name = $request->input('name');
        $accountRegis->head_id = 2;
        $accountRegis->sub_head_id = 7;
        $accountRegis->save();

        // One to ONe Account table create data
        $oneToOneAcc = new OneToOneAccounts();
        $oneToOneAcc->account_id = $accountRegis->id;
        $oneToOneAcc->supplier_id = $supRegis->id;
        $oneToOneAcc->save();



        Session::flash('Success','Supplyer has been successfully registered!.');
        return redirect('/dashboard/supply-registration');

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
        $supRegis = SupplyRegistration::find($id);
        return view( 'dashboard.admin-panel.supplyRegistrations.edit', ['supRegis'=>$supRegis] );

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

        $supRegis = SupplyRegistration::find($id);
        $supRegis->name         = $request->input('name');
        $supRegis->email        = $request->input('email');
        $supRegis->nic          = $request->input('nic');
        $supRegis->mobile       = $request->input('mobile');
        $supRegis->phone        = $request->input('phone');
        $supRegis->address      = $request->input('address');
        $supRegis->username_auto= $request->input('email');
        $supRegis->password_auto= $request->input('email');

        if($apk_file =  $request->file('image')) {

            $ext = $apk_file->extension();
            $name = uniqid();
            $imageName = $name.'.'.$ext;
            $s_path = 'uploads/supplyRegister/s';
            $m_path = 'uploads/supplyRegister/m';
            if(!file_exists($s_path))
                mkdir($s_path, 777, true);
            if(!file_exists($m_path))
                mkdir($m_path, 777, true);
            Image::make($apk_file)->resize(100, 60)->save($s_path.'/'.$imageName);
            Image::make($apk_file)->resize(220, 220)->save($m_path.'/'.$imageName);
            $apk_file->move('uploads/supplyRegister',$imageName);
            $supRegis->image = $imageName;

        }
        $supRegis->update();

        // Account table Update
        $get1To1Acc = OneToOneAccounts::where('supplier_id', $supRegis->id)->first();
        $accountRegis = Accounts::find($get1To1Acc->account_id);
        $accountRegis->name = $request->input('name');
        $accountRegis->head_id = 2;
        $accountRegis->sub_head_id = 7;
        $accountRegis->update();
        
        // One to One Account table Update
        $oneToOneAcc['account_id'] = $accountRegis->id;
        $oneToOneAcc['supplier_id'] = $supRegis->id;
        OneToOneAccounts::where('supplier_id', $get1To1Acc->supplier_id)->update($oneToOneAcc);
        
        Session::flash('Success', $id.' Supplyer has been successfully updated!.');
        return redirect('/dashboard/supply-registration');

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
        $supRegis = SupplyRegistration::find($id);
        if(\File::exists(public_path('uploads/supplyRegister/m/' . $supRegis->image))){
            \File::delete(public_path('uploads/supplyRegister/m/' . $supRegis->image));
            \File::delete(public_path('uploads/supplyRegister/s/' . $supRegis->image));
            \File::delete(public_path('uploads/supplyRegister/' . $supRegis->image));
        }
        $supRegis->delete();


        // Account table delete
        $get1To1Acc = OneToOneAccounts::where('supplier_id', $id)->first();
        $accountRegis = Accounts::find($get1To1Acc->account_id);
        $accountRegis->delete();

        // One to One Account table delete
        OneToOneAccounts::where('supplier_id', $get1To1Acc->supplier_id)->delete();


        Session::flash('Success', $id.' Supplyer has been successfully deleted!.');
        return redirect('/dashboard/supply-registration');

    }
    public function profile($id)
    {
        //
        $supRegis   =   SupplyRegistration::find($id);
        return view( 'dashboard.admin-panel.supplyRegistrations.supply-profile', [ 'supRegis'=>$supRegis ] );
    }
}
