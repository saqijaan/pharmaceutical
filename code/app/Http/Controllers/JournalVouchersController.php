<?php

namespace App\Http\Controllers;

use App\Accounts;
use App\BankRegister;
use App\GeneralReceiptPayment;
use App\JournalVouchers;
use App\JournalVouchersEntries;
use App\ProductRegistration;
use App\PurchaseMaster;
use App\PurchaseMasterInvoiceImageTable;
use App\PurchaseMasterProductTable;
use App\SupplyRegistration;
use App\TransactionTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;
use PDF;

class JournalVouchersController extends Controller
{

    public function view(Request $request){
        $jrnlVchrs = DB::table('journal_vouchers_entries')
            ->leftJoin('accounts', 'journal_vouchers_entries.acnt_nme', '=', 'accounts.id')
            ->leftJoin('accounts as scnd_acnt','journal_vouchers_entries.bnk_nme', '=', 'scnd_acnt.id')
            ->leftJoin('accounts as thrd_acnt','journal_vouchers_entries.bnk_rfrence', '=', 'thrd_acnt.id')
            ->select('journal_vouchers_entries.*', 'scnd_acnt.name as bnkName', 'thrd_acnt.name as bnkRefer', 'accounts.name as acntName')
            ->where('journal_vouchers_entries.id',$request->id)
            ->first();
//        dd($jrnlVchrs);
        return view( 'dashboard.admin-panel.journalVouchers2.view', [ 'jrnlVchrs'=>$jrnlVchrs ] );

    }


    public function downloadPDF($id){
        $jrnlVchrs = DB::table('journal_vouchers_entries')
            ->leftJoin('accounts', 'journal_vouchers_entries.acnt_nme', '=', 'accounts.id')
            ->leftJoin('accounts as scnd_acnt','journal_vouchers_entries.bnk_nme', '=', 'scnd_acnt.id')
            ->leftJoin('accounts as thrd_acnt','journal_vouchers_entries.bnk_rfrence', '=', 'thrd_acnt.id')
            ->select('journal_vouchers_entries.*', 'scnd_acnt.name as bnkName', 'thrd_acnt.name as bnkRefer', 'accounts.name as acntName')
            ->where('journal_vouchers_entries.id',$id)
            ->first();

        $pdf = PDF::loadView('dashboard.admin-panel.journalVouchers2.pdf', compact('jrnlVchrs'));
        return $pdf->stream('invoice.pdf');

    }

    public function index()
    {
        $jrnlVchrs = DB::table('journal_vouchers')
            ->leftJoin('journal_vouchers_entries', 'journal_vouchers.id', '=', 'journal_vouchers_entries.jrnl_vchrs_entrs')
            ->leftJoin('accounts', 'journal_vouchers_entries.acnt_nme', '=', 'accounts.id')
            ->leftJoin('accounts as thrd_acnt','journal_vouchers_entries.bnk_nme', '=', 'thrd_acnt.id')
            ->select('journal_vouchers.date','journal_vouchers_entries.*', 'thrd_acnt.name as bnkName', 'accounts.name as acntName')
            ->get();
        return view( 'dashboard.admin-panel.journalVouchers2.index', [ 'jrnlVchrs'=>$jrnlVchrs ] );

    }

    public function create()
    {
        //
        $acnts = Accounts::get();
        $bnknames = Accounts::select('id', 'name')->get();
        return view( 'dashboard.admin-panel.journalVouchers2.new', [ 'acnts'=>$acnts, 'bnknames'=>$bnknames ] );
    }

    public function store(Request $request)
    {
        //
        $rules = [
            'date'  =>  'required|max:25',
        ];

        $messages = [
            'date.required' =>  "Date must be selected",
        ];

        $this->validate($request, $rules, $messages);

        $jrnlVchrs = new JournalVouchers();

        if( $request->has('date') ){
            $jrnlVchrs->date = date( 'Y,m,d', strtotime($request->input('date')) );
        }
        $jrnlVchrs->save();

        if( $request->has('acnt_nme') ){
            $product = array(
                'acnt_nme' => $request->get('acnt_nme'),
                'bnk_nme' => $request->get('bnk_nme'),
                'chqe_no' => $request->get('chqe_no'),
                'bnk_rfrence' => $request->get('bnk_rfrence'),
                'dr' => $request->get('dr'),
                'cr' => $request->get('cr'),
            );
            $x = 0;
            $checkSrId = DB::table('transaction_tables')->select('sr')->max('sr');

            foreach( $request->get('acnt_nme') as $item ){
                $productTable = new JournalVouchersEntries();
                $productTable->jrnl_vchrs_entrs = $jrnlVchrs->id;
                $productTable->acnt_nme = $product['acnt_nme'][$x];
                $productTable->bnk_nme = $product['bnk_nme'][$x];
                $productTable->chqe_no = $product['chqe_no'][$x];
                $productTable->bnk_rfrence = $product['bnk_rfrence'][$x];
                $productTable->dr = $product['dr'][$x];
                $productTable->cr = $product['cr'][$x];

                $srId = empty($checkSrId) ? 1 : $checkSrId+1;
                $params["account_id"] = $product['acnt_nme'][$x];
                $params["sr"] = $srId;
                $params["date"] = date( 'Y,m,d', strtotime($request->date));
                $params["detail"] = "Journal Voucher entry";
                $params["dr"] = $product['dr'][$x];
                $params["cr"] = $product['cr'][$x];
                $params["voucher_type"] = "JV";
                $params["check_no"] = $product['chqe_no'][$x];
                $params["bank_name"] = $product['bnk_nme'][$x];

                DB::table('transaction_tables')->insert($params);

                $productTable->trans_id = $srId;
                $productTable->save();


                $x++;
            }
        }



        Session::flash("Success","Journal Voucher successfully register!.");
        return redirect('/dashboard/journal-vouchers');

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
        $bnknames = Accounts::select('id','name')->get();
        $acnts = Accounts::select('id','name')->get();
        $jrnlVchrs = JournalVouchersEntries::find($id);
        return view( 'dashboard.admin-panel.journalVouchers2.edit', [ 'bnknames'=>$bnknames, 'acnts'=>$acnts, 'jrnlVchrs'=>$jrnlVchrs ] );

    }

    public function update(Request $request, $id)
    {

        $rules = [
            'acnt_nme'     =>  'required|max:25',
            'bnk_nme'       =>  'required|max:25',
            'chqe_no'   =>  'required|max:300',
            'bnk_rfrence'   =>  'required|max:300',
        ];

        $messages = [
            'acnt_nme.required'     =>  'Please select your Account Number!.',
            'bnk_nme.required'       =>  'Please select your Bank Name',
            'chqe_no.required'   =>  'please enter Cheque Number.',
            'bnk_rfrence.required'   =>  'Please select Bank Reference!.',
        ];

        $this->validate($request, $rules, $messages);

        $jrnlVchrs = JournalVouchersEntries::find($id);

        if( $request->has('acnt_nme') ){
            $jrnlVchrs->acnt_nme = $request->input('acnt_nme');
        }

        if( $request->has('bnk_nme') ){
            $jrnlVchrs->bnk_nme = $request->input('bnk_nme');
        }

        if( $request->has('chqe_no') ){
            $jrnlVchrs->chqe_no = $request->input('chqe_no');
        }

        if( $request->has('bnk_rfrence') ){
            $jrnlVchrs->bnk_rfrence = $request->input('bnk_rfrence');
        }

        if( $request->has('dr') ){
            $jrnlVchrs->dr = $request->input('dr');
        }

        if( $request->has('cr') ){
            $jrnlVchrs->cr = $request->input('cr');
        }
        $jrnlVchrs->update();

        $params["account_id"] = $request->acnt_nme;
        $params["date"] = date( 'Y,m,d', strtotime($request->date));
        $params["detail"] = "Journal Voucher entry";
        $params["dr"] = $request->dr;
        $params["cr"] = $request->cr;
        $params["voucher_type"] = "JV";
        $params["check_no"] = $request->chqe_no;
        $params["bank_name"] =$request->bnk_nme;
        $checks = TransactionTable::find($jrnlVchrs->trans_id)->get();
        foreach ($checks as $check) {
            if( $check->sr == $jrnlVchrs->trans_id && ($check->dr == $request->dr ) ) {
                DB::table('transaction_tables')->where('sr', $jrnlVchrs->trans_id)->where('dr' == $request->dr)->update($params);
                break;
            }
            if( $check->sr == $jrnlVchrs->trans_id && ($check->cr == $request->cr ) ) {
                DB::table('transaction_tables')->where('sr', $jrnlVchrs->trans_id)->where('cr' == $request->cr)->update($params);
                break;
            }
        }

        Session::flash("Success", "Journal Voucher successfully updated!.");
        return redirect('/dashboard/journal-vouchers');

    }

    public function destroy($id)
    {
        //
        $jrnlVchrs = JournalVouchersEntries::find($id)->delete();
        return redirect('/dashboard/journal-vouchers');

    }

}
