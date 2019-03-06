
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>OP Detail | Protech IT Zone</title>
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
    <div class="row" style="max-width: 900px;width:100%;padding: 0 -7.5px">
        <div style="float:left;position:relative;padding: 0 7.5px">
            <h3 style="text-align: center;margin-bottom: 0;font-size: 18px;font-weight: bolder;"> Purchase Return Invoice </span></h3>
        </div>
    </div>
    <div style="clear:both"></div>
    <div class="row" style="max-width: 900px;width:100%;padding: 0 -7.5px">
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> ID: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $purchaseMas->id }}</p>
        </div>
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Date: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ date('d-m-Y', strtotime($purchaseMas->date)) }}</p>
        </div>
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Supplier Invoice No.: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $purchaseMas->supplier_invoice_no }}</p>
        </div>
    </div>
    <div style="clear:both"></div>
    <div class="row" style="max-width: 900px;width:100%;padding: 0 -7.5px">
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Supplier Name: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $supplierName->name }}</p>
        </div>
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Cargo: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $purchaseMas->cargo }}</p>
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

    <div style="clear:both"></div>
    <div class="row" style="max-width: 900px;width:100%;padding: 0 0px">
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Cargo Charges: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $purchaseMas->cargo_charges }}</p>
        </div>
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Net Total: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $purchaseMas->net_total }}</p>
        </div>
        <div style="clear:both"></div>
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Paid Amount: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $purchaseMas->paid_amount }}</p>
        </div>
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Balance Amount: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $purchaseMas->bal_amount }}</p>
        </div>
        <div style="clear:both"></div>
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Detail: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $purchaseMas->detail }}</p>
        </div>
        <div style="clear:both"></div>
    </div>
</div>

</body>
</html>