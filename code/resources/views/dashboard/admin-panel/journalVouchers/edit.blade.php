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
                    <h3> Journal Voucher </h3>
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
                            <h2> Update Journal Voucher post   </h2>
                             
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <form id="demo-form2" method="post" enctype="multipart/form-data" action="{{ route('journal-vouchers.update', [$jrnlVchrs->id] ) }}" data-parsley-validate class="form-horizontal form-label-left">
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
                                                        <input type="text" class="form-control has-feedback-left" name="date" id="single_cal2" placeholder="First Name" value="{{date('m,d,y', strtotime($jrnlVchrs->date))}}" aria-describedby="inputSuccess2Status2">
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
                                        <input type="text" id="acnt_nme" required="required" value="{{$jrnlVchrs->acnt_nme}}" name="acnt_nme" class="form-control autocomplete-custom-append col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="acnt_nbr" style="text-align:left;"> Account Number <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" id="acnt_nbr" required="required" value="{{$jrnlVchrs->acnt_nbr}}" name="acnt_nbr" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="amount" style="text-align:left;"> Amount <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" id="amount" value="{{$jrnlVchrs->amount}}" required="required" name="amount" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-md-3 col-sm-3 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="bnk_nme" style="text-align:left;"> Bank Name </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <select class="form-control" id="bnk_nme" required="required" name="bnk_nme">
                                            <option>Choose option</option>
                                            @foreach( $bnknames as $bnkname )
                                                <option value="{{ $bnkname->id }}" {{ ($jrnlVchrs->bnk_nme == $bnkname->id) ? 'selected' : '' }}> {{ $bnkname->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="chqe_no" style="text-align:left;"> Cheque #: <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12" id="items">
                                        <input type="text" id="chqe_no" required="required" value="{{$jrnlVchrs->chqe_no}}" name="chqe_no" class="form-control col-md-7 col-xs-12">
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
                                                        <input type="text"  value="{{ date('m,d,Y', strtotime($jrnlVchrs->clrance_date))}}" class="form-control has-feedback-left" name="clrance_date" id="clearance" placeholder="First Name" aria-describedby="inputSuccess2Status2">
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
                                                <option value="{{ $bnkname->id }}" {{ ($jrnlVchrs->bnk_rfrence == $bnkname->id) ? 'selected' : '' }}> {{ $bnkname->name }}</option>
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
                                            {{$jrnlVchrs->detail}}
                                        </textarea>
                                    </div>
                                </div><!-- textarea end -->

                                <div class="clearfix"></div>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-8 col-sm-6 col-xs-12 col-md-offset-3">
                                        <a href="{{url('/dashboard/journal-vouchers')}}" class="btn btn-danger">Cancel</a>
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

        $('#clearance').daterangepicker({
            singleDatePicker: true,
            singleClasses: "picker_2"
        }, function(start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });
    </script>

@endsection


