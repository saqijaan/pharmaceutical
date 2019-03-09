@extends('index')

@section('title', 'ProTech Application')

@section('stylesheet')

    <!-- NProgress -->
    <link href="{{ asset('vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    <!-- Datatables -->
    <link href="{{ asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">

@endsection

@section('content')


    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title"><!-- page title and search bar column start -->
                <div class="title_left">
                    <h3> Sale Return </h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                        </div>
                    </div>
                </div>
            </div><!-- page title and search bar column end -->
            @include('partials.message');


            <div class="clearfix"></div>
            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2> Update Sale Products master   </h2>
                             
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <form id="demo-form2" method="post" enctype="multipart/form-data" action="{{ route('sale-return.update', [$saleMas->id] ) }}" data-parsley-validate class="form-horizontal form-label-left">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">


                                <div class="form-group calendar-exibit col-md-3 col-sm-6 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="date" style="text-align: left"> Date <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        {{--<input type="text" id="joining_date" required="required" value="{{ $employeeRegis->joining_date }}" name="joining_date" class="form-control col-md-7 col-xs-12">--}}
                                        <fieldset class="">
                                            <div class="control-group">
                                                <div class="controls">
                                                    <div class="col-md-11 xdisplay_inputx form-group has-feedback" style="padding-left: 0px;">
                                                        <input type="text" class="form-control has-feedback-left" value="{{ date( 'm,d,Y', strtotime($saleMas->date)) }}" name="date" id="single_cal2" placeholder="First Name" aria-describedby="inputSuccess2Status2">
                                                        <span class="fa fa-calendar-o form-control-feedback left" style="left: 0;" aria-hidden="true"></span>
                                                        <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>

                                <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="cus_invoice_no" style="text-align: left"> Invoice No.
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="number" id="cus_invoice_no" value="{{ $saleMas->cus_invoice_no }}" name="cus_invoice_no" maxlength="15" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="cus_name" style="text-align: left"> Customer Name </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <select class="form-control" id="cus_name" required="required" name="cus_name">
                                            <option>Choose option</option>
                                            @foreach( $supplierRegis as $supplierRegi )
                                                <option value="{{ $supplierRegi->id }}" {{ ($saleMas->cus_name == $supplierRegi->id) ? 'selected' : '' }}> {{ $supplierRegi->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="clearfix"></div>



                                <div class="table-responsive col-md-12 col-xs-12">
                                    <div class="col-md-12 col-xs-12">
                                        <table id="datatable-buttons" class="table table-striped jambo_table bulk_action dt-responsive nowrap">
                                            <thead>
                                            <tr class="headings">

                                                <th class="column-title" style="padding-top: 16px;font-weight: bold;"> Sr. </th>
                                                <th class="column-title"> Product </th>
                                                <th class="column-title"> Quantity </th>
                                                <th class="column-title"> Sale Price </th>
                                                <th class="column-title"> Discount </th>
                                                <th class="column-title"> Total </th>
                                                <th class="column-title no-link last"><span class="nobr">Action</span>
                                                </th>
                                                <th class="bulk-actions" colspan="7">
                                                    <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                                </th>
                                            </tr>
                                            </thead>

                                            <tbody id="items" class="items">
                                            <tr>
                                                <td colspan="7">
                                                    <button class="btn btn-primary add_field_button" type="button">Add Fields</button>
                                                </td>
                                            </tr>

                                                @php $x = 1; @endphp
                                                @foreach( $saleMasPros as $saleMasPro )
                                                    <tr class="row-number" data-number="{{$x}}">
                                                        <td valign="middle" style="padding-top: 15px;font-weight: bolder;">
                                                            {{$x}}
                                                        </td>
                                                        <td>
                                                            <select data-itmid="{{$x}}" class="item form-control col-md-12 col-xs-12" required="required" name="item[{{$saleMasPro->id}}]">
                                                                <option> Select Item </option>
                                                                @foreach( $products as $product )
                                                                    <option data-id="{{ $product->id }}" value="{{ $product->name }}" {{ $product->id == $saleMasPro->id ? 'selected' : '' }}> {{ $product->name }}</option>
                                                                @endforeach
                                                            </select>

                                                        </td>
                                                        <td>
                                                            <input type="number" name="quantity[{{$saleMasPro->id}}]" placeholder="Quantity" value="{{$saleMasPro->quantity}}" onKeyup="costQuantity( $(this).parent().parent('tr').data('number') )" class="quantity{{$x}} form-control col-md-12 col-xs-12">
                                                        </td>
                                                        <td>
                                                            <input type="number" name="sale_price[{{$saleMasPro->id}}]" placeholder="Sale Price" value="{{$saleMasPro->cost_price}}"  onKeyup="costQuantity( $(this).parent().parent('tr').data('number') )" class="cost-price{{$x}} form-control col-md-12 col-xs-12">
                                                        </td>
                                                        <td>
                                                            <input type="number" name="per_item_dis[{{$saleMasPro->id}}]" placeholder="Per Item Discount" value="{{$saleMasPro->per_item_dis}}" onKeyup="costQuantity( $(this).parent().parent('tr').data('number') )" class="sub-discount{{$x}} form-control col-md-12 col-xs-12" >
                                                        </td>
                                                        <td>
                                                            <input type="number" name="total[{{$saleMasPro->id}}]" placeholder="Total" readonly value="{{ $saleMasPro->total }}" data-subtotal="{{$x}}" class="sub_total cost-quantity-total{{$x}} form-control col-md-12 col-xs-12" >
                                                        </td>
                                                        <td>

                                                            <button class="btn btn remove_field btn-danger" data-rowDel="{{ $x }}" id="{{ $saleMasPro->id }}" type="button"><i class="fa fa-trash"></i></button>

                                                        </td>
                                                    </tr>

                                                    @php $x++; @endphp
                                                @endforeach



                                            </tbody>

                                            <thead>
                                                <tr class="headings">

                                                    <th class="column-title" style="padding-top: 16px;font-weight: bold;"> Sr. </th>
                                                    <th class="column-title"> Product </th>
                                                    <th class="column-title"> Quantity </th>
                                                    <th class="column-title"> Sale Price </th>
                                                    <th class="column-title"> Discount </th>
                                                    <th class="column-title"> Total </th>
                                                    <th class="column-title no-link last"><span class="nobr">Action</span>
                                                    </th>
                                                    <th class="bulk-actions" colspan="7">
                                                        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="7">

                                                        <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                            <label class="control-label col-md-12 col-sm-12 col-xs-12" for="gross_total" style="text-align: left"> Gross Total <span class="required">*</span>
                                                            </label>
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <input type="text" id="gross_total" name="gross_total" value="{{$saleMas->gross_total}}" readonly class=" gross_total form-control">
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>

                                    </div>
                                </div>

                                <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="net_total" style="text-align: left"> Net Total <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" id="net_total" name="net_total" value="{{$saleMas->net_total}}" readonly class="net_total form-control">
                                    </div>
                                </div>

                                <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="paid_amount" style="text-align: left"> Paid Amount <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" id="paid_amount" name="paid_amount" value="{{$saleMas->paid_amount}}"  onkeyup="padiAmount()" class="paid-amount form-control">
                                    </div>
                                </div>

                                <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="bal_amount" style="text-align: left"> Balance Amount <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" id="bal_amount" name="bal_amount" value="{{$saleMas->bal_amount}}" readonly class="balance form-control">
                                    </div>
                                </div>

                                <div class="clearfix"></div>


                                <div class="item form-group col-md-12 col-sm-12 col-xs-12"><!-- textarea start -->
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="detail" style="text-align: left">Detail: <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">

                                        <textarea id="detail" class="ckeditor" name="detail" placeholder="Slider Detail">
                                            {{$saleMas->detail}}
                                        </textarea>
                                    </div>
                                </div><!-- textarea end -->

                                <div id="images" class="images">
                                    @php $x = 2; @endphp
                                    @foreach( $saleMasImages as $saleMasImage )
                                        <div class="img-main-div">
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <label class="control-label col-md-12 col-sm-12 col-xs-12" for="image{{$x}}" style="text-align:left;"> {{$x}}: Invoice Image </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="file" id="image{{$x}}" name="image[{{$saleMasImage->id}}]" class="form-control col-md-7 col-xs-12">
                                                    <img src="{{ asset('uploads/saleReturnInvoiceImage/m/'.$saleMasImage->image) }}" alt="" width="60" />
                                                </div>
                                                <button class="btn remove_field btn btn-danger col-md-1 col-sm-1 col-xs-2" type="button"><i class="fa fa-trash"></i></button><div class="clear"></div>
                                            </div>
                                        </div>
                                        @php $x++ @endphp
                                    @endforeach


                                </div>

                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <button class="btn btn-primary add_images" type="button">Add More Images</button>
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-8 col-sm-6 col-xs-12 col-md-offset-3">
                                        <a href="{{ url('/sale-return') }}" class="btn btn-danger">Cancel</a>
                                        <button class="btn btn-warning" type="reset">Reset</button>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div><!-- first column end -->
            </div><!-- rown end -->



        </div>
    </div>
    <!-- /page content -->



@endsection

@section('bottom_script')

    <!-- FastClick -->
    <script src="{{ asset('vendors/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ asset('vendors/nprogress/nprogress.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('vendors/iCheck/icheck.min.js') }}"></script>
    <!-- bootstrap-datetimepicker -->
    <script src="{{ asset('vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>

<script type="text/javascript">

    function cargoDis(e){
        var majorDis = $(".major-dis").val() ? $(".major-dis").val() : 0,
                cargoChar = $(".cargoCharg").val() ? $(".cargoCharg").val() : 0,
                gross_total = $('.gross_total').val(),
                paid_amount = $('.paid-amount'),
                bal_amount = $('.balance'),
                netTotal = parseInt(gross_total) + parseInt(cargoChar) - parseInt(majorDis);
        $(".net_total").val(netTotal);
        paid_amount.val(netTotal);
        var check_bal = netTotal - paid_amount.val();
        bal_amount.val(check_bal);
    }

    function padiAmount(){
        var net_total = $('.net_total').val(),
                paid_amount = $('.paid-amount'),
                bal_amount = $('.balance');
        var check_bal = net_total - paid_amount.val();
        bal_amount.val(check_bal);
    }

    function costQuantity(e){
        var cost = $(".cost-price"+e).val() ? $(".cost-price"+e).val() : null,
                quantity = $(".quantity" + e).val() ? $(".quantity" + e).val() : 1,
                sub_total = $(".cost-quantity-total"+e).val() ? $(".cost-quantity-total"+e).val() : null,
                sub_dis = $(".sub-discount"+e).val() ? $(".sub-discount"+e).val() : 0;
//        alert(quantity);
        if( !isNaN(quantity) && quantity >= 1 ) {
            var multi = parseInt(quantity) * parseInt(cost) - parseInt(sub_dis);
            $(".cost-quantity-total" + e).val(multi);
            grossBalance(e);
            cargoDis();
            return true;
        } else {
            alert("Quantity is Empty");
            usAlert(e);
            return false;
        }
        if( parseInt(sub_total) < parseInt(sub_dis) && parseInt(cost) < parseInt(sub_dis) ){
            alert("You give discount more than Cost Price");
            usAlert(e);
            return false;
        }
    }

    function usAlert(e){
        $(".cost-price"+e).val(""),
                $(".cost-quantity-total" + e).val(""),
                $(".quantity" + e).focus(),
                $(".sub-discount" + e).val("");
        $('.gross_total').val(""),
                $('.balance').val(""),
                $('.paid-amount').val(""),
                $('.net_total').val("");
    }

    function grossBalance(e){
        var sum = 0;
        $('.sub_total').each(function() {
            var x = $(this).val(); // Get the number and make sure it exists.
            sum += parseFloat(x || 0);
        });
        $('.gross_total').val(sum);
        var net_total = $('.net_total'),
                paid_amount = $('.paid-amount'),
                bal_amount = $('.balance');
        net_total.val(sum);
        paid_amount.val(sum);
        var check_bal = net_total.val() - paid_amount.val();
        bal_amount.val(check_bal);
        return true;

    }

    function deleteRow(e) {
        var sub_total = $(".cost-quantity-total"+e).val() ? $(".cost-quantity-total"+e).val() : 0,
                majorDis = $(".major-dis").val() ? $(".major-dis").val() : 0,
                cargoChar = $(".cargoCharg").val() ? $(".cargoCharg").val() : 0,
                gross_total = $('.gross_total'),
                net_total = $('.net_total'),
                paid_amount = $('.paid-amount'),
                bal_amount = $('.balance'),
                netTotal = (parseInt(gross_total.val()) + parseInt(cargoChar)) - (parseInt(majorDis) +  parseInt(sub_total));
        gross_total.val(netTotal);
        net_total.val(netTotal);
        paid_amount.val(netTotal);
        var check_bal = netTotal - paid_amount.val();
        bal_amount.val(check_bal);
    }


    $(document).ready(function() {
        var max_fields = 20; //maximum input boxes allowed
        var wrapper = $("#items"); //Fields wrapper
        var add_button = $(".add_field_button"); //Add button ID

        var x = $('#items >tr').length != 0 ? parseInt($('#items >tr').length)+parseInt(1) : 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                var sr = x-2;
                $(wrapper).append('<tr class="row-number" data-number="'+x+'">'+
                        '<td valign="middle" style="padding-top: 15px;font-weight: bolder;">'+
                        sr+
                        '<td>'+
                        '<select data-itmid="'+x+'" class="item form-control col-md-12 col-xs-12" required="required" name="item[]">'+
                            '<option> Select Item </option>'+
                            @foreach( $products as $product )
                                '<option data-id="{{ $product->id }}" value="{{ $product->name }}"> {{ $product->name }}</option>'+
                            @endforeach
                                '</select>'+
                        '</td>'+
                        '<td>'+
                        '<input type="number" name="quantity[]" placeholder="Quantity" onKeyup="costQuantity( $(this).parent().parent(&apos;tr&apos;).data(&apos;number&apos;) )" class="quantity'+x+' form-control col-md-12 col-xs-12">'+
                        '</td>'+
                        '<td>'+
                        '<input type="number" name="sale_price[]" placeholder="Sale Price"  onKeyup="costQuantity( $(this).parent().parent(&apos;tr&apos;).data(&apos;number&apos;) )" class="cost-price'+x+' form-control col-md-12 col-xs-12">'+
                        '</td>'+
                        '<td>'+
                        '<input type="number" name="per_item_dis[]" placeholder="Per Item Discount" onKeyup="costQuantity( $(this).parent().parent(&apos;tr&apos;).data(&apos;number&apos;) )" class="sub-discount'+x+' form-control col-md-12 col-xs-12" >'+
                        '</td>'+
                        '<td>'+
                        '<input type="number" name="total[]" placeholder="Total" readonly data-subtotal="'+x+'" class="sub_total cost-quantity-total'+x+' form-control col-md-12 col-xs-12" >'+
                        '</td>'+
                        '<td>'+
                        '<button class="btn remove_field btn btn-danger" data-rowDel="'+x+'" id="'+x+'" type="button"><i class="fa fa-trash"></i></button>'+
                        '</td>'+
                        '</tr>'); //add input box
            }
        });
        $(wrapper).on("click",".remove_field", function(e){ //user click on remove field

            if( confirm("Do you want to delete this product?") == true ) {
                e.preventDefault();
                itemDelete($(this).attr('id'));
                deleteRow($(this).attr("data-rowDel"));
                $(this).parent('td').parent('tr').remove();
                x--;
            }
        });

        $(".items").on('change', '.item', function(){
            var id = $(this).find(':selected').data('id');
            var data = $(this).data("itmid");
            $.ajax({
                url: "{{ url('/dashboard/getproductsalereturnprice') }}"+"/"+id,
                data:{id: id,  "_token": "{{ csrf_token() }}"},
                type:'get',
                success:function(r){
                    $(".cost-price"+data).val(r);
                }
            });
        });

    });

    function itemDelete(e){
        var proId = e;
        $.ajax({
            url: "{{ route('sale-return-product-del') }}",
            data:{proId: proId,  "_token": "{{ csrf_token() }}"},
            type:'post',
            success:function(r){
            }
        });
    }

    $(document).ready(function() {
        var max_fields = 20; //maximum input boxes allowed
        var wrapper = $("#images"); //Fields wrapper
        var add_button = $(".add_images"); //Add button ID

        var x = 1; //initlal text box count
        var x = $('#images >.img-main-div').length != 0 ? parseInt($('#images >.img-main-div').length)+parseInt(1) : 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                var sr = x-1;
                $(wrapper).append(
                        '<div class="">'+
                        '<div class="form-group col-md-12 col-sm-12 col-xs-12">'+
                        '<label class="control-label col-md-12 col-sm-12 col-xs-12" for="image'+x+'" style="text-align:left;"> '+x+': Invoice Image </label>'+
                        '<div class="col-md-6 col-sm-6 col-xs-12">'+
                        '<input type="file" id="image'+x+'" name="image[]" class="form-control col-md-7 col-xs-12">'+
                        '</div><button class="btn remove_field btn btn-danger col-md-1 col-sm-1 col-xs-2" type="button"><i class="fa fa-trash"></i></button><div class="clear"></div>'+
                        '</div>'+
                        '</div>');
            }
        });
        $(wrapper).on("click",".remove_field", function(e){ //user click on remove field
            e.preventDefault(); $(this).parent('div').remove(); x--;
        });

    });



</script>

@endsection


