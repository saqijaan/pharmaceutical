




$pros = DB::table('product_registrations')->get();

$purPros = DB::table('product_registrations')
->leftJoin('purchase_master_product_tables','purchase_master_product_tables.item','=','product_registrations.name')
->select(['product_registrations.name',
DB::raw("IFNULL(sum(purchase_master_product_tables.quantity),0) as proQuan")
])
->groupBy('product_registrations.name')->get();

$proRtrns = DB::table('product_registrations')
->leftJoin('purchase_return_products','purchase_return_products.item','=','product_registrations.name')
->select(['product_registrations.name',
DB::raw("IFNULL(sum(purchase_return_products.quantity),0) as proRtrnQuan")
])
->groupBy('product_registrations.name')->get();

$sales = DB::table('product_registrations')
->leftJoin('sale_master_products','sale_master_products.item','=','product_registrations.name')
->select(['product_registrations.name',
DB::raw("IFNULL(sum(sale_master_products.quantity),0) as salenQuan")
])
->groupBy('product_registrations.name')->get();

$salesRtrns = DB::table('product_registrations')
->leftJoin('sale_return_products','sale_return_products.item','=','product_registrations.name')
->select(['product_registrations.name',
DB::raw("IFNULL(sum(sale_return_products.quantity),0) as saleRtrnQuan")
])
->groupBy('product_registrations.name')->get();

//    dd($proRprts);
return view('dashboard.admin-panel.productReport.index', ['pros'=>$pros,'purPros'=>$purPros, 'proRtrns'=>$proRtrns, 'sales'=>$sales, 'salesRtrns'=>$salesRtrns ] );







$pros = DB::table('product_registrations')->get();

$purPros = DB::table('product_registrations')
->leftJoin('purchase_master_product_tables','purchase_master_product_tables.item','=','product_registrations.name')
->select(['product_registrations.name',
DB::raw("IFNULL(sum(purchase_master_product_tables.quantity),0) as proQuan")
])
->whereBetween('purchase_master_product_tables.created_at', [$from, $to])
->groupBy('product_registrations.name')->get();

$proRtrns = DB::table('product_registrations')
->leftJoin('purchase_return_products','purchase_return_products.item','=','product_registrations.name')
->select(['product_registrations.name',
DB::raw("IFNULL(sum(purchase_return_products.quantity),0) as proRtrnQuan")
])
->whereBetween('purchase_return_products.created_at', [$from, $to])
->groupBy('product_registrations.name')->get();

$sales = DB::table('product_registrations')
->leftJoin('sale_master_products','sale_master_products.item','=','product_registrations.name')
->select(['product_registrations.name',
DB::raw("IFNULL(sum(sale_master_products.quantity),0) as salenQuan")
])
->whereBetween('sale_master_products.created_at', [$from, $to])
->groupBy('product_registrations.name')->get();

$salesRtrns = DB::table('product_registrations')
->leftJoin('sale_return_products','sale_return_products.item','=','product_registrations.name')
->select(['product_registrations.name',
DB::raw("IFNULL(sum(sale_return_products.quantity),0) as saleRtrnQuan")
])
->whereBetween('sale_return_products.created_at', [$from, $to])
->groupBy('product_registrations.name')->get();
return response()->json( view( 'dashboard.admin-panel.productReport.getData',['pros'=>$pros,'purPros'=>$purPros, 'proRtrns'=>$proRtrns, 'sales'=>$sales, 'salesRtrns'=>$salesRtrns ] )->render());



















@foreach( $pros as $pro )
@foreach( $purPros as $purPro )
@foreach( $proRtrns as $proRtrn )
@foreach( $sales as $sale )
@foreach( $salesRtrns as $salesRtrn )
@if( $pro->name == $purPro->name && $pro->name == $proRtrn->name && $pro->name == $sale->name && $pro->name == $salesRtrn->name  ) @php $stckIn = $purPro->proQuan+$salesRtrn->saleRtrnQuan; $stckOut = $proRtrn->proRtrnQuan+$sale->salenQuan; $bal = $stckIn-$stckOut; @endphp
<tr class="even pointer">
    <td> {{ $pro->name }} </td>
    <td class=" ">
        <table class="table table-striped" style="background-color: transparent;">
            <tr style="background-color: transparent;">
                <td style="width: 33.3%;background-color: transparent;">{{ !empty($purPro->proQuan) ? $purPro->proQuan : 0}}</td>
                <td style="width: 33.3%;background-color: transparent;">{{ !empty($salesRtrn->saleRtrnQuan) ? $salesRtrn->saleRtrnQuan : 0 }}</td>
                <td style="width: 33.3%;background-color: transparent;"> {{ $stckIn }} </td>
            </tr>
        </table>

    </td>
    <td class=" ">

        <table class="table table-striped" style="background-color: transparent;">
            <tr style="background-color: transparent;">
                <td style="width: 33.3%;background-color: transparent;">{{ !empty($sale->salenQuan) ? $sale->salenQuan : 0 }}</td>
                <td style="width: 33.3%;background-color: transparent;">{{ !empty($proRtrn->proRtrnQuan) ? $proRtrn->proRtrnQuan : 0  }}</td>
                <td style="width: 33.3%;background-color: transparent;">{{ $stckOut }}</td>
            </tr>
        </table>
    </td>
    <td> {{$bal}} </td>
</tr>

@endif
@endforeach
@endforeach
@endforeach
@endforeach
@endforeach















