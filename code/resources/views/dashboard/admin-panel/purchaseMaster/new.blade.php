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
                    <h3> Supplier Purchase Master </h3>
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
                            <h2> Create New    </h2>
                             
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <form id="demo-form2" method="post" enctype="multipart/form-data" action="{{ route('purchase-master.store') }}" class="form-horizontal form-label-left">
                                @csrf

                                <div class="form-group calendar-exibit col-md-3 col-sm-6 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="date" style="text-align: left"> Date <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        {{--<input type="text" id="joining_date" required="required" value="{{ $employeeRegis->joining_date }}" name="joining_date" class="form-control col-md-7 col-xs-12">--}}
                                        <fieldset class="">
                                            <div class="control-group">
                                                <div class="controls">
                                                    <div class="col-md-11 xdisplay_inputx form-group has-feedback" style="padding-left: 0px;">
                                                        <input type="text" class="form-control has-feedback-left" name="date" id="single_cal2" placeholder="Data" value="{{ date('m/d/y') }}" aria-describedby="inputSuccess2Status2">
                                                        <span class="fa fa-calendar-o form-control-feedback left" style="left: 0;" aria-hidden="true"></span>
                                                        <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>

                                <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="supplier_invoice_no" style="text-align: left"> Supplier Invoice No.
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="number" id="supplier_invoice_no" name="supplier_invoice_no" value="{{ old('supplier_invoice_no',date('ymds')) }}"  maxlength="15" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="supplier_name" style="text-align: left"> Supplier Name </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <select class="form-control" id="supplier_name" required="required" name="supplier_name">
                                            <option value="">Choose option</option>
                                            @foreach( $supplierRegis as $supplierRegi )
                                                <option value="{{ $supplierRegi->id }}"> {{ $supplierRegi->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="cargo" style="text-align: left"> Cargo
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" id="cargo" name="cargo" class="form-control" required>
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
                                                <th class="column-title"> Cost </th>
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
                                            </tbody>

                                            <thead>
                                                <tr class="headings">

                                                    <th class="column-title" style="padding-top: 16px;font-weight: bold;"> Sr. </th>
                                                    <th class="column-title"> Product </th>
                                                    <th class="column-title"> Quantity </th>
                                                    <th class="column-title"> Cost </th>
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
                                                                <input type="text" id="gross_total" name="gross_total" readonly class=" gross_total form-control">
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>

                                    </div>
                                </div>

                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="cargo_charges" style="text-align: left"> Cargo Charges <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" id="cargo_charges" onkeyup="cargoDis()" name="cargo_charges" class="cargoCharg form-control">
                                    </div>
                                </div>

                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="discount" style="text-align: left"> Discount <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" id="discount" name="discount" onkeyup="cargoDis()" class="major-dis form-control">
                                    </div>
                                </div>

                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="net_total" style="text-align: left"> Net Total <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" id="net_total" name="net_total" readonly class="net_total form-control">
                                    </div>
                                </div>
                                <div class="clearfix"></div>

                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="paid_amount" style="text-align: left"> Paid Amount <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" id="paid_amount" name="paid_amount" onkeyup="padiAmount()" class="paid-amount form-control">
                                    </div>
                                </div>

                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="bal_amount" style="text-align: left"> Balance Amount <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="number" id="bal_amount" name="bal_amount" readonly class="balance form-control">
                                    </div>
                                </div>

                                <div class="clearfix"></div>


                                <div class="item form-group col-md-12 col-sm-12 col-xs-12"><!-- textarea start -->
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="detail" style="text-align: left">Detail: <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">

                                        <textarea id="detail" class="ckeditor" name="detail" placeholder="Slider Detail">

                                        </textarea>
                                    </div>
                                </div><!-- textarea end -->

                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="image" style="text-align:left;"> Invoice Image
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="file" id="image" name="image[]" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div id="images" class="images">

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
                                        <a href="/dashboard/transaction-registration" class="btn btn-danger">Cancel</a>
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
    <!-- Datatables -->
    <!-- bootstrap-datetimepicker -->
    <script src="{{ asset('vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
<!-- jQuery autocomplete -->
<script src="{{ asset('vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js') }}"></script>

<script type="text/javascript">
    {{--  function init_autocomplete(){
            if("undefined"!=typeof $.fn.autocomplete){
                console.log("init_autocomplete");
                var a={@foreach( $products as $product ){{$product->id}}:"{{$product->name}}",@endforeach},
            b=$.map(a,function(a,b){return{value:a,data:b}});
            $("#items").on( "click",".autocomplete-custom-append", function(){
                $(this).autocomplete({lookup:b});
            });
        }
    }  --}}
</script>

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
            var multi = parseInt(quantity) * parseInt(cost) - ( parseInt(quantity) * parseInt(sub_dis));
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

        var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                var sr = x-1;
                $(wrapper).append('<tr class="row-number" data-number="'+x+'">'+
                    '<td valign="middle" style="padding-top: 15px;font-weight: bolder;">'+
                        sr+
                    '</td>'+
//                    '<td>'+
//                        '<input type="text" name="item[]" placeholder="Item" class="form-control autocomplete-custom-append col-md-12 col-xs-12">'+
//                    '</td>'+
                    '<td>'+
                        '<select data-itmid="'+x+'" class="item form-control col-md-12 col-xs-12 item-picker" style="width:150px" required="required" name="item[]">'+
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
                        '<input type="number" name="cost_price[]" placeholder="Cost Price"  onKeyup="costQuantity( $(this).parent().parent(&apos;tr&apos;).data(&apos;number&apos;) )" class="cost-price'+x+' form-control col-md-12 col-xs-12">'+
                    '</td>'+
                    '<td>'+
                        '<input type="number" name="per_item_dis[]" placeholder="Per Item Discount" onKeyup="costQuantity( $(this).parent().parent(&apos;tr&apos;).data(&apos;number&apos;) )" class="sub-discount'+x+' form-control col-md-12 col-xs-12" >'+
                    '</td>'+
                    '<td>'+
                        '<input type="number" name="total[]" placeholder="Total" readonly data-subtotal="'+x+'" class="sub_total cost-quantity-total'+x+' form-control col-md-12 col-xs-12" >'+
                    '</td>'+
                    '<td>'+
                        '<button class="btn remove_field btn btn-danger" data-rowDel="'+x+'" type="button"><i class="fa fa-trash"></i></button>'+
                    '</td>'+
                    '</tr>'); //add input box
            }
            $('.item-picker').selectpicker({
                liveSearch:true,
                width : '140px'
            })
        });
        $(wrapper).on("click",".remove_field", function(e){ //user click on remove field
            if( confirm("Do you want ot delete this product") === true ) {
                e.preventDefault();
                deleteRow($(this).attr("data-rowDel"));
                $(this).parent('td').parent('tr').remove();
                x--;
            }
        });

        $(".items").on('change', '.item', function(){
            var id = $(this).find(':selected').data('id');
            var data = $(this).data("itmid");
            $.ajax({
                url: "{{ url('/dashboard/getproductcostprice') }}",
                data:{id: id,  "_token": "{{ csrf_token() }}"},
                type:'get',
                success:function(r){
                    $(".cost-price"+data).val(r);
                }
            });
        });

    });

    $(document).ready(function() {
        $('#supplier_name').selectpicker({
            liveSearch:true
        });
        var max_fields = 20; //maximum input boxes allowed
        var wrapper = $("#images"); //Fields wrapper
        var add_button = $(".add_images"); //Add button ID

        var x = 1; //initlal text box count
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


