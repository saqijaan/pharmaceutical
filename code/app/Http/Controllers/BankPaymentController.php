<?php

namespace App\Http\Controllers;

use App\Accounts;
use App\BankPayment;
use App\BankRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;

class BankPaymentController extends Controller
{

    public function view($id){
        $bnkPmnts = DB::table('bank_payments')
            ->leftJoin('accounts as frst_acnt','bank_payments.acnt_nme', '=', 'frst_acnt.id')
            ->leftJoin('accounts as scnd_acnt','bank_payments.bnk_nme', '=', 'scnd_acnt.id')
            ->leftJoin('accounts as thrd_acnt','bank_payments.bnk_rfrence', '=', 'thrd_acnt.id')
            ->select('bank_payments.*','frst_acnt.name as acntName','scnd_acnt.name as bnkName','thrd_acnt.name as bnkRefer')
            ->where('bank_payments.id',$id)
            ->first();
        return view( 'dashboard.admin-panel.bankPayment.view', [ 'bnkPmnts'=>$bnkPmnts, ] );
    }

    public function downloadPDF($id){
        $bnkPmnts = DB::table('bank_payments')
            ->leftJoin('accounts as frst_acnt','bank_payments.acnt_nme', '=', 'frst_acnt.id')
            ->leftJoin('accounts as scnd_acnt','bank_payments.bnk_nme', '=', 'scnd_acnt.id')
            ->leftJoin('accounts as thrd_acnt','bank_payments.bnk_rfrence', '=', 'thrd_acnt.id')
            ->select('bank_payments.*','frst_acnt.name as acntName','scnd_acnt.name as bnkName','thrd_acnt.name as bnkRefer')
            ->where('bank_payments.id',$id)
            ->first();

        $pdf = PDF::loadView('dashboard.admin-panel.bankPayment.pdf', compact('bnkPmnts'));
        return $pdf->stream('invoice.pdf');

    }

    public function index()
    {
        //
        $bnkPmnts = DB::table('bank_payments')
            ->leftJoin('accounts as frst_acnt','bank_payments.acnt_nme', '=', 'frst_acnt.id')
            ->leftJoin('accounts as scnd_acnt','bank_payments.bnk_nme', '=', 'scnd_acnt.id')
            ->leftJoin('accounts as thrd_acnt','bank_payments.bnk_rfrence', '=', 'thrd_acnt.id')
            ->select('bank_payments.*','frst_acnt.name as acntName','scnd_acnt.name as bnkName','thrd_acnt.name as bnkRefer')
            ->get();
        return view('dashboard.admin-panel.bankPayment.index', ['bnkPmnts'=>$bnkPmnts] );
    }

    public function create()
    {
        //
        $acnts = Accounts::select('id','name')->get();
        $bnknames = Accounts::where('sub_head_id', 1)->select('id','name')->get();
        $bnkPmnts = BankPayment::get();
//        dd($acnts);
        return view('dashboard.admin-panel.bankPayment.new', ['bnkPmnts'=>$bnkPmnts,'acnts'=>$acnts, 'bnknames'=>$bnknames ] );
    }

    public function store(Request $request)
    {
        //
        $rules = [
            'date'  =>  'required|max:25',
            'acnt_nme'  =>  'required|max:99',
//            'acnt_nbr'  =>  'required|max:150',
            'amount'  =>  'required|max:150',
            'detail'  =>  'max:500',
            'bnk_nme'  =>  'required|max:500',
            'chqe_no'  =>  'required|max:500',
            'clrance_date'  =>  'required|max:500',
            'bnk_rfrence'  =>  'required|max:500',
            'rmndr_dte'  =>  'max:500',
        ];

        $messages = [
            'acnt_nme.required' =>  "Account Name must be required",
            'date.required' =>  "Date must be selected",
//            'acnt_nbr.required'  =>  "Account Number must be required",
            'amount.required'   =>  "Amount must be required",
            'bnk_nme.required'   =>  "Bank Name must be required",
            'chqe_no.required'   =>  "Cheque Number must be required",
            'clrance_date.required'   =>  "Clearance Date must be required",
            'bnk_rfrence.required'   =>  "Bank Reference must be required",

        ];

        $this->validate($request, $rules, $messages);

        $bnkPmnts = new BankPayment();

        if( $request->has('date') ){
            $bnkPmnts->date = date( 'Y,m,d', strtotime($request->input('date')));
        }
        if( $request->has('acnt_nme') ){
            $bnkPmnts->acnt_nme = $request->input('acnt_nme');
        }
//        if( $request->has('acnt_nbr') ){
//            $bnkPmnts->acnt_nbr = $request->input('acnt_nbr');
//        }
        if( $request->has('amount') ){
            $bnkPmnts->amount = $request->input('amount');
        }
        if( $request->has('detail') ){
            $bnkPmnts->detail = $request->input('detail');
        }
        if( $request->has('rmndr_dte') ){
            $bnkPmnts->rmndr_dte = $request->input('rmndr_dte');
        }
        if( $request->has('clrance_date') ){
            $bnkPmnts->clrance_date = date( 'Y,m,d', strtotime($request->input('clrance_date')));
        }
        if( $request->has('bnk_rfrence') ){
            $bnkPmnts->bnk_rfrence = $request->input('bnk_rfrence');
        }
        if( $request->has('bnk_nme') ){
            $bnkPmnts->bnk_nme = $request->input('bnk_nme');
        }
        if( $request->has('chqe_no') ){
            $bnkPmnts->chqe_no = $request->input('chqe_no');
        }

        $checkSrId = DB::table('transaction_tables')->select('sr')->max('sr');

        $srId = empty($checkSrId) ? 1 : $checkSrId+1;
        $params["account_id"] = $request->bnk_nme;
        $params["sr"] = $srId;
        $params["date"] = date( 'Y,m,d', strtotime($request->date));
        $params["detail"] = "Cash payment by Bank";
        $params["dr"] = 0;
        $params["cr"] = $request->amount;
        $params["voucher_type"] = "BPV";
        $params["check_no"] = $request->chqe_no;
        $params["clearance_date"] = $request->clrance_date;
        $params["bank_name"] = $request->bnk_nme;

        if($params["sr"]){
            if(DB::table('transaction_tables')->insert($params)){
                $params["account_id"] = $request->acnt_nme;
                $params["cr"] = 0;
                $params["dr"] = $request->amount;
                DB::table('transaction_tables')->insert($params);
            }
        }
        $bnkPmnts->trans_id = $srId;
        $bnkPmnts->save();


        Session::flash("Success", "Bank Payment has been successfully created");
        return redirect('/dashboard/bank-payment');


    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
        $acnts = Accounts::select('id','name')->get();
        $bnknames = Accounts::where('sub_head_id', 1)->select('id','name')->get();
        $bnkPmnts = BankPayment::find($id);
        return view('dashboard.admin-panel.bankPayment.edit', ['bnkPmnts'=>$bnkPmnts,'acnts'=>$acnts, 'bnknames'=>$bnknames] );
    }

    public function update(Request $request, $id)
    {
        //
        $rules = [
            'date'  =>  'required|max:25',
            'acnt_nme'  =>  'required|max:99',
//            'acnt_nbr'  =>  'required|max:150',
            'amount'  =>  'required|max:150',
            'detail'  =>  'max:500',
            'bnk_nme'  =>  'required|max:500',
            'chqe_no'  =>  'required|max:500',
            'clrance_date'  =>  'required|max:500',
            'bnk_rfrence'  =>  'required|max:500',
            'rmndr_dte'  =>  'max:500',
        ];

        $messages = [
            'acnt_nme.required' =>  "Account Name must be required",
            'date.required' =>  "Date must be selected",
//            'acnt_nbr.required'  =>  "Account Number must be required",
            'amount.required'   =>  "Amount must be required",
            'bnk_nme.required'   =>  "Bank Name must be required",
            'chqe_no.required'   =>  "Cheque Number must be required",
            'clrance_date.required'   =>  "Clearance Date must be required",
            'bnk_rfrence.required'   =>  "Bank Reference must be required",

        ];

        $this->validate($request, $rules, $messages);

        $bnkPmnts = BankPayment::find($id);

        if( $request->has('date') ){
            $bnkPmnts->date = date( 'Y,m,d', strtotime($request->input('date')));
        }
        if( $request->has('acnt_nme') ){
            $bnkPmnts->acnt_nme = $request->input('acnt_nme');
        }
//        if( $request->has('acnt_nbr') ){
//            $bnkPmnts->acnt_nbr = $request->input('acnt_nbr');
//        }
        if( $request->has('amount') ){
            $bnkPmnts->amount = $request->input('amount');
        }
        if( $request->has('detail') ){
            $bnkPmnts->detail = $request->input('detail');
        }
        if( $request->has('rmndr_dte') ){
            $bnkPmnts->rmndr_dte = $request->input('rmndr_dte');
        }
        if( $request->has('clrance_date') ){
            $bnkPmnts->clrance_date = date( 'Y,m,d', strtotime($request->input('clrance_date')));
        }
        if( $request->has('bnk_rfrence') ){
            $bnkPmnts->bnk_rfrence = $request->input('bnk_rfrence');
        }
        if( $request->has('bnk_nme') ){
            $bnkPmnts->bnk_nme = $request->input('bnk_nme');
        }
        if( $request->has('chqe_no') ){
            $bnkPmnts->chqe_no = $request->input('chqe_no');
        }

        $srId = $bnkPmnts->trans_id;
        $params["account_id"] = $request->bnk_nme;
        $params["sr"] = $srId;
        $params["date"] = date( 'Y,m,d', strtotime($request->date));
        $params["detail"] = "Cash payment by Bank";
        $params["dr"] = 0;
        $params["cr"] = $request->amount;
        $params["voucher_type"] = "BPV";
        $params["check_no"] = $request->chqe_no;
        $params["clearance_date"] = $request->clrance_date;
        $params["bank_name"] = $request->bnk_nme;

        if($params["sr"]){
            if(DB::table('transaction_tables')->where('sr', $bnkPmnts->trans_id)->where('dr',0)->update($params)){
                $params["account_id"] = $request->acnt_nme;
                $params["cr"] = 0;
                $params["dr"] = $request->amount;
                DB::table('transaction_tables')->where('sr', $bnkPmnts->trans_id)->where('cr',0)->update($params);
            }
        }
        $bnkPmnts->trans_id = $srId;
        $bnkPmnts->update();



        Session::flash("Success", "Bank Payment has been successfully created");
        return redirect('/dashboard/bank-payment');


    }

    public function destroy($id)
    {
        //
        $bnkPmnts = BankPayment::find($id);
        $bnkPmnts->delete();

        Session::flash("Success", $id." Bank Payment has been successfully deleted");
        return redirect('/dashboard/bank-payment');

    }


}
