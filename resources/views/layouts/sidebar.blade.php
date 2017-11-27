<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="{{url('/')}}" >
                        <img src="{{asset('public/images/logos/kandel-logo.png')}}" alt="..." class="img-circle1 profile_img md" style="width: 90%;" >
                        <img src="{{asset('public/images/logos/logo_90x90.png')}}" alt="..." class="img-circle1 profile_img sm" width="90%">
                    </a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <img src="{{$avatar}}" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>{{Auth::user()->first_name}}</span>
                        <!--<h2>John Doe</h2>-->
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br />


                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>General</h3>
                        <ul class="nav side-menu">
                            <li><a href="/srm"><i class="fa fa-home"></i> Dashboard </a>
                            </li>
                            <li><a><i class="fa fa-user"></i> Counselor <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{url('faculty/create')}}"><i class="fa fa-sitemap"></i>Register</a></li>
                                    <li><a href="{{url('faculty')}}"><i class="fa fa-edit"></i>View</a></li>
                                    <li><a href="{{url('faculty-type')}}"><i class="fa fa-sitemap"></i>Counselor Type List</a></li>

                                </ul>
                            </li>
                            <li><a><i class="fa fa-group"></i> Student <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{url('student/create')}}"><i class="fa fa-edit"></i>Register</a></li>
                                    <li><a href="{{url('student')}}"><i class="fa fa-sitemap"></i>View</a></li>
                                    <!-- <li><a href="{{url('student/upload')}}"><i class="fa fa-sitemap"></i>Bulk Upload</a></li> -->
                                </ul>
                            </li>
                            <li><a href="{{url('student/referral')}}"><i class="fa fa-table"></i> Referred Commision</a>
                                <!--                    <ul class="nav child_menu">
                                                      <li><a href="tables.html">Tables</a></li>
                                                      <li><a href="tables_dynamic.html">Table Dynamic</a></li>
                                                    </ul>-->
                            </li>
                            <li><a href="{{url('reminder')}}"><i class="fa fa-desktop"></i> Reminder </span></a>
                                <!--                    <ul class="nav child_menu">
                                                      <li><a href="chartjs.html">Chart JS</a></li>
                                                      <li><a href="chartjs2.html">Chart JS2</a></li>
                                                      <li><a href="morisjs.html">Moris JS</a></li>
                                                      <li><a href="echarts.html">ECharts</a></li>
                                                      <li><a href="other_charts.html">Other Charts</a></li>
                                                    </ul>-->
                            </li>
                            <li><a><i class="fa fa-building"></i>Institutions <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{url('institution/create')}}"><i class="fa fa-edit"></i>Register</a></li>
                                    <li><a href="{{url('/institution')}}"><i class="fa fa-sitemap"></i>View</a></li>
                                    <!-- <li><a href="form_validation.html"><i class="fa fa-download"></i>Application Download</a></li> -->
                                </ul>
                            </li>
                            <li><a><i class="fa fa-file"></i>Invoice <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{url('/invoice')}}"><i class="fa fa-file-text"></i>Invoice List</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-file"></i>News Letter <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{url('/news-letter')}}"><i class="fa fa-edit"></i>Send News Letter</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-file"></i>Reports<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                   <!--  <li><a href="#"><i class="fa fa-file-text"></i>Statistical Reports</a></li> -->
                                    <li><a href="{{('/report/referral')}}"><i class="fa fa-file-text"></i>Referred Commision Reports</a></li>
                                </ul>
                            </li>

                            <li><a><i class="fa fa-file"></i> Templates <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{url('/template/reset-mail')}}"><i class="fa fa-file-text"></i>Reset Password Mail Template</a></li>
                                    <li><a href="{{url('/template/welcome-mail')}}"><i class="fa fa-file-text"></i>Welcome Mail Template</a></li>
                                    <li><a href="{{url('/template/coe-reminder')}}"><i class="fa fa-file-text"></i>COE Reminder Mail Template</a></li>
                                    <li><a href="{{url('/template/lof-reminder')}}"><i class="fa fa-file-text"></i>LOF Reminder Mail Template</a></li>
                                    <li><a href="{{url('/template/invoice-reminder')}}"><i class="fa fa-file-text"></i>Invoice Reminder Mail Template</a></li>
                                    <li><a href="{{url('/template/newsletter')}}"><i class="fa fa-file-text"></i>News Letter Mail Template</a></li>
                                    <li><a href="{{url('/template/invoice')}}"><i class="fa fa-edit"></i>Invoice Template</a></li>
                                </ul>
                            </li>
                              <li><a><i class="fa fa-cogs"></i> Settings <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                   <li><a href="{{url('/change-password')}}"><i class="fa fa-edit"></i>Change Password</a></li>
                                    <li><a href="{{url('manage-countries')}}"><i class="fa fa-edit"></i>Add/Remove Countries</a></li>
                                </ul>
                            </li>

                        </ul>
                    </div>


                </div>
                <!-- /sidebar menu -->
                <!-- /menu footer buttons -->
               <!--  <div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" data-placement="top" title="Settings">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Lock">
                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div> -->
                <!-- /menu footer buttons -->
            </div>
        </div>
    </div></div>
