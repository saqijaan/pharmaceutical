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
                    <h3> Schedule Registration </h3>
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
                            <h2> Create New </h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <form id="demo-form2" method="post" enctype="multipart/form-data" action="{{ route('quiz-regis.store') }}" data-parsley-validate class="form-horizontal form-label-left">
                                @csrf

                                <div class="form-group calendar-exibit col-md-4 col-sm-12 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="date" style="text-align: left"> Date <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        {{--<input type="text" id="joining_date" required="required" value="{{ $employeeRegis->joining_date }}" name="joining_date" class="form-control col-md-7 col-xs-12">--}}
                                        <fieldset class="">
                                            <div class="control-group">
                                                <div class="controls">
                                                    <div class="col-md-11 xdisplay_inputx form-group has-feedback" style="padding-left: 0px;">
                                                        <input type="text" class="form-control has-feedback-left" name="date" id="single_cal2" placeholder="First Name" aria-describedby="inputSuccess2Status2">
                                                        <span class="fa fa-calendar-o form-control-feedback left" style="left: 0;" aria-hidden="true"></span>
                                                        <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>


                                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="start_time" style="text-align:left;"> Start Time <span class="required">*</span>
                                    </label>
                                    <div class='input-group date' id='myDatepicker3'>
                                        <input type='text' name="start_time" id="start_time" class="form-control" />
                                        <span class="input-group-addon">
                                           <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="end_time" style="text-align:left;"> End Time <span class="required">*</span>
                                    </label>
                                    <div class='input-group date' id='myDatepicker4'>
                                        <input type='text' name="end_time" id="end_time" class="form-control" />
                                        <span class="input-group-addon">
                                           <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="clearfix"></div>

                                <!-- textarea start -->
                                <div class="item form-group">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="question" style="text-align: left"> Question: <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">

                                        <textarea id="question" rows="4" class="form-control w-100" placeholder="Write Question Here" name="question" placeholder="Question"></textarea>
                                    </div>
                                </div>
                                <!-- textarea end -->

                                {{--  Answers Start Here  --}}

                                {{--  Answer 1  --}}
                                <div class="item form-group">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="question" style="text-align: left"> Answer 1 <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">

                                        <textarea id="question" row="1" required class="form-control w-100" placeholder="Write Down Answer 1" name="answer[0]"></textarea>
                                    </div>
                                </div>

                                {{--  Answer 2  --}}
                                <div class="item form-group">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="question" style="text-align: left"> Answer 2 <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">

                                        <textarea id="question" row="1" required class="form-control w-100" placeholder="Write Down Answer 2" name="answer[1]"></textarea>
                                    </div>
                                </div>

                                {{--  Answer 3  --}}
                                <div class="item form-group">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="question" style="text-align: left"> Answer 3 <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">

                                        <textarea id="question" row="1" required class="form-control w-100" placeholder="Write Down Answer 3" name="answer[2]"></textarea>
                                    </div>
                                </div>

                                {{--  Answer 4  --}}
                                <div class="item form-group">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="question" style="text-align: left"> Answer 4 <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">

                                        <textarea id="question" row="1" required class="form-control w-100" placeholder="Write Down Answer 4" name="answer[3]"></textarea>
                                    </div>
                                </div>

                                {{--  Answers End Here  --}}
                                <div class="clearfix"></div>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-8 col-sm-6 col-xs-12 col-md-offset-3">
                                        <a href="{{ url('/quiz-regis') }}" class="btn btn-danger">Cancel</a>
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
                            <h2> Quiz List</h2>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">

                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-striped jambo_table bulk_action dt-responsive nowrap">
                                    <thead>
                                    <tr class="headings">

                                        <th class="column-title">ID </th>
                                        <th class="column-title"> Date </th>
                                        <th class="column-title"> Question </th>
                                        <th class="column-title"> End Time </th>
                                        <th class="column-title no-link last"><span class="nobr">Action</span>
                                        </th>
                                        <th class="bulk-actions" colspan="7">
                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                        </th>
                                    </tr>
                                    </thead>

                                    <tbody>


                                    @foreach( $quizs as $quiz )
                                        <tr class="even pointer">
                                            <td class=" "> {{ $quiz->id }}</td>
                                            <td class=" "> {{ $quiz->date }} </td>
                                            <td class=" "> {!! $quiz->question  !!}  </td>
                                            <td class=" "> {{ \Carbon\Carbon::createFromFormat('H:i', $quiz->end_time)->format('h:i A')  }}  </td>
                                            <td class=" last">
                                                <a class="btn btn-primary" href="{{ route('quiz-regis.edit', $quiz->id ) }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form method="post" enctype="multipart/form-data" action="{{route('quiz-regis.destroy',$quiz->id)}}" style="display: inline">
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

            $('#approved_blade').on('change','#head_id', function(){

                var main_cate = $(this).val(),
                        check = 'new';
                $.ajax({
                    url: "{{ route('get-sub-head') }}",
                    data:{main_cate: main_cate,check:check,  "_token": "{{ csrf_token() }}"},
                    type:'post',
                    success:function(r){
                        $('#sub_head_id').html(r);
                    }
                });

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


        $('#myDatepicker3').datetimepicker({
            format: 'HH:mm'
        });
        $('#myDatepicker4').datetimepicker({
            format: 'HH:mm'
        });


    </script>

@endsection


