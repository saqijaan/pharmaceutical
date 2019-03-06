@extends('index')

@section('title', 'ProTech Application')

@section('stylesheet')

    <!-- NProgress -->
    <link href="{{ asset('vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('build/css/custom.min.css') }}" rel="stylesheet">

@endsection

@section('content')


    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title"><!-- page title and search bar column start -->
                <div class="title_left">
                    <h3> Employee Profile </h3>
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
                            <h2> {{$employeeRegis->name}}</h2>
                             
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-12 col-sm-12 col-xs-12 profile_left"><!-- profile detail start -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="profile_img">
                                            <div id="crop-avatar">
                                                <!-- Current avatar -->
                                                <img class="img-responsive avatar-view" src="{{ asset('uploads/employeeRegister/m/'.$employeeRegis->image) }}" alt="Avatar" title="Change the avatar">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h3> {{$employeeRegis->name}}</h3>
                                        <ul class="list-unstyled user_data">
                                            <li><i class="fa fa-map-marker user-profile-icon"></i> {{ $employeeRegis->address }}
                                            </li>
    
                                            <li>
                                                <i class="fa fa-envelope user-profile-icon"></i> {{ $employeeRegis->email }}
                                            </li>
    
                                            <li>
                                                <i class="fa fa-mobile user-profile-icon"></i> {{ $employeeRegis->mobile }}
                                            </li>
    
                                            @if( !empty( $employeeRegis->phone) )
                                                <li>
                                                    <i class="fa fa-phone user-profile-icon"></i> {{ $employeeRegis->phone }}
                                                </li>
                                            @endif
                                            @if( !empty( $employeeRegis->nic ) )
                                                <li>
                                                    <i class="fa fa-id-card user-profile-icon" aria-hidden="true"></i> {{ $employeeRegis->nic }}
                                                </li>
                                            @endif
    
                                            <li>
                                                <i class="fa fa-briefcase user-profile-icon"></i> {{ $employeeRegis->designation }}
                                            </li>
    
                                            <li>
                                                <i class="fa fa-briefcase user-profile-icon"></i> {{ $employeeRegis->joining_date }}
                                            </li>
    
                                            <li class="m-top-xs">
                                                <i class="fa fa-external-link user-profile-icon"></i>
                                                <a href="http://www.protechiz.com/" target="_blank">www.protechiz.com</a>
                                            </li>
                                        </ul>
                                        <a href="{{ route('employee-registration.edit',$employeeRegis->id ) }}" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                                    </div>
                                </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
    <!-- /page content -->




@endsection

@section('bottom_script')

    <!-- FastClick -->
    <script src="{{ asset('vendors/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ asset('vendors/nprogress/nprogress.js') }}"></script>
    <!-- morris.js -->
    <script src="{{ asset('vendors/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('vendors/morris.js/morris.min.js') }}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ asset('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>




@endsection


