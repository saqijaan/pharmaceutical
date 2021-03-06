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
                    <h3> Cash Receipt </h3>
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
                            <h2> Update Cash Receipt post   </h2>
                             
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <form id="demo-form2" method="post" enctype="multipart/form-data" action="{{ route('cash-receipt.update', [$cshRcpts->id] ) }}" data-parsley-validate class="form-horizontal form-label-left">
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
                                                    <div class="xdisplay_inputx form-group has-feedback" style="padding-left: 0px;">
                                                        <input type="text" class="form-control has-feedback-left" name="date" id="single_cal2" placeholder="First Name" value="{{date('m,d,y', strtotime($cshRcpts->date))}}" aria-describedby="inputSuccess2Status2">
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
                                                <option value="{{ $acnt->id }}" {{ $acnt->id == $cshRcpts->acnt_nme ? 'selected' : '' }}> {{ $acnt->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="rcv_csh" style="text-align:left;"> Received Cash <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12" id="items">
                                        <select class="form-control" id="rcv_csh" required="required" name="rcv_csh">
                                            <option>Choose option</option>
                                            @foreach( $acnts as $acnt )
                                                <option value="{{ $acnt->id }}" {{ $acnt->id == $cshRcpts->rcv_csh ? 'selected' : '' }}> {{ $acnt->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{--<div class="form-group col-md-3 col-sm-6 col-xs-12">--}}
                                    {{--<label class="control-label col-md-12 col-sm-12 col-xs-12" for="acnt_nbr" style="text-align:left;"> Account Number <span class="required">*</span>--}}
                                    {{--</label>--}}
                                    {{--<div class="col-md-12 col-sm-12 col-xs-12">--}}
                                        {{--<input type="text" id="acnt_nbr" readonly required="required" value="{{$cshRcpts->acnt_nbr}}" name="acnt_nbr" class="form-control col-md-7 col-xs-12">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="amount" style="text-align:left;"> Amount <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" id="amount" value="{{$cshRcpts->amount}}" required="required" name="amount" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="clearfix"></div>

                                <div class="item form-group col-md-12 col-sm-12 col-xs-12"><!-- textarea start -->
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="detail" style="text-align: left">Detail: <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">

                                        <textarea id="detail" class="ckeditor" name="detail" placeholder="Slider Detail">
                                            {{$cshRcpts->detail}}
                                        </textarea>
                                    </div>
                                </div><!-- textarea end -->

                                <div class="clearfix"></div>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-8 col-sm-6 col-xs-12 col-md-offset-3">
                                        <a href="{{url('/dashboard/schedule-regis')}}" class="btn btn-danger">Cancel</a>
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
    <!-- bootstrap-datetimepicker -->
    <script src="{{ asset('vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>


    <script type="text/javascript">


        $('#myDatepicker3').datetimepicker({
            format: 'HH:mm'
        });


    </script>
@endsection


