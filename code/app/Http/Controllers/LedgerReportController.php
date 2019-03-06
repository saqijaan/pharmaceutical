<?php

namespace App\Http\Controllers;

use App\Accounts;
use App\TransactionTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LedgerReportController extends Controller
{
    //
    public function index(){
        $acnts = Accounts::select('id','name')->get();
//        $lgrRprts = Accounts::get();



        $acntHead = 0;

        $transBal = 0;

        $bfrBalance = 0;

        $getLedgers = TransactionTable::whereBetween('date', [date('Y-m-d'), date('Y-m-d')])
            ->get();


        return view('/dashboard/admin-panel/ledgerReport/index',['acnts'=>$acnts, 'acntHead'=>$acntHead, 'bfrBalance'=>$bfrBalance, 'getLedgers'=>$getLedgers] );
        
    }

    public function getData(Request $request){
        $acntHead = DB::table('transaction_tables')
            ->where('transaction_tables.account_id', stripcslashes($request->where))
            ->leftJoin('accounts','transaction_tables.account_id','=','accounts.id')
            ->select('accounts.head_id','accounts.name')
            ->first();

        $transBal = TransactionTable::where('account_id', $request->where)
            ->where('date', '<', $request->from)
            ->select(
                DB::raw("IFNULL(sum(dr),0) as sumDr"),
                DB::raw("IFNULL(sum(cr),0) as sumCr")
                    )
            ->first();

        $bfrBalance = $transBal->sumDr + (-$transBal->sumCr);

        $getLedgers = TransactionTable::where('account_id',$request->where)
                        ->whereBetween('date', [$request->from, $request->to])
                        ->get();

        return response()->json( view('/dashboard/admin-panel/ledgerReport/getData', ['acntHead'=>$acntHead, 'bfrBalance'=>$bfrBalance, 'getLedgers'=>$getLedgers])->render() );


    }
}
