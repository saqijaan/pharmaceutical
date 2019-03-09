
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sale Invoice Detail | Protech IT Zone</title>
    <style>
        .table>tbody>tr>td,
        .table>tbody>tr>th,
        .table>tfoot>tr>td,
        .table>tfoot>tr>th,
        .table>thead>tr>td,
        .table>thead>tr>th {
            padding: 8px;
            line-height: 1.42857143;
            vertical-align: middle;
            border-top: 0px solid transparent;
        }
        .table>thead>tr>th {
            vertical-align: bottom;
            border-bottom: 2px solid #ddd;
        }
        .table-striped>tbody>tr:hover,
        .table-striped>tbody>tr:focus {
            background-color: #f9f9f9;
        }
        .table-striped>tbody>tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }
        .table-striped>tbody>tr:nth-of-type(even) {
            background-color: #fff;
        }
    </style>
</head>
<body>

<div class="container" id="masterContent" style="max-width: 900px;width: 100%;overflow:hidden;">
    <div style="width:100%;text-align:center;">
        <h2>Sale Return Invoice</h2>
    </div>
    <div class="row" style="max-width: 900px;width:100%;padding: 0 -7.5px">
        <div style="float:left;position:relative;padding: 0 7.5px">
            <h3 style="text-align: center;margin-bottom: 0;font-size: 18px;font-weight: bolder;"> Sale Return Invoice </span></h3>
        </div>
    </div>
    <div style="clear:both"></div>
    <div class="row" style="max-width: 900px;width:100%;padding: 0 -7.5px">
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> ID #: <span style="font-size: 16px;">{{ $saleMas->id }} </span></h3>
        </div>
    </div>
    <div style="clear:both"></div>
    <div class="row" style="max-width: 900px;width:100%;padding: 0 -7.5px">
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Date: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ date('d-m-Y', strtotime($saleMas->date)) }}</p>
        </div>
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Invoice No.: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $saleMas->cus_invoice_no }}</p>
        </div>
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Customer Name: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $cusName->name }}</p>
        </div>
    </div>
    <div style="clear:both"></div>

    <div class="clearfix"></div>

    <div class="table-responsive" style="max-width: 900px;width:100%;">
        <table id="datatable-buttons" class="table table-striped jambo_table bulk_action dt-responsive nowrap" style="margin-bottom: 0px;width:100%;">
            <thead style="background: rgba(52,73,94,.94);color: #ECF0F1;">
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

    <div style="clear:both"></div>
    <div class="row" style="max-width: 900px;width:100%;padding: 0 0px">
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Net Total: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $saleMas->net_total }}</p>
        </div>
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Paid Amount: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $saleMas->paid_amount }}</p>
        </div>
        <div style="clear:both"></div>
        <div style="width: 98%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Balance Amount: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $saleMas->bal_amount }}</p>
        </div>
        <div style="clear:both"></div>
        <div style="width: 98%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Detail: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {!! $saleMas->detail !!}</p>
        </div>
        <div style="clear:both"></div>
    </div>
</div>

</body>
</html>