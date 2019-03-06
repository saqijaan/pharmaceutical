


    <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
                <a href="/" class="site_title"><i class="fa fa-paw"></i> <span>ProTech!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
                <div class="profile_pic">
                    <img src="{{ asset('images/img.jpg') }}" alt="..." class="img-circle profile_img">
                </div>
                <div class="profile_info">

                        <span>Welcome,</span>
                        <h2 style="text-transform: capitalize;">{{ Auth::guard('distributer')->user()->name }}</h2>

                </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                <div class="menu_section">
                    <h3>General</h3>
                    <ul class="nav side-menu">


                        <li><a href="{{ url('/dashboard/distributer-order-book') }}"><i class="fa fa-edit"></i> Order Booking </a></li>
                        <li><a href="{{ url('/dashboard/distributer-sale-orders') }}"><i class="fa fa-edit"></i> Sale Orders </a></li>
                        <li><a href="{{ url('/dashboard/distributer-deposit-amount') }}"><i class="fa fa-edit"></i> Deposit Amount </a></li>



                    </ul>
                </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
                <a data-toggle="tooltip" data-placement="top" title="Settings">
                    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                </a>
                <a data-toggle="tooltip" data-placement="top" title="FullScreen" onclick="toggleFullscreen()">
                    <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                </a>
                <a data-toggle="tooltip" data-placement="top" title="Lock">
                    <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                </a>
                <a data-toggle="tooltip" data-placement="top" title="Logout"  href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
            <!-- /menu footer buttons -->
        </div>
    </div><!-- navigation column end -->





