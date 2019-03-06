<?php

namespace App\Http\Controllers;

use App\Accounts;
use App\TransactionTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class TransactionTableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $transRegis = TransactionTable::all();
        return view( 'dashboard.admin-panel.transactionRegistration.index', ['transRegis'=>$transRegis ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $accounts = Accounts::get();
        return view( 'dashboard.admin-panel.transactionRegistration.new', [ 'accounts'=>$accounts ] );

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
            'account_id'  =>  'required|max:150',
            'date'    =>  'required|max:25',
            'detail'     =>  'max:25',
            'dr'       =>  'max:25',
            'cr'   =>  'max:300',
            'voucher_type'   =>  'max:300',
            'check_no'   =>  'max:300',
            'clearance_date'   =>  'max:300',
            'bank_name'   =>  'max:300',
            'sale_invoice'   =>  'max:300',
            'purchase_invoice'   =>  'max:300',
            'image'     =>  'image|mimes:jpeg,jpg,png,gif,svg|max:10000'
        ));

        $transRegis = new TransactionTable();

        if( $request->has('account_id') ){
            $transRegis->account_id = $request->input('account_id');
        }

        if( $request->has('date') ){
            $transRegis->date = date( 'Y,m,d', strtotime($request->input('date')) );
        }

        if( $request->has('detail') ){
            $transRegis->detail = $request->input('detail');
        }

        if( $request->has('dr') ){
            $transRegis->dr = $request->input('dr');
        }

        if( $request->has('cr') ){
            $transRegis->cr = $request->input('cr');
        }

        if( $request->has('voucher_type') ){
            $transRegis->voucher_type = $request->input('voucher_type');
        }

        if( $request->has('check_no') ){
            $transRegis->check_no = $request->input('check_no');
        }

        if( $request->has('clearance_date') ){
            $transRegis->clearance_date = $request->input('clearance_date');
        }

        if( $request->has('bank_name') ){
            $transRegis->bank_name = $request->input('bank_name');
        }

        if( $request->has('sale_invoice') ){
            $transRegis->sale_invoice = $request->input('sale_invoice');
        }

        if( $request->has('purchase_invoice') ){
            $transRegis->purchase_invoice = $request->input('purchase_invoice');
        }

        if($apk_file =  $request->file('image')) {

            $ext = $apk_file->extension();
            $name = uniqid();
            $imageName = $name.'.'.$ext;
            $s_path = public_path() .'/uploads/transRegister/s';
            $m_path = public_path() .'/uploads/transRegister/m';
            if(!file_exists($s_path))
                mkdir($s_path, 777, true);
            if(!file_exists($m_path))
                mkdir($m_path, 777, true);
            Image::make($apk_file)->resize(100, 60)->save($s_path.'/'.$imageName);
            Image::make($apk_file)->resize(220, 220)->save($m_path.'/'.$imageName);
            $apk_file->move(public_path() .'/uploads/transRegister',$imageName);
            $transRegis->image = $imageName;

        }
        $transRegis->save();

        // Account table create data
        $accountRegis = new Accounts();
        if( $request->has('name') ){
            $accountRegis->name = $request->input('name');
        }
        if( $request->has('name') ){
            $accountRegis->head_id = 2;
        }
        if( $request->has('name') ){
            $accountRegis->sub_head_id = 8;
        }
        $accountRegis->save();

        // One to ONe Account table create data
        $oneToOneAcc = new OneToOneAccounts();
        if( $request->has('name') ){
            $oneToOneAcc->account_id = $accountRegis->id;
        }
        if( $request->has('name') ){
            $oneToOneAcc->employe_id = $transRegis->id;
        }
        $oneToOneAcc->save();



        Session::flash('Success','Transaction has been successfully registered!.');
        return redirect('/dashboard/transaction-registration');

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
        $transRegis = TransactionTable::find($id);
        return view( 'dashboard.admin-panel.transactionRegistration.edit', ['transRegis'=>$transRegis] );

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
            'dr'    =>  'required|max:25',
            'cr'     =>  'max:25',
            'detail'       =>  'max:25',
            'date'     =>  'unique:users',
            'voucher_type'   =>  'max:300',
            'image'     =>  'image|mimes:jpeg,jpg,png,gif,svg|max:10000'
        ));

        $transRegis = TransactionTable::find($id);

        if( $request->has('name') ){
            $transRegis->name = $request->input('name');
        }

        if( $request->has('date') ){
            $transRegis->date = $request->input('date');
        }

        if( $request->has('detail') ){
            $transRegis->detail = $request->input('detail');
        }

        if( $request->has('dr') ){
            $transRegis->dr = $request->input('dr');
        }

        if( $request->has('cr') ){
            $transRegis->cr = $request->input('cr');
        }

        if( $request->has('voucher_type') ){
            $transRegis->voucher_type = $request->input('voucher_type');
        }

        if( $request->has('check_no') ){
            $transRegis->check_no = $request->input('check_no');
        }

        if( $request->has('clearance_date') ){
            $transRegis->clearance_date = $request->input('clearance_date');
        }

        if( $request->has('bank_name') ){
            $transRegis->bank_name = $request->input('bank_name');
        }

        if( $request->has('sale_invoice') ){
            $transRegis->sale_invoice = $request->input('sale_invoice');
        }

        if( $request->has('purchase_invoice') ){
            $transRegis->purchase_invoice = $request->input('purchase_invoice');
        }

        if($apk_file =  $request->file('image')) {

            $ext = $apk_file->extension();
            $name = uniqid();
            $imageName = $name.'.'.$ext;
            $s_path = public_path() .'/uploads/transRegister/s';
            $m_path = public_path() .'/uploads/transRegister/m';
            if(!file_exists($s_path))
                mkdir($s_path, 777, true);
            if(!file_exists($m_path))
                mkdir($m_path, 777, true);
            Image::make($apk_file)->resize(100, 60)->save($s_path.'/'.$imageName);
            Image::make($apk_file)->resize(220, 220)->save($m_path.'/'.$imageName);
            $apk_file->move(public_path() .'/uploads/transRegister',$imageName);
            $transRegis->image = $imageName;

        }
        $transRegis->update();

        // Account table Update
        $get1To1Acc = OneToOneAccounts::where('employe_id', $transRegis->id)->first();
        $accountRegis = Accounts::find($get1To1Acc->account_id);
        if( $request->has('name') ){
            $accountRegis->name = $request->input('name');
        }
        if( $request->has('name') ){
            $accountRegis->head_id = 2;
        }
        if( $request->has('name') ){
            $accountRegis->sub_head_id = 8;
        }
        $accountRegis->update();

        // One to One Account table Update
        if( $request->has('name') ){
            $oneToOneAcc['account_id'] = $accountRegis->id;
        }
        if( $request->has('name') ){
            $oneToOneAcc['employe_id'] = $transRegis->id;
        }
        OneToOneAccounts::where('employe_id', $get1To1Acc->employe_id)->update($oneToOneAcc);



        Session::flash('Success', $id.' Transaction has been successfully updated!.');
        return redirect('/dashboard/transaction-registration');

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
        $transRegis = TransactionTable::find($id);
        if(\File::exists(public_path('uploads/transRegister/m/' . $transRegis->image))){
            \File::delete(public_path('uploads/transRegister/m/' . $transRegis->image));
            \File::delete(public_path('uploads/transRegister/s/' . $transRegis->image));
            \File::delete(public_path('uploads/transRegister/' . $transRegis->image));
        }
        $transRegis->delete();


        // Account table delete
        $get1To1Acc = OneToOneAccounts::where('employe_id', $id)->first();
        $accountRegis = Accounts::find($get1To1Acc->account_id);
        $accountRegis->delete();

        // One to One Account table delete
        OneToOneAccounts::where('employe_id', $get1To1Acc->employe_id)->delete();


        Session::flash('Success', $id.' Transaction has been successfully deleted!.');
        return redirect('/dashboard/transaction-registration');

    }


    public function profile($id)
    {
        //
        $transRegis   =   TransactionTable::find($id);
        return view( 'dashboard.admin-panel.transactionRegistration.transaction-profile', [ 'transRegis'=>$transRegis ] );
    }


}
