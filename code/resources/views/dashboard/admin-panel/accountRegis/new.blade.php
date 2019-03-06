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
                    <h3> Accounts Registration </h3>
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
                            <h2> Create New    </h2>
                             
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <form id="demo-form2" method="post" enctype="multipart/form-data" action="{{ route('account-regis.store') }}" data-parsley-validate class="form-horizontal form-label-left">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Accounts Name <span class="required">*</span>
                                    </label>
                                    <div class="col-md-8 col-sm-6 col-xs-12">
                                        <input type="text" id="name" required="required" name="name" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="head_id"> Account Head </label>
                                    <div class="col-md-8 col-sm-6 col-xs-12" id="approved_blade">
                                        <select class="form-control" id="head_id" required="required" name="head_id">
                                            <option>Choose option</option>
                                            @foreach( $accountHeads as $accountHead )
                                                <option value="{{ $accountHead->id }}"> {{ $accountHead->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sub_head_id"> Account Sub Head </label>
                                    <div class="col-md-8 col-sm-6 col-xs-12">
                                        <select class="form-control" id="sub_head_id" required="required" name="sub_head_id">
                                            <option>Choose option</option>
                                            @include('dashboard.admin-panel.accountRegis.get-sub-head-ajax', ['accountSubHeads'=>$accountSubHeads ])
                                        </select>
                                    </div>
                                </div>



                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-8 col-sm-6 col-xs-12 col-md-offset-3">
                                        <a href="/dashboard/account-regis" class="btn btn-danger">Cancel</a>
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
                            <h2> Account Sub Head Registration   </h2>
                             
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">

                              

                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-striped jambo_table bulk_action dt-responsive nowrap">
                                    <thead>
                                    <tr class="headings">

                                        <th class="column-title">ID </th>
                                        <th class="column-title"> Account Name </th>
                                        <th class="column-title"> Account Sub-Head Name </th>
                                        <th class="column-title"> Account Head Name </th>
                                        <th class="column-title no-link last"><span class="nobr">Action</span>
                                        </th>
                                        <th class="bulk-actions" colspan="7">
                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                        </th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    @foreach( $accounts as $account )
                                        <tr class="even pointer">
                                            <td class=" "> {{ $account->id }}</td>
                                            <td class=" "> {{ $account->name }} </td>
                                            <td class=" "> {{ $account->subHeadTitle  }}  </td>
                                            <td class=" "> {{ $account->headTitle  }}  </td>
                                            <td class=" last">
                                                <a class="btn btn-primary" href="{{ route('account-regis.edit', $account->id ) }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form method="post" enctype="multipart/form-data" action="{{route('account-regis.destroy',$account->id)}}" style="display: inline">
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



@endsection


