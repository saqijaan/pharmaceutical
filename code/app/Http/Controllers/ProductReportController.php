<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductReportController extends Controller
{
    public function index()
    {
        //

//        $proRprts = DB::table('product_registrations')
//            ->select(['product_registrations.name',
//                DB::raw("IFNULL(sum(purchase_master_product_tables.quantity),0) as proQuan"),
//                DB::raw("IFNULL(sum(purchase_return_products.quantity),0) as proRtrnQuan"),
//                DB::raw("IFNULL(sum(sale_master_products.quantity),0) as salenQuan"),
//                DB::raw("IFNULL(sum(sale_return_products.quantity),0) as saleRtrnQuan")
//            ])
//            ->whereRaw(DB::raw('COUNT(*) FROM purchase_master_product_tables pmpt WHERE pmpt.item = product_registrations.name'))
//            ->groupBy('product_registrations.name')
//            ->get();

        $proRprts = DB::select('SELECT
                                    pr.`name`,
                                    IFNULL((
                                        Select sum(prp.quantity)
                                        from purchase_return_products prp 
                                        Where prp.item = pr.name
                                    ),0) as proRtrnQuan,
                                    IFNULL((
                                        Select sum(pmpt.quantity)
                                        from purchase_master_product_tables pmpt 
                                        Where pmpt.item = pr.name
                                    ),0) as proQuan,
                                    IFNULL((
                                        Select sum(smp.quantity)
                                        from sale_master_products smp
                                        Where smp.item = pr.name
                                    ),0) as salenQuan,
                                    IFNULL((
                                        Select sum(srp.quantity)
                                        from sale_return_products srp
                                        Where srp.item = pr.name
                                    ),0) as saleRtrnQuan
                                FROM
                                    `product_registrations` as pr
                                    Where 
                                        (
                                            Select count(*) from purchase_master_product_tables pmpt Where pmpt.item = pr.name
                                        ) > 0
                                        OR 
                                        (
                                            Select count(*) from purchase_return_products prp Where prp.item = pr.name
                                        ) > 0
                                        OR 
                                        (
                                            Select count(*) from sale_master_products smp Where smp.item = pr.name
                                        ) > 0
                                        OR 
                                        (
                                            Select count(*) from sale_return_products srp Where srp.item = pr.name
                                        ) > 0
                                GROUP BY
                                    pr.`name`');


        return view( 'dashboard.admin-panel.productReport.index',[ 'proRprts'=>$proRprts ] );

    }

    public function getData($from, $to){

//        dd($from);

//        $proRprts = DB::table('product_registrations')
//            ->leftJoin('purchase_master_product_tables','purchase_master_product_tables.item','=','product_registrations.name')
//            ->leftJoin('purchase_return_products','purchase_return_products.item','=','product_registrations.name')
//            ->leftJoin('sale_master_products','sale_master_products.item','=','product_registrations.name')
//            ->leftJoin('sale_return_products','sale_return_products.item','=','product_registrations.name')
//            ->select(['product_registrations.name',
//                DB::raw("IFNULL(sum(purchase_master_product_tables.quantity),0) as proQuan"),
//                DB::raw("IFNULL(sum(purchase_return_products.quantity),0) as proRtrnQuan"),
//                DB::raw("IFNULL(sum(sale_master_products.quantity),0) as salenQuan"),
//                DB::raw("IFNULL(sum(sale_return_products.quantity),0) as saleRtrnQuan")
//            ])
//            ->whereBetween('product_registrations.created_at', [$from, $to])
//            ->groupBy('product_registrations.name')->get();


        $proRprts = DB::select('SELECT 
                                    pr.`name`, 
                                    IFNULL((
                                        Select sum(prp.quantity)
                                        from purchase_return_products prp 
                                        Where prp.item = pr.name
                                    ), 0) as proRtrnQuan,
                                    IFNULL((
                                        Select sum(pmpt.quantity)
                                        from purchase_master_product_tables pmpt 
                                        Where pmpt.item = pr.name
                                    ), 0) as proQuan,
                                    IFNULL((
                                        Select sum(smp.quantity)
                                        from sale_master_products smp
                                        Where smp.item = pr.name
                                    ), 0) as salenQuan,
                                    IFNULL((
                                        Select sum(srp.quantity)
                                        from sale_return_products srp
                                        Where srp.item = pr.name
                                    ), 0) as saleRtrnQuan
                                FROM
                                    `product_registrations` as pr
                                    Where 
                                        (
                                            Select count(*) from purchase_master_product_tables pmpt Where pmpt.item = pr.name
                                        ) > 0  
                                        OR 
                                        (
                                            Select count(*) from purchase_return_products prp Where prp.item = pr.name
                                        ) > 0 
                                        OR 
                                        (
                                            Select count(*) from sale_master_products smp Where smp.item = pr.name
                                        ) > 0 
                                        OR 
                                        (
                                            Select count(*) from sale_return_products srp Where srp.item = pr.name
                                        ) > 0 
                                        OR
                                        (pr.created_at BETWEEN '.$from.' AND '.$to.')
                                GROUP BY
                                    pr.`name`
                                ');


        return response()->json( view( 'dashboard.admin-panel.productReport.getData',[ 'proRprts'=>$proRprts ] )->render());


    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }



}
