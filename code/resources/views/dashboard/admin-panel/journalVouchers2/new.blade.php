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
                    <h3> Journal Vouchers </h3>
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
                            <form id="demo-form2" method="post" enctype="multipart/form-data" action="{{ route('journal-vouchers.store') }}" class="form-horizontal form-label-left">
                                @csrf


                                <div class="form-group calendar-exibit col-md-3 col-sm-6 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="date" style="text-align: left"> Date <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <fieldset class="">
                                            <div class="control-group">
                                                <div class="controls">
                                                    <div class="xdisplay_inputx form-group has-feedback" style="padding-left: 0px;">
                                                        <input type="text" class="form-control has-feedback-left" name="date" id="single_cal2" placeholder="First Name" aria-describedby="inputSuccess2Status2">
                                                        <span class="fa fa-calendar-o form-control-feedback left" style="left: 0;" aria-hidden="true"></span>
                                                        <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>

                                <div class="clearfix"></div>



                                <div class="table-responsive col-md-12 col-xs-12">
                                    <div class="col-md-12 col-xs-12">
                                        <table id="datatable-buttons" class="table table-striped jambo_table bulk_action dt-responsive nowrap">
                                            <thead>
                                            <tr class="headings">

                                                <th class="column-title" style="padding-top: 16px;font-weight: bold;"> Sr. </th>
                                                <th class="column-title"> Account Name </th>
                                                <th class="column-title"> Dr. </th>
                                                <th class="column-title"> Cr. </th>
                                                <th class="column-title"> Bank Name </th>
                                                <th class="column-title"> Cheque # </th>
                                                <th class="column-title"> Bank Reference </th>
                                                <th class="column-title no-link last"><span class="nobr">Action</span>
                                                </th>
                                                <th class="bulk-actions" colspan="7">
                                                    <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                                </th>
                                            </tr>
                                            </thead>

                                            <tbody id="items" class="items">
                                                <tr>
                                                    <td colspan="8">
                                                        <button class="btn btn-primary add_field_button" type="button">Add Fields</button>
                                                    </td>
                                                </tr>
                                            </tbody>

                                            <thead>
                                                <tr class="headings">

                                                    <th class="column-title" style="padding-top: 16px;font-weight: bold;"> Sr. </th>
                                                    <th class="column-title"> Account Name </th>
                                                    <th class="column-title"> Dr. </th>
                                                    <th class="column-title"> Cr. </th>
                                                    <th class="column-title"> Bank Name </th>
                                                    <th class="column-title"> Cheque # </th>
                                                    <th class="column-title"> Bank Reference </th>
                                                    <th class="column-title no-link last"><span class="nobr">Action</span>
                                                    </th>
                                                    <th class="bulk-actions" colspan="7">
                                                        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="8">

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

                                <div class="clearfix"></div>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-8 col-sm-6 col-xs-12 col-md-offset-3">
                                        <a href="{{ url('/dashboard/journal-vouchers') }}" class="btn btn-danger">Cancel</a>
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


<script type="text/javascript">


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
                    '<td>'+
                        '<select class="form-control col-md-12 col-xs-12" id="acnt_nme" required="required" name="acnt_nme[]">'+
                            '<option>Choose option</option>'+
                            @foreach( $acnts as $acnt )
                                '<option value="{{ $acnt->id }}"> {{ $acnt->name }}</option>'+
                            @endforeach
                        '</select>'+
                    '</td>'+
                    '<td>'+
                        '<input type="text" id="acnt_nbr" placeholder="Dr." name="dr[]" class="form-control col-md-12 col-xs-12">'+
                    '</td>'+
                    '<td>'+
                        '<input type="text" id="acnt_nbr" placeholder="Cr." name="cr[]" class="form-control col-md-12 col-xs-12">'+
                    '</td>'+
                    '<td>'+
                        '<select class="form-control col-md-12 col-xs-12" id="bnk_nme" required="required" name="bnk_nme[]">'+
                            '<option>Choose option</option>'+
                            @foreach( $bnknames as $bnkname )
                                '<option value="{{ $bnkname->id }}"> {{ $bnkname->name }}</option>'+
                            @endforeach
                        '</select>'+
                    '</td>'+
                    '<td>'+
                        '<input type="text" id="chqe_no" placeholder="Cheque No." name="chqe_no[]" class="form-control col-md-12 col-xs-12">'+
                    '</td>'+
                    '<td>'+
                        '<select class="form-control col-md-12 col-xs-12" id="bnk_rfrence" required="required" name="bnk_rfrence[]">'+
                            '<option>Choose option</option>'+
                            @foreach( $bnknames as $bnkname )
                                    '<option value="{{ $bnkname->id }}"> {{ $bnkname->name }}</option>'+
                            @endforeach
                        '</select>'+
                    '</td>'+
                    '<td>'+
                        '<button class="btn remove_field btn btn-danger" data-rowDel="'+x+'" type="button"><i class="fa fa-trash"></i></button>'+
                    '</td>'+
                    '</tr>'); //add input box
            }
        });
        $(wrapper).on("click",".remove_field", function(e){ //user click on remove field
            if( confirm("Do you want ot delete this product") === true ) {
                e.preventDefault();
                $(this).parent('td').parent('tr').remove();
                x--;
            }
        });

    });




</script>


@endsection


