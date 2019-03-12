

<div class="container" id="masterContent">
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> ID: </h3>
                <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $order->id }}</p>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Date: </h3>
                <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $order->created_at }}</p>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Order No.: </h3>
                <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $order->po_id }}</p>
            </div>
        </div>
    
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
        <a class="btn btn-success" href="{{route('admin.orders.download', $order->id)}}" target="_blank">Get PDF/Print </a>
    </div>
    