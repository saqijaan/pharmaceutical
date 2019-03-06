<?php

namespace App\Http\Controllers;

use App\Accounts;
use App\BankReceipt;
use App\BankRegister;
use App\GeneralReceiptPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;

class GeneralReceiptPaymentController extends Controller
{

    public function view($id){
        $jrnlVchrs = DB::table('general_receipt_payments')
            ->leftJoin('bank_registers','general_receipt_payments.bnk_nme', '=', 'bank_registers.id')
            ->select('general_receipt_payments.*','bank_registers.name as bankName')
            ->where('general_receipt_payments.id',$id)
            ->first();
        return view( 'dashboard.admin-panel.journalVouchers.view', [ 'jrnlVchrs'=>$jrnlVchrs, ] );
    }

    public function downloadPDF($id){
        $jrnlVchrs = DB::table('general_receipt_payments')
            ->leftJoin('bank_registers','general_receipt_payments.bnk_nme', '=', 'bank_registers.id')
            ->select('general_receipt_payments.*','bank_registers.name as bankName')
            ->where('general_receipt_payments.id',$id)
            ->first();

        $pdf = PDF::loadView('dashboard.admin-panel.journalVouchers.pdf', compact('jrnlVchrs'));
        return $pdf->stream('invoice.pdf');

    }

    public function index()
    {
        //
        $jrnlVchrs = GeneralReceiptPayment::get();
        return view('dashboard.admin-panel.journalVouchers.index', ['jrnlVchrs'=>$jrnlVchrs] );
    }

    public function create()
    {
        //
        $acnts = Accounts::select('id','name')->get();
        $bnknames = BankRegister::select('id','name')->get();
        $jrnlVchrs = GeneralReceiptPayment::get();
//        dd($acnts);
        return view('dashboard.admin-panel.journalVouchers.new', ['jrnlVchrs'=>$jrnlVchrs,'acnts'=>$acnts, 'bnknames'=>$bnknames ] );
    }

    public function store(Request $request)
    {
        //
        $rules = [
            'date'  =>  'required|max:25',
            'acnt_nme'  =>  'required|max:99',
            'acnt_nbr'  =>  'required|max:150',
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
            'acnt_nbr.required'  =>  "Account Number must be required",
            'amount.required'   =>  "Amount must be required",
            'bnk_nme.required'   =>  "Bank Name must be required",
            'chqe_no.required'   =>  "Cheque Number must be required",
            'clrance_date.required'   =>  "Clearance Date must be required",
            'bnk_rfrence.required'   =>  "Bank Reference must be required",

        ];

        $this->validate($request, $rules, $messages);

        $jrnlVchrs = new GeneralReceiptPayment();

        if( $request->has('date') ){
            $jrnlVchrs->date = date( 'Y,m,d', strtotime($request->input('date')));
        }
        if( $request->has('acnt_nme') ){
            $jrnlVchrs->acnt_nme = $request->input('acnt_nme');
        }
        if( $request->has('acnt_nbr') ){
            $jrnlVchrs->acnt_nbr = $request->input('acnt_nbr');
        }
        if( $request->has('amount') ){
            $jrnlVchrs->amount = $request->input('amount');
        }
        if( $request->has('detail') ){
            $jrnlVchrs->detail = $request->input('detail');
        }
        if( $request->has('rmndr_dte') ){
            $jrnlVchrs->rmndr_dte = $request->input('rmndr_dte');
        }
        if( $request->has('clrance_date') ){
            $jrnlVchrs->clrance_date = date( 'Y,m,d', strtotime($request->input('clrance_date')));
        }
        if( $request->has('bnk_rfrence') ){
            $jrnlVchrs->bnk_rfrence = $request->input('bnk_rfrence');
        }
        if( $request->has('bnk_nme') ){
            $jrnlVchrs->bnk_nme = $request->input('bnk_nme');
        }
        if( $request->has('chqe_no') ){
            $jrnlVchrs->chqe_no = $request->input('chqe_no');
        }
        $jrnlVchrs->save();


        Session::flash("Success", "Journal Voucher has been successfully created");
        return redirect('/dashboard/journal-vouchers');


    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
        $acnts = Accounts::select('id','name')->get();
        $bnknames = BankRegister::select('id','name')->get();
        $jrnlVchrs = GeneralReceiptPayment::find($id);
        return view('dashboard.admin-panel.journalVouchers.edit', ['jrnlVchrs'=>$jrnlVchrs,'acnts'=>$acnts, 'bnknames'=>$bnknames] );
    }

    public function update(Request $request, $id)
    {
        //
        $rules = [
            'date'  =>  'required|max:25',
            'acnt_nme'  =>  'required|max:99',
            'acnt_nbr'  =>  'required|max:150',
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
            'acnt_nbr.required'  =>  "Account Number must be required",
            'amount.required'   =>  "Amount must be required",
            'bnk_nme.required'   =>  "Bank Name must be required",
            'chqe_no.required'   =>  "Cheque Number must be required",
            'clrance_date.required'   =>  "Clearance Date must be required",
            'bnk_rfrence.required'   =>  "Bank Reference must be required",

        ];

        $this->validate($request, $rules, $messages);

        $jrnlVchrs = GeneralReceiptPayment::find($id);

        if( $request->has('date') ){
            $jrnlVchrs->date = date( 'Y,m,d', strtotime($request->input('date')));
        }
        if( $request->has('acnt_nme') ){
            $jrnlVchrs->acnt_nme = $request->input('acnt_nme');
        }
        if( $request->has('acnt_nbr') ){
            $jrnlVchrs->acnt_nbr = $request->input('acnt_nbr');
        }
        if( $request->has('amount') ){
            $jrnlVchrs->amount = $request->input('amount');
        }
        if( $request->has('detail') ){
            $jrnlVchrs->detail = $request->input('detail');
        }
        if( $request->has('rmndr_dte') ){
            $jrnlVchrs->rmndr_dte = $request->input('rmndr_dte');
        }
        if( $request->has('clrance_date') ){
            $jrnlVchrs->clrance_date = date( 'Y,m,d', strtotime($request->input('clrance_date')));
        }
        if( $request->has('bnk_rfrence') ){
            $jrnlVchrs->bnk_rfrence = $request->input('bnk_rfrence');
        }
        if( $request->has('bnk_nme') ){
            $jrnlVchrs->bnk_nme = $request->input('bnk_nme');
        }
        if( $request->has('chqe_no') ){
            $jrnlVchrs->chqe_no = $request->input('chqe_no');
        }
        $jrnlVchrs->update();


        Session::flash("Success", "Journal Voucher has been successfully created");
        return redirect('/dashboard/journal-vouchers');


    }

    public function destroy($id)
    {
        $jrnlVchrs = GeneralReceiptPayment::find($id);
        $jrnlVchrs->delete();

        Session::flash("Success", $id." Journal Voucher has been successfully deleted");
        return redirect('/dashboard/journal-vouchers');

    }


}
