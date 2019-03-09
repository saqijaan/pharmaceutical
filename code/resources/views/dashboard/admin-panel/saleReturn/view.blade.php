

<div class="container" id="masterContent">
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> ID #: <span style="font-size: 16px;">{{ $saleMas->id }}</span>  </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Date: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $saleMas->date }}</p>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Invoice No.: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $saleMas->cus_invoice_no }}</p>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Customer Name: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $cusName->name }}</p>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="table-responsive">
        <table id="datatable-buttons" class="table table-striped jambo_table bulk_action dt-responsive nowrap" style="margin-bottom: 0px;">
            <thead>
            <tr class="headings">

                <th class="column-title">Sr. </th>
                <th class="column-title"> Product </th>
                <th class="column-title"> Quantity </th>
                <th class="column-title"> Sale Price </th>
                <th class="column-title"> Discount </th>
                <th class="column-title"> Total </th>
            </tr>
            </thead>

            <tbody>

            @foreach( $saleMasPros as $saleMasPro )
                <tr class="even pointer">

                    <td class=" "> {{ $saleMasPro->id }}</td>
                    <td class=" "> {{ $saleMasPro->item }} </td>
                    <td class=" "> {!! $saleMasPro->quantity !!} </td>
                    <td class=" "> {!! $saleMasPro->cost_price !!} </td>
                    <td class=" "> {!! $saleMasPro->per_item_dis !!} </td>
                    <td class=" "> {!! $saleMasPro->total !!} </td>

                </tr>
            @endforeach


            </tbody>
            <tfoot>

            <tr class="pointer">
                <td colspan="6">

                    <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Gross Total: </h3>
                    <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $saleMas->gross_total }}</p>

                </td>
            </tr>
            </tfoot>
        </table>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Net Total: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $saleMas->net_total }}</p>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Paid Amount: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $saleMas->paid_amount }}</p>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Balance Amount: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $saleMas->bal_amount }}</p>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Detail: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {!! $saleMas->detail !!}</p>
        </div>
    </div>
    <a class="btn btn-success" href="{{action('SaleReturnController@downloadPDF', $saleMas->id)}}" target="_blank">Get PDF/Print </a>
</div>
