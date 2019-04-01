


    <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
                <a href="/" class="site_title"><span>Biomerge Pharamceuticals!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
                
                <div class="profile_info">
                    @guest
                        <span> Please login first!. </span>
                    @else
                        <span>Welcome,</span>
                        <h2 style="text-transform: capitalize;">{{ Auth::user()->name }}</h2>
                    @endguest
                </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                <div class="menu_section">
                    <h3>General</h3>
                    <ul class="nav side-menu">
                        <li>
                            <a href="{{ route('home') }}"><i class="fa fa-home"></i> Dashboard </a>
                        </li>

                        <li>
                            <a href="{{ route('schedules.index') }}"><i class="fa fa-edit"></i> Schedule Register </a>
                        </li>

                        <li>
                            <a href="{{ url('/dashboard/quiz-regis') }}"><i class="fa fa-edit"></i> Quiz </a>
                        </li>

                        <li><a><i class="fa fa-clone"></i> Accounts <span class="fa fa-chevron-down"></span></a>

                            <ul class="nav child_menu">
                                <li><a href="{{ url('/dashboard/account-session-registration') }}"> Session Registration </a></li>
                                <li><a href="{{ url('/dashboard/account-head') }}"> Account Head </a></li>
                                <li><a href="{{ url('/dashboard/account-sub-head') }}"> Account Sub Head </a></li>
                                <li><a href="{{ url('/dashboard/account-regis') }}"> Accounts </a></li>
                            </ul>

                        </li>

                        <li><a><i class="fa fa-clone"></i> Vouchers Entries <span class="fa fa-chevron-down"></span></a>

                            <ul class="nav child_menu">
                                <li><a href="{{ url('/dashboard/cash-receipt') }}"> Cash Receipt </a></li>
                                <li><a href="{{ url('/dashboard/cash-payment') }}"> Cash Payment </a></li>
                                <li><a href="{{ url('/dashboard/bank-receipt') }}"> Bank Receipt </a></li>
                                <li><a href="{{ url('/dashboard/bank-payment') }}"> Bank Payment </a></li>
                                <li><a href="{{ url('/dashboard/journal-vouchers') }}"> Journal Vouchers </a></li>
                            </ul>

                        </li>

                        <li><a><i class="fa fa-clone"></i> Reports <span class="fa fa-chevron-down"></span></a>

                            <ul class="nav child_menu">
                                <li><a href="{{ url('/dashboard/prduct-report') }}"> Product Report </a></li>
                                <li><a href="{{ url('/dashboard/ledger-report') }}"> Ledger Report </a></li>
                            </ul>

                        </li>

                        <li><a><i class="fa fa-clone"></i> Purchase <span class="fa fa-chevron-down"></span></a>

                            <ul class="nav child_menu">

                                <li>
                                    <a href="{{ url('/dashboard/purchase-master') }}"> Purchase OP </a>
                                </li>
                                {{-- <li>
                                    <a href="{{ url('/dashboard/purchase-return') }}"> Purchase Return </a>
                                </li> --}}
                                <li>
                                    <a href="{{ url('/dashboard/supply-registration') }}"> Supplier Registration </a>
                                </li>
                            </ul>

                        </li>

                        <li><a><i class="fa fa-clone"></i> Sales <span class="fa fa-chevron-down"></span></a>

                            <ul class="nav child_menu">

                                <li>
                                    <a href="{{ url('/dashboard/sale-master') }}"> Sales Form </a>
                                </li>
                                {{-- <li>
                                    <a href="{{ url('/dashboard/sale-return') }}"> Sales Return </a>
                                </li> --}}
                                <li>
                                    <a href="{{ url('/dashboard/customer-registration') }}"> Customer Registration </a>
                                </li>
                            </ul>

                        </li>

                        <li><a><i class="fa fa-clone"></i> General Regis <span class="fa fa-chevron-down"></span></a>

                            <ul class="nav child_menu">
                                <li>
                                    <a href="{{ url('/dashboard/bank-register') }}"> Bank Register </a>
                                </li>
                                <li>
                                    <a href="{{ url('/dashboard/doctor-regis') }}"> Doctor Register </a>
                                </li>
                                <li>
                                    <a href="{{ url('/dashboard/brand-registration') }}"> Brand Registration </a>
                                </li>

                                <li>
                                    <a href="{{ url('/dashboard/category-registration') }}"> Category Registration </a>
                                </li>
                                <li>
                                    <a href="{{ url('/dashboard/product-registration') }}"> Product Registration </a>
                                </li>
                                <li>
                                    <a href="{{ url('/dashboard/city-registration') }}"> City Registration </a>
                                </li>
                                <li>
                                    <a href="{{ url('/dashboard/employee-registration') }}"> Employee Registration </a>
                                </li>
                            </ul>

                        </li>

                        <li>
                            <a href="{{ url('/dashboard/distributer-registration') }}"><i class="fa fa-clone"></i> Distributers </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.orders.all') }}"><i class="fa fa-clone"></i> Orders </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.distributers.deposits') }}"><i class="fa fa-clone"></i> Amount Deposits </a>
                        </li>
                        {{--<li>--}}
                            {{--<a href="{{ url('/dashboard/transaction-registration') }}"><i class="fa fa-edit"></i> Transaction Registration </a>--}}
                        {{--</li>--}}

                        {{--<li><a><i class="fa fa-clone"></i> Admin Panel <span class="fa fa-chevron-down"></span></a>--}}

                            {{--<ul class="nav child_menu">--}}
                                {{--<li><a href="{{ url('/dashboard/user-management') }}">User Management</a></li>--}}
                                {{--<li><a href="{{ url('/dashboard/sales-summery') }}">Sales Summery</a></li>--}}
                                {{--<li><a href="{{ url('/dashboard/staff-summary') }}">Staff Summery</a></li>--}}
                                {{--<li><a href="{{ url('/dashboard/purchase-summery') }}">Purchase Summery</a></li>--}}
                                {{--<li><a href="{{ url('/dashboard/gift-issurance-to-doctor') }}">Gift Issuarance to Doctor</a></li>--}}
                                {{--<li><a href="{{ url('/sales-targets-management') }}">Sales Targets Management</a></li>--}}
                            {{--</ul>--}}

                        {{--</li>--}}

                        {{--<li><a><i class="fa fa-clone"></i> Distributor Panel <span class="fa fa-chevron-down"></span></a>--}}

                            {{--<ul class="nav child_menu">--}}
                                {{--<li><a href="{{ url('/dashboard/po-generation') }}"> PO Generation </a></li>--}}
                                {{--<li><a href="{{ url('/dashboard/sales-entries') }}">Sales Entries</a></li>--}}
                                {{--<li><a href="{{ url('/dashboard/stock-summery') }}">Stock Summery</a></li>--}}
                                {{--<li><a href="{{ url('/dashboard/accounts-summery') }}">Accounts Summery</a></li>--}}
                            {{--</ul>--}}

                        {{--</li>--}}

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





