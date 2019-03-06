<?php

namespace App\Http\Controllers;

use App\Accounts;
use App\CachPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;

class CashPaymentController extends Controller
{

    public function view($id){
//        $cshPmnts = CachPayment::where('id', $id)->first();
        $cshPmnts = DB::table('cach_payments')
            ->leftJoin('accounts as frst_acnt', 'cach_payments.acnt_nme', '=', 'frst_acnt.id')
            ->leftJoin('accounts as scnd_acnt', 'cach_payments.pmnt_to', '=', 'scnd_acnt.id')
            ->select('cach_payments.*','frst_acnt.name as cashAccount', 'scnd_acnt.name as paymentTo')
            ->where('cach_payments.id', $id)
            ->first();
        return view( 'dashboard.admin-panel.cashPayment.view', [ 'cshPmnts'=>$cshPmnts, ] );
    }

    public function downloadPDF($id){
//        $cshPmnts = CachPayment::where('id', $id)->first();
        $cshPmnts = DB::table('cach_payments')
            ->leftJoin('accounts as frst_acnt', 'cach_payments.acnt_nme', '=', 'frst_acnt.id')
            ->leftJoin('accounts as scnd_acnt', 'cach_payments.pmnt_to', '=', 'scnd_acnt.id')
            ->select('cach_payments.*','frst_acnt.name as cashAccount', 'scnd_acnt.name as paymentTo')
            ->where('cach_payments.id', $id)
            ->first();

        $pdf = PDF::loadView('dashboard.admin-panel.cashPayment.pdf', compact('cshPmnts'));
        return $pdf->stream('invoice.pdf');

    }

    public function index()
    {
        //
//        $cshPmnts = CachPayment::get();
        $cshPmnts = DB::table('cach_payments')
                    ->leftJoin('accounts as frst_acnt', 'cach_payments.acnt_nme', '=', 'frst_acnt.id')
                    ->leftJoin('accounts as scnd_acnt', 'cach_payments.pmnt_to', '=', 'scnd_acnt.id')
                    ->select('cach_payments.*','frst_acnt.name as cashAccount', 'scnd_acnt.name as paymentTo')
                    ->get();
        return view('dashboard.admin-panel.cashPayment.index', ['cshPmnts'=>$cshPmnts] );
    }

    public function create()
    {
        //
        $acnts = Accounts::select('id','name')->get();
        $cshPmnts = CachPayment::get();
//        dd($acnts);
        return view('dashboard.admin-panel.cashPayment.new', ['cshPmnts'=>$cshPmnts,'acnts'=>$acnts] );
    }

    public function store(Request $request)
    {
        //
        $rules = [
            'date'  =>  'required|max:25',
            'acnt_nme'  =>  'required|max:99',
            'pmnt_to'  =>  'required|max:150',
            'amount'  =>  'required|max:150',
            'detail'  =>  'max:500',
        ];

        $messages = [
            'acnt_nme.required' =>  "Account Name must be required",
            'date.required' =>  "Date must be selected",
            'pmnt_to.required'  =>  "Payment To must be required",
            'amount.required'   =>  "Amount must be required",

        ];

        $this->validate($request, $rules, $messages);

        $cshPmnts = new CachPayment();

        if( $request->has('date') ){
            $cshPmnts->date = date( 'Y,m,d', strtotime($request->input('date')));
        }
        if( $request->has('acnt_nme') ){
            $cshPmnts->acnt_nme = $request->input('acnt_nme');
        }
        if( $request->has('pmnt_to') ){
            $cshPmnts->pmnt_to = $request->input('pmnt_to');
        }
//        if( $request->has('acnt_nbr') ){
//            $cshPmnts->acnt_nbr = $request->input('acnt_nbr');
//        }
        if( $request->has('amount') ){
            $cshPmnts->amount = $request->input('amount');
        }
        if( $request->has('detail') ){
            $cshPmnts->detail = $request->input('detail');
        }

        $checkSrId = DB::table('transaction_tables')->select('sr')->max('sr');

        $srId = empty($checkSrId) ? 1 : $checkSrId+1;
        $params["sr"] = $srId;
        $params["account_id"] = $request->acnt_nme;
        $params["date"] = date( 'Y-m-d', strtotime($request->date));
        $params["detail"] = "Cash payment";
        $params["dr"] = 0;
        $params["cr"] = $request->amount;
        $params["voucher_type"] = "CPV";

        if($params["sr"]){
            if(DB::table('transaction_tables')->insert($params)){
                $params["account_id"] = $request->pmnt_to;
                $params["cr"] = 0;
                $params["dr"] = $request->amount;
                DB::table('transaction_tables')->insert($params);
            }
        }
        $cshPmnts->trans_id = $srId;
        $cshPmnts->save();


        Session::flash("Success", "Cash Payment has been successfully created");
        return redirect('/dashboard/cash-payment');


    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
        $acnts = Accounts::select('id','name')->get();
        $cshPmnts = CachPayment::find($id);
        return view('dashboard.admin-panel.cashPayment.edit', ['cshPmnts'=>$cshPmnts,'acnts'=>$acnts] );
    }

    public function update(Request $request, $id)
    {
        //
        $rules = [
            'date'  =>  'required|max:25',
            'acnt_nme'  =>  'required|max:99',
            'pmnt_to'  =>  'required|max:150',
            'amount'  =>  'required|max:150',
            'detail'  =>  'max:500',
        ];

        $messages = [
            'acnt_nme.required' =>  "Account Name must be required",
            'date.required' =>  "Date must be selected",
            'pmnt_to.required'  =>  "Payment To must be required",
            'amount.required'   =>  "Amount must be required",

        ];

        $this->validate($request, $rules, $messages);

        $cshPmnts = CachPayment::find($id);

        if( $request->has('date') ){
            $cshPmnts->date = date( 'Y,m,d', strtotime($request->input('date')));
        }
        if( $request->has('acnt_nme') ){
            $cshPmnts->acnt_nme = $request->input('acnt_nme');
        }
        if( $request->has('pmnt_to') ){
            $cshPmnts->pmnt_to = $request->input('pmnt_to');
        }
//        if( $request->has('acnt_nbr') ){
//            $cshPmnts->acnt_nbr = $request->input('acnt_nbr');
//        }
        if( $request->has('amount') ){
            $cshPmnts->amount = $request->input('amount');
        }
        if( $request->has('detail') ){
            $cshPmnts->detail = $request->input('detail');
        }

        $srId = $cshPmnts->trans_id;
        $params["sr"] = $srId;
        $params["account_id"] = $request->acnt_nme;
        $params["date"] = date( 'Y-m-d', strtotime($request->input('date')));
        $params["detail"] = "Cash payment";
        $params["dr"] = 0;
        $params["cr"] = $request->input('amount');
        $params["voucher_type"] = "CPV";

        if($params["sr"]){
            if(DB::table('transaction_tables')->where('sr', $cshPmnts->trans_id)->where('dr',0)->update($params)){
                $params["account_id"] = $request->pmnt_to;
                $params["cr"] = 0;
                $params["dr"] = $request->amount;

                DB::table('transaction_tables')->where('sr', $cshPmnts->trans_id)->where('cr',0)->update($params);
            }
        }
        $cshPmnts->trans_id = $srId;
        $cshPmnts->update();


        Session::flash("Success", "Cash Payment has been successfully created");
        return redirect('/dashboard/cash-payment');


    }

    public function destroy($id)
    {
        //
        $cshPmnts = CachPayment::find($id);
        $cshPmnts->delete();

        Session::flash("Success", $id." Cash Payment has been successfully deleted");
        return redirect('/dashboard/cash-payment');

    }


}
