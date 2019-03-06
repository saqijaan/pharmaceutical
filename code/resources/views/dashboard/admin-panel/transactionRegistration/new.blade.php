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
                    <h3> Transaction Registration </h3>
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

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2> Create New    </h2>
                             
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <form id="demo-form2" method="post" enctype="multipart/form-data" action="{{ route('transaction-registration.store') }}" class="form-horizontal form-label-left">
                                @csrf

                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="account_id" style="text-align: left"> Account Name </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12" id="approved_blade">
                                        <select class="form-control" id="account_id" required="required" name="account_id">
                                            <option>Choose option</option>
                                            @foreach( $accounts as $account )
                                                <option value="{{ $account->id }}"> {{ $account->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group calendar-exibit col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="date" style="text-align: left"> Date <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        {{--<input type="text" id="joining_date" required="required" value="{{ $employeeRegis->joining_date }}" name="joining_date" class="form-control col-md-7 col-xs-12">--}}
                                        <fieldset class="">
                                            <div class="control-group">
                                                <div class="controls">
                                                    <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                                        <input type="text" class="form-control has-feedback-left" name="date" id="single_cal2" placeholder="First Name" aria-describedby="inputSuccess2Status2">
                                                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                        <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="clearfix"></div>

                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="dr" style="text-align: left"> Dr.
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="number" id="dr" name="dr" maxlength="15" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="cr" style="text-align: left"> CR. <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="number" id="cr" name="cr" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="clearfix"></div>

                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="voucher_type" style="text-align: left"> Voucher Type
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" id="voucher_type" name="voucher_type" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="check_no" style="text-align: left"> Check No. <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" id="check_no" name="check_no" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="clearfix"></div>

                                <div class="form-group calendar-exibit col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="clearance_date" style="text-align: left"> Clearance Date <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        {{--<input type="text" id="joining_date" required="required" value="{{ $employeeRegis->joining_date }}" name="joining_date" class="form-control col-md-7 col-xs-12">--}}
                                        <fieldset class="">
                                            <div class="control-group">
                                                <div class="controls">
                                                    <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                                        <input type="text" class="form-control has-feedback-left" name="clearance_date" id="single_cal3" placeholder="Clearance Date" aria-describedby="inputSuccess2Status2">
                                                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                        <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>

                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="bank_name" style="text-align: left"> Bank Name <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" id="bank_name" name="bank_name" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="clearfix"></div>

                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="sale_invoice" style="text-align: left"> Sale Invoice <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" id="sale_invoice" name="sale_invoice" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="purchase_invoice" style="text-align: left"> Purchase Invoice <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" id="purchase_invoice" name="purchase_invoice" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="clearfix"></div>


                                <div class="item form-group"><!-- textarea start -->
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="detail" style="text-align: left">Detail: <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">

                                        <textarea id="detail" class="ckeditor" name="detail" placeholder="Slider Detail">

                                        </textarea>
                                    </div>
                                </div><!-- textarea end -->

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-8 col-sm-6 col-xs-12 col-md-offset-3">
                                        <a href="/transaction-registration" class="btn btn-danger">Cancel</a>
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


@endsection


