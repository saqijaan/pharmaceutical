<?php

namespace App\Http\Controllers;

use App\Accounts;
use App\BankReceipt;
use App\BankRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;

class BankReceiptController extends Controller
{

    public function view($id){
        $bnkRcpts = DB::table('bank_receipts')
            ->leftJoin('accounts as frst_acnt','bank_receipts.acnt_nme', '=', 'frst_acnt.id')
            ->leftJoin('accounts as scnd_acnt','bank_receipts.bnk_nme', '=', 'scnd_acnt.id')
            ->leftJoin('accounts as thrd_acnt','bank_receipts.bnk_rfrence', '=', 'thrd_acnt.id')
            ->select('bank_receipts.*','frst_acnt.name as acntName','scnd_acnt.name as bnkName','thrd_acnt.name as bnkRefer')
            ->where('bank_receipts.id',$id)
            ->first();
        return view( 'dashboard.admin-panel.bankReceipt.view', [ 'bnkRcpts'=>$bnkRcpts, ] );
    }

    public function downloadPDF($id){
        $bnkRcpts = DB::table('bank_receipts')
            ->leftJoin('accounts as frst_acnt','bank_receipts.acnt_nme', '=', 'frst_acnt.id')
            ->leftJoin('accounts as scnd_acnt','bank_receipts.bnk_nme', '=', 'scnd_acnt.id')
            ->leftJoin('accounts as thrd_acnt','bank_receipts.bnk_rfrence', '=', 'thrd_acnt.id')
            ->select('bank_receipts.*','frst_acnt.name as acntName','scnd_acnt.name as bnkName','thrd_acnt.name as bnkRefer')
            ->where('bank_receipts.id',$id)
            ->first();

        $pdf = PDF::loadView('dashboard.admin-panel.bankReceipt.pdf', compact('bnkRcpts'));
        return $pdf->stream('invoice.pdf');

    }

    public function index()
    {
        //
        $bnkRcpts = DB::table('bank_receipts')
            ->leftJoin('accounts as frst_acnt','bank_receipts.acnt_nme', '=', 'frst_acnt.id')
            ->leftJoin('accounts as scnd_acnt','bank_receipts.bnk_nme', '=', 'scnd_acnt.id')
            ->select('bank_receipts.*','frst_acnt.name as acntName','scnd_acnt.name as bnkName')
            ->get();
        return view('dashboard.admin-panel.bankReceipt.index', ['bnkRcpts'=>$bnkRcpts] );
    }

    public function create()
    {
        //
        $acnts = Accounts::select('id','name')->get();
//        $bnknames = BankRegister::select('id','name')->get();
        $bnknames = Accounts::where('sub_head_id', 1)->select('id','name')->get();
        $bnkRcpts = BankReceipt::get();
//        dd($acnts);
        return view('dashboard.admin-panel.bankReceipt.new', ['bnkRcpts'=>$bnkRcpts,'acnts'=>$acnts, 'bnknames'=>$bnknames ] );
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

        $bnkRcpts = new BankReceipt();

        if( $request->has('date') ){
            $bnkRcpts->date = date( 'Y,m,d', strtotime($request->input('date')));
        }
        if( $request->has('acnt_nme') ){
            $bnkRcpts->acnt_nme = $request->input('acnt_nme');
        }
//        if( $request->has('acnt_nbr') ){
//            $bnkRcpts->acnt_nbr = $request->input('acnt_nbr');
//        }
        if( $request->has('amount') ){
            $bnkRcpts->amount = $request->input('amount');
        }
        if( $request->has('detail') ){
            $bnkRcpts->detail = $request->input('detail');
        }
        if( $request->has('rmndr_dte') ){
            $bnkRcpts->rmndr_dte = $request->input('rmndr_dte');
        }
        if( $request->has('clrance_date') ){
            $bnkRcpts->clrance_date = date( 'Y,m,d', strtotime($request->input('clrance_date')));
        }
        if( $request->has('bnk_rfrence') ){
            $bnkRcpts->bnk_rfrence = $request->input('bnk_rfrence');
        }
        if( $request->has('bnk_nme') ){
            $bnkRcpts->bnk_nme = $request->input('bnk_nme');
        }
        if( $request->has('chqe_no') ){
            $bnkRcpts->chqe_no = $request->input('chqe_no');
        }


        $checkSrId = DB::table('transaction_tables')->select('sr')->max('sr');

        $srId = empty($checkSrId) ? 1 : $checkSrId+1;
        $params["account_id"] = $request->bnk_nme;
        $params["sr"] = $srId;
        $params["date"] = date( 'Y-m-d', strtotime($request->date));
        $params["detail"] = "Cash received by Bank";
        $params["dr"] = $request->amount;
        $params["cr"] = 0;
        $params["voucher_type"] = "BRV";
        $params["check_no"] = $request->chqe_no;
        $params["clearance_date"] = $request->clrance_date;
        $params["bank_name"] = $request->bnk_nme;

        if($params["sr"]){
            if(DB::table('transaction_tables')->insert($params)){
                $params["account_id"] = $request->acnt_nme;
                $params["cr"] = $request->amount;
                $params["dr"] = 0;
                DB::table('transaction_tables')->insert($params);
            }
        }
        $bnkRcpts->trans_id = $srId;
        $bnkRcpts->save();



        Session::flash("Success", "Bank Receipt has been successfully created");
        return redirect('/dashboard/bank-receipt');


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
        $bnkRcpts = BankReceipt::find($id);
        return view('dashboard.admin-panel.bankReceipt.edit', ['bnkRcpts'=>$bnkRcpts,'acnts'=>$acnts, 'bnknames'=>$bnknames] );
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

        $bnkRcpts = BankReceipt::find($id);

        if( $request->has('date') ){
            $bnkRcpts->date = date( 'Y,m,d', strtotime($request->input('date')));
        }
        if( $request->has('acnt_nme') ){
            $bnkRcpts->acnt_nme = $request->input('acnt_nme');
        }
//        if( $request->has('acnt_nbr') ){
//            $bnkRcpts->acnt_nbr = $request->input('acnt_nbr');
//        }
        if( $request->has('amount') ){
            $bnkRcpts->amount = $request->input('amount');
        }
        if( $request->has('detail') ){
            $bnkRcpts->detail = $request->input('detail');
        }
        if( $request->has('rmndr_dte') ){
            $bnkRcpts->rmndr_dte = $request->input('rmndr_dte');
        }
        if( $request->has('clrance_date') ){
            $bnkRcpts->clrance_date = date( 'Y,m,d', strtotime($request->input('clrance_date')));
        }
        if( $request->has('bnk_rfrence') ){
            $bnkRcpts->bnk_rfrence = $request->input('bnk_rfrence');
        }
        if( $request->has('bnk_nme') ){
            $bnkRcpts->bnk_nme = $request->input('bnk_nme');
        }
        if( $request->has('chqe_no') ){
            $bnkRcpts->chqe_no = $request->input('chqe_no');
        }

        $srId = $bnkRcpts->trans_id;
        $params["account_id"] = $request->bnk_nme;
        $params["sr"] = $srId;
        $params["date"] = date( 'Y,m,d', strtotime($request->date));
        $params["detail"] = "Cash received by Bank";
        $params["dr"] = $request->amount;
        $params["cr"] = 0;
        $params["voucher_type"] = "BRV";
        $params["check_no"] = $request->chqe_no;
        $params["clearance_date"] = $request->clrance_date;
        $params["bank_name"] = $request->bnk_nme;

        if($params["sr"]){
            if(DB::table('transaction_tables')->where('sr', $bnkRcpts->trans_id)->where('cr',0)->update($params)){
                $params["account_id"] = $request->acnt_nme;
                $params["cr"] = $request->amount;
                $params["dr"] = 0;
                DB::table('transaction_tables')->where('sr', $bnkRcpts->trans_id)->where('dr',0)->update($params);
            }
        }
        $bnkRcpts->trans_id = $srId;
        $bnkRcpts->update();


        Session::flash("Success", "Bank Receipt has been successfully updated");
        return redirect('/dashboard/bank-receipt');


    }

    public function destroy($id)
    {
        //
        $bnkRcpts = BankReceipt::find($id);
        $bnkRcpts->delete();

        Session::flash("Success", $id." Bank Receipt has been successfully deleted");
        return redirect('/dashboard/bank-receipt');

    }


}
