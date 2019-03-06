<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DistributerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:distributer');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disOrderBooks = DB::table('distributer_order_books')
            ->leftJoin('distributer_registrations', 'distributer_order_books.dis_name', '=', 'distributer_registrations.id')
            ->select('distributer_order_books.*', 'distributer_registrations.name as disName')
            ->get();
        return view( 'dashboard.admin-panel.disOrderBook.index', [ 'disOrderBooks' => $disOrderBooks ] );
//        return view('dashboard.admin-panel.disOrderBook.index');
    }
}
