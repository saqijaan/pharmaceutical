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
                    <h3> Bank Receipt </h3>
                </div>

                @include('partials.message')

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

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2> Create New <small> like Lorem Ipsum </small></h2>
                             
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <form id="demo-form2" method="post" enctype="multipart/form-data" action="{{ route('bank-receipt.store') }}" data-parsley-validate class="form-horizontal form-label-left">
                                @csrf

                                <div class="form-group calendar-exibit col-md-3 col-sm-6 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="date" style="text-align: left"> Date <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        {{--<input type="text" id="joining_date" required="required" value="{{ $employeeRegis->joining_date }}" name="joining_date" class="form-control col-md-7 col-xs-12">--}}
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
                                <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="acnt_nme" style="text-align:left;"> Account Name <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12" id="items">
                                        <select class="form-control" id="acnt_nme" required="required" name="acnt_nme">
                                            <option>Choose option</option>
                                            @foreach( $acnts as $acnt )
                                                <option value="{{ $acnt->id }}"> {{ $acnt->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{--<div class="form-group col-md-3 col-sm-6 col-xs-12">--}}
                                    {{--<label class="control-label col-md-12 col-sm-12 col-xs-12" for="acnt_nbr" style="text-align:left;"> Account Number <span class="required">*</span>--}}
                                    {{--</label>--}}
                                    {{--<div class="col-md-12 col-sm-12 col-xs-12">--}}
                                        {{--<input type="text" id="acnt_nbr" required="required" readonly name="acnt_nbr" class="form-control col-md-7 col-xs-12">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="amount" style="text-align:left;"> Amount <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" id="amount" required="required" name="amount" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-md-3 col-sm-3 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="bnk_nme" style="text-align:left;"> Bank Name </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <select class="form-control" id="bnk_nme" required="required" name="bnk_nme">
                                            <option>Choose option</option>
                                            @foreach( $bnknames as $bnkname )
                                                <option value="{{ $bnkname->id }}"> {{ $bnkname->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="chqe_no" style="text-align:left;"> Cheque #: <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12" id="items">
                                        <input type="text" id="chqe_no" required="required" name="chqe_no" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="clrance_date" style="text-align:left;"> Clearance Date: <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <fieldset class="">
                                            <div class="control-group">
                                                <div class="controls">
                                                    <div class="xdisplay_inputx form-group has-feedback" style="padding-left: 0px;">
                                                        <input type="text" class="form-control has-feedback-left" name="clrance_date" id="clearance" placeholder="First Name" aria-describedby="inputSuccess2Status2">
                                                        <span class="fa fa-calendar-o form-control-feedback left" style="left: 0;" aria-hidden="true"></span>
                                                        <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="bnk_rfrence" style="text-align:left;"> Bank Referance: <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <select class="form-control" id="bnk_rfrence" required="required" name="bnk_rfrence">
                                            <option>Choose option</option>
                                            @foreach( $bnknames as $bnkname )
                                                <option value="{{ $bnkname->id }}"> {{ $bnkname->name }}</option>
                                            @endforeach
                                        </select>
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

                                <div class="clearfix"></div>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-8 col-sm-6 col-xs-12 col-md-offset-3">
                                        <a href="{{ url('/dashboard/bank-receipt') }}" class="btn btn-danger">Cancel</a>
                                        <button class="btn btn-warning" type="reset">Reset</button>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div><!-- first column end -->
            </div><!-- rown end -->

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12"><!-- col start -->
                    <div class="x_panel">
                        <div class="x_title">
                            <h2> Bank Receipt   </h2>
                             
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">

                              

                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-striped jambo_table bulk_action dt-responsive nowrap">
                                    <thead>
                                    <tr class="headings">

                                        <th class="column-title">ID </th>
                                        <th class="column-title"> Date </th>
                                        <th class="column-title"> Account Name </th>
                                        <th class="column-title"> Account No. </th>
                                        <th class="column-title no-link last"><span class="nobr">Action</span>
                                        </th>
                                        <th class="bulk-actions" colspan="7">
                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                        </th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    @foreach( $bnkRcpts as $bnkRcpt )
                                        <tr class="even pointer">
                                            <td class=" "> {{ $bnkRcpt->id }}</td>
                                            <td class=" "> {{ $bnkRcpt->date }} </td>
                                            <td class=" "> {{ $bnkRcpt->acnt_nme  }}  </td>
                                            <td class=" "> {{ $bnkRcpt->acnt_nbr  }}  </td>
                                            <td class=" last">
                                                <a class="btn btn-primary opnBtn" data-mdlid="{{$bnkRcpt->id}}" type="button"> view </a>
                                                <a class="btn btn-primary" href="{{ route('bank-receipt.edit', $bnkRcpt->id ) }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form method="post" enctype="multipart/form-data" action="{{route('bank-receipt.destroy',$bnkRcpt->id)}}" style="display: inline">
                                                    <input name="_method" type="hidden" value="DELETE" />
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button type="submit"  class="btn btn-danger"  style="margin-left: 5px;"  onclick="return confirm('Do you want to delete ?');" ><i class="fa fa-trash-o"></i></button>
                                                </form>
                                            </td>
                                        </tr>

                                    @endforeach



                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                </div><!-- col end -->
            </div><!-- row end -->



        </div>
    </div>
    <!-- /page content -->



@endsection

@section('bottom_script')


    <script type="text/javascript">

        $(document).ready(function(){
            $('#items').on('change','#acnt_nme', function(){
                $('#acnt_nbr').val($(this).val());
            });
        });

    </script>
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
        function init_autocomplete(){
            if("undefined"!=typeof $.fn.autocomplete){
                console.log("init_autocomplete");
                var a={@foreach( $acnts as $acnt ){{$acnt->id}}:"{{$acnt->name}}",@endforeach},
                b=$.map(a,function(a,b){return{value:a,data:b}});
                $("#items").on( "click",".autocomplete-custom-append", function(){
                    $(this).autocomplete({lookup:b});
                });
            }
        }
    </script>
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

        $('#clearance').daterangepicker({
            singleDatePicker: true,
            singleClasses: "picker_2"
        }, function(start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });
    </script>

@endsection


