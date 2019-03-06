

<div class="container" id="masterContent">
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> ID: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $purchaseMas->id }}</p>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Date: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $purchaseMas->date }}</p>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Supplier Invoice No.: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $purchaseMas->supplier_invoice_no }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Supplier Name: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $supplierName->name }}</p>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Cargo: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $purchaseMas->cargo }}</p>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Cargo Charges: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $purchaseMas->cargo_charges }}</p>
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
                <th class="column-title"> Cost </th>
                <th class="column-title"> Discount </th>
                <th class="column-title"> Total </th>
            </tr>
            </thead>

            <tbody>

            @foreach( $purchaseMasPros as $purchaseMasPro )
                <tr class="even pointer">

                    <td class=" "> {{ $purchaseMasPro->id }}</td>
                    <td class=" "> {{ $purchaseMasPro->item }} </td>
                    <td class=" "> {!! $purchaseMasPro->quantity !!} </td>
                    <td class=" "> {!! $purchaseMasPro->cost_price !!} </td>
                    <td class=" "> {!! $purchaseMasPro->per_item_dis !!} </td>
                    <td class=" "> {!! $purchaseMasPro->total !!} </td>

                </tr>
            @endforeach


            </tbody>
            <tfoot>

            <tr class="pointer">
                <td colspan="6">

                    <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Gross Total: </h3>
                    <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $purchaseMas->gross_total }}</p>

                </td>
            </tr>
            </tfoot>
        </table>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Net Total: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $purchaseMas->net_total }}</p>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Paid Amount: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $purchaseMas->paid_amount }}</p>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Balance Amount: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $purchaseMas->bal_amount }}</p>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Detail: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $purchaseMas->detail }}</p>
        </div>
    </div>
    <a class="btn btn-success" href="{{action('PurchaseReturnController@downloadPDF', $purchaseMas->id)}}" target="_blank">Get PDF/Print </a>
</div>
