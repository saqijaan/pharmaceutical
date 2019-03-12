
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Detail | Protech IT Zone</title>
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
        <h2>Order Details</h2>
    </div>
    <div class="row" style="max-width: 900px;width:100%;padding: 0 -7.5px">
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> ID #: <span style="font-size: 16px;">{{ $order->id }} </span></h3>
        </div>
    </div>
    <div style="clear:both"></div>
    <div class="row" style="max-width: 900px;width:100%;padding: 0 -7.5px">
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Date: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ date('d-m-Y', strtotime($order->created_at)) }}</p>
        </div>
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Order No.: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $order->po_id }}</p>
        </div>
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Distributor Name: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $order->dist_name }}</p>
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
            </tr>
            </thead>

            <tbody>

            @foreach( $order->items as $item )
                <tr class="even pointer">

                    <td class=" "> {{ $item->id }}</td>
                    <td class=" "> {{ $item->item_name }} </td>
                    <td class=" "> {!! $item->quantity !!} </td>

                </tr>
            @endforeach


            </tbody>
        </table>
    </div>

    <div style="clear:both"></div>
</div>

</body>
</html>