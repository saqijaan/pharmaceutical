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
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">

    <style type="text/css">
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            padding: 8px;
            line-height: 1.42857143;
            vertical-align: middle;
            border: 1px solid #ddd;
            text-align: center;
        }
        .table {
            margin-bottom: 0px;
        }
    </style>
@endsection

@section('content')


    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title"><!-- page title and search bar column start -->

                @include('partials.message')

                <div class="title_left">
                    <div class="col-md-5 col-sm-12 col-xs-12 form-group top_search">

                        {{--<a href="{{route('purchase-master.create')}}" class="btn btn-lg btn-primary waves-effect"> Create New </a>--}}
                        {{--<div class="clearfix"></div>--}}
                    </div>
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


            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12"><!-- col start -->
                    <div class="x_panel">
                        <div class="x_title">
                            <h2> Product Report   </h2>
                             
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">

                              

                            <div class="form-group calendar-exibit col-md-3 col-sm-6 col-xs-12">
                                <label class="control-label col-md-12 col-sm-12 col-xs-12" for="date" style="text-align: left"> From: <span class="required">*</span>
                                </label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <fieldset class="">
                                        <div class="control-group">
                                            <div class="controls">
                                                <div class="col-md-11 xdisplay_inputx form-group has-feedback" style="padding-left: 0px;">
                                                    <input type="text" class="form-control has-feedback-left" name="from" id="from" placeholder="First Name" aria-describedby="inputSuccess2Status2">
                                                    <span class="fa fa-calendar-o form-control-feedback left" style="left: 0;" aria-hidden="true"></span>
                                                    <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>

                            <div class="form-group calendar-exibit col-md-3 col-sm-6 col-xs-12">
                                <label class="control-label col-md-12 col-sm-12 col-xs-12" for="date" style="text-align: left"> To: <span class="required">*</span>
                                </label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <fieldset class="">
                                        <div class="control-group">
                                            <div class="controls">
                                                <div class="col-md-11 xdisplay_inputx form-group has-feedback" style="padding-left: 0px;">
                                                    <input type="text" class="form-control has-feedback-left" name="to" id="to" placeholder="To" aria-describedby="inputSuccess2Status2">
                                                    <span class="fa fa-calendar-o form-control-feedback left" style="left: 0;" aria-hidden="true"></span>
                                                    <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="clearfix"></div>


                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action dt-responsive nowrap">
                                    <thead>
                                        <tr class="headings">

                                            <th class="column-title"> Name </th>
                                            <th class="column-title" style="text-align: center;">
                                                Stock In
                                                <table class="table table-striped" style="background-color: transparent;">
                                                    <tr style="background-color: transparent;">
                                                        <th style="width: 33.3%;background-color: transparent;">Purchase Products</th>
                                                        <th style="width: 33.3%;background-color: transparent;">Sales Return</th>
                                                        <th style="width: 33.3%;background-color: transparent;">Total</th>
                                                    </tr>
                                                </table>


                                            </th>
                                            <th class="column-title" style="text-align: center;">
                                                Stock Out
                                                <table class="table table-striped" style="background-color: transparent;">
                                                    <tr style="background-color: transparent;">
                                                        <th style="width: 33.3%;background-color: transparent;">Sale Products</th>
                                                        <th style="width: 33.3%;background-color: transparent;">Products Return</th>
                                                        <th style="width: 33.3%;background-color: transparent;">Total</th>
                                                    </tr>
                                                </table>
                                            </th>
                                            <th class="column-title" style="text-align: center;">
                                                Total
                                            </th>
                                            <th class="bulk-actions" colspan="7">
                                                <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody id="approved_blade">

                                    @include( 'dashboard.admin-panel.productReport.getData',[ 'proRprts'=>$proRprts ])


                                    </tbody>

                                    <thead>
                                    <tr class="headings">

                                        <th class="column-title"> Name </th>
                                        <th class="column-title" style="text-align: center;">
                                            <table class="table table-striped" style="background-color: transparent;">
                                                <tr style="background-color: transparent;">
                                                    <th style="width: 33.3%;background-color: transparent;">Purchase Products</th>
                                                    <th style="width: 33.3%;background-color: transparent;">Sales Return</th>
                                                    <th style="width: 33.3%;background-color: transparent;">Total</th>
                                                </tr>
                                            </table>
                                            Stock In


                                        </th>
                                        <th class="column-title" style="text-align: center;">
                                            <table class="table table-striped" style="background-color: transparent;">
                                                <tr style="background-color: transparent;">
                                                    <th style="width: 33.3%;background-color: transparent;">Sale Products</th>
                                                    <th style="width: 33.3%;background-color: transparent;">Products Return</th>
                                                    <th style="width: 33.3%;background-color: transparent;">Total</th>
                                                </tr>
                                            </table>
                                            Stock Out
                                        </th>
                                        <th class="column-title" style="text-align: center;">
                                            Total
                                        </th>
                                        <th class="bulk-actions" colspan="7">
                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>


                        </div>
                    </div>
                </div><!-- col end -->
            </div><!-- row end -->



        </div>
    </div>
    <!-- /page content -->
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">OP Detail</h4>
                </div>
                <div class="modal-body">
                    ...
                </div>

            </div>
        </div>
    </div>


@endsection

@section('bottom_script')
    <script>
        $('.openBtn').on('click',function(){
            var id = $(this).data('mdlid');
            $('.modal-body').load('{{url("/dashboard/purchase-master/view/")}}'+'/'+id,function(){
                $('#myModal').modal({show:true});
            });
        });
    </script>
    <!-- FastClick -->
    <script src="{{ asset('vendors/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ asset('vendors/nprogress/nprogress.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('vendors/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
    <!-- Datatables -->
    <script src="{{ asset('vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
    <script src="{{ asset('vendors/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ asset('vendors/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('vendors/pdfmake/build/vfs_fonts.js') }}"></script>

    <script type="text/javascript">

        $('#from').daterangepicker({
            singleDatePicker: true,
            singleClasses: "picker_2",
            locale: {
                format: 'YYYY-MM-DD'
            }
        }, function(start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });
        $('#to').daterangepicker({
            singleDatePicker: true,
            singleClasses: "picker_2",
            locale: {
                format: 'YYYY-MM-DD'
            }
        }, function(start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });

        {{--$("#to").change(function(){--}}
            {{--var to = $("#to").val();--}}
            {{--var from = $("#from").val();--}}
            {{--$.ajax({--}}
                {{--url: "{{url('/prduct-report/getData')}}"+"/"+to+"/"+from,--}}
                {{--data: '',--}}
                {{--type: 'GET',--}}
                {{--dataType:'json',--}}
                {{--success: function (data) {--}}
                    {{--$('.how-vocab-quiz-blade').html(data);--}}
                {{--}--}}
            {{--});--}}
        {{--});--}}


            $('#to').change(function(){
                var to = $("#to").val();
                var from = $("#from").val();
                var url = "{{ route('report-data', ['to' => ":to",'from'=>":from" ] ) }}";
                url = url.replace(':to', to);
                url = url.replace(':from', from);
//            alert(url);
                $.ajax({
                    url: url,
                    data:{'from':from,'to':to, "_token": "{{ csrf_token() }}"},
                    type:'get',
                    success:function(r){
                        $('#approved_blade').html(r);
                    }
                });
            });


    </script>

@endsection


