<?php

namespace App\Http\Controllers;

use App\Accounts;
use App\CashReceipt;
use App\TransactionTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;

class CashReceiptController extends Controller
{


    public function view($id){
        $cshRcpts = DB::table('cash_receipts')
            ->leftJoin('accounts as frst_acnt','cash_receipts.acnt_nme','=','frst_acnt.id')
            ->leftJoin('accounts as scnd_acnt','cash_receipts.rcv_csh','=','scnd_acnt.id')
            ->select('cash_receipts.*','frst_acnt.name as cashAccount', 'scnd_acnt.name as rcvdFrom')
            ->where('cash_receipts.id',$id)
            ->first();
        return view( 'dashboard.admin-panel.cashReceipt.view', [ 'cshRcpts'=>$cshRcpts, ] );
    }

    public function downloadPDF($id){
        $cshRcpts = DB::table('cash_receipts')
            ->leftJoin('accounts as frst_acnt','cash_receipts.acnt_nme','=','frst_acnt.id')
            ->leftJoin('accounts as scnd_acnt','cash_receipts.rcv_csh','=','scnd_acnt.id')
            ->select('cash_receipts.*','frst_acnt.name as cashAccount', 'scnd_acnt.name as rcvdFrom')
            ->where('cash_receipts.id',$id)
            ->first();

        $pdf = PDF::loadView('dashboard.admin-panel.cashReceipt.pdf', compact('cshRcpts'));
        return $pdf->stream('invoice.pdf');

    }

    public function index()
    {
        //
//        $cshRcpts = CashReceipt::get();
        $cshRcpts = DB::table('cash_receipts')
            ->leftJoin('accounts as frst_acnt','cash_receipts.acnt_nme','=','frst_acnt.id')
            ->leftJoin('accounts as scnd_acnt','cash_receipts.rcv_csh','=','scnd_acnt.id')
            ->select('cash_receipts.*','frst_acnt.name as cashAccount', 'scnd_acnt.name as rcvdFrom')
            ->get();
        return view('dashboard.admin-panel.cashReceipt.index', ['cshRcpts'=>$cshRcpts] );
    }

    public function create()
    {
        //
        $acnts = Accounts::select('id','name')->get();
        $cshRcpts = CashReceipt::get();
        return view('dashboard.admin-panel.cashReceipt.new', ['cshRcpts'=>$cshRcpts,'acnts'=>$acnts] );
    }

    public function store(Request $request)
    {
        //
        $rules = [
            'date'  =>  'required|max:25',
            'acnt_nme'  =>  'required|max:99',
            'rcv_csh'  =>  'required|max:150',
            'amount'  =>  'required|max:150',
            'detail'  =>  'max:500',
        ];

        $messages = [
            'acnt_nme.required' =>  "Account Name must be required",
            'date.required' =>  "Date must be selected",
            'rcv_csh.required'  =>  "Receive Cash filled must be required",
            'amount.required'   =>  "Amount must be required",

        ];

        $this->validate($request, $rules, $messages);

        $cshRcpts = new CashReceipt();

        if( $request->has('date') ){
            $cshRcpts->date = date( 'Y,m,d', strtotime($request->input('date')));
        }
        if( $request->has('acnt_nme') ){
            $cshRcpts->acnt_nme = $request->input('acnt_nme');
        }
        if( $request->has('rcv_csh') ){
            $cshRcpts->rcv_csh = $request->input('rcv_csh');
        }
//        if( $request->has('acnt_nbr') ){
//            $cshRcpts->acnt_nbr = $request->input('acnt_nbr');
//        }
        if( $request->has('amount') ){
            $cshRcpts->amount = $request->input('amount');
        }
        if( $request->has('detail') ){
            $cshRcpts->detail = $request->input('detail');
        }

        $checkSrId = DB::table('transaction_tables')->select('sr')->max('sr');

        $srId = empty($checkSrId) ? 1 : $checkSrId+1;
        $params["account_id"] = $request->acnt_nme;
        $params["sr"] = $srId;
        $params["date"] = date( 'Y,m,d', strtotime($request->date));
        $params["detail"] = "Cash received";
        $params["dr"] = $request->amount;
        $params["cr"] = 0;
        $params["voucher_type"] = "CRV";

        if($params["sr"]){
            if(DB::table('transaction_tables')->insert($params)){
                $params["account_id"] = $request->rcv_csh;
                $params["cr"] = $request->amount;
                $params["dr"] = 0;
                DB::table('transaction_tables')->insert($params);
            }
        }
        $cshRcpts->trans_id = $srId;
        $cshRcpts->save();


        Session::flash("Success", "Cash Receipt has been successfully created");
        return redirect('/dashboard/cash-receipt');


    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
        $acnts = Accounts::select('id','name')->get();
        $cshRcpts = CashReceipt::find($id);
        return view('dashboard.admin-panel.cashReceipt.edit', ['cshRcpts'=>$cshRcpts,'acnts'=>$acnts] );
    }

    public function update(Request $request, $id)
    {
        //
        $rules = [
            'date'  =>  'required|max:25',
            'acnt_nme'  =>  'required|max:99',
            'rcv_csh'  =>  'required|max:150',
            'amount'  =>  'required|max:150',
            'detail'  =>  'max:500',
        ];

        $messages = [
            'acnt_nme.required' =>  "Account Name must be required",
            'date.required' =>  "Date must be selected",
            'rcv_csh.required'  =>  "Receive Cash must be required",
            'amount.required'   =>  "Amount must be required",

        ];

        $this->validate($request, $rules, $messages);

        $cshRcpts = CashReceipt::find($id);

        if( $request->has('date') ){
            $cshRcpts->date = date( 'Y,m,d', strtotime($request->input('date')));
        }
        if( $request->has('acnt_nme') ){
            $cshRcpts->acnt_nme = $request->input('acnt_nme');
        }
        if( $request->has('rcv_csh') ){
            $cshRcpts->rcv_csh = $request->input('rcv_csh');
        }
//        if( $request->has('acnt_nbr') ){
//            $cshRcpts->acnt_nbr = $request->input('acnt_nbr');
//        }
        if( $request->has('amount') ){
            $cshRcpts->amount = $request->input('amount');
        }
        if( $request->has('detail') ){
            $cshRcpts->detail = $request->input('detail');
        }

        $srId = $cshRcpts->trans_id;
        $params["account_id"] = $request->acnt_nme;
        $params["sr"] = $srId;
        $params["date"] = date( 'Y,m,d', strtotime($request->date));
        $params["detail"] = "Cash received";
        $params["dr"] = $request->amount;
        $params["cr"] = 0;
        $params["voucher_type"] = "CRV";

        if($params["sr"]){
            if(DB::table('transaction_tables')->where('sr', $cshRcpts->trans_id)->where('cr',0)->update($params)){
                $params["account_id"] = $request->rcv_csh;
                $params["cr"] = $request->amount;
                $params["dr"] = 0;
                DB::table('transaction_tables')->where('sr', $cshRcpts->trans_id)->where('dr',0)->update($params);
            }
        }
        $cshRcpts->trans_id = $srId;
        $cshRcpts->update();


        Session::flash("Success", "Cash Receipt has been successfully updated");
        return redirect('/dashboard/cash-receipt');


    }

    public function destroy($id)
    {
        //
        $cshRcpts = CashReceipt::find($id);
        $cshRcpts->delete();

        Session::flash("Success", $id." Cash Receipt has been successfully deleted");
        return redirect('/dashboard/cash-receipt');

    }
}
