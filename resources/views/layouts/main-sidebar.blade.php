<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">لوحة التحكم</li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#countries">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">الدول</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="countries" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('countries.index')}}">قائمة الدول</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#nationalities">
                            <div class="pull-left"><i class="ti-palette"></i><span class="right-nav-text">الجنسيات</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="nationalities" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('nationalities.index')}}">قائمة الجنسيات</a> </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#cities">
                            <div class="pull-left"><i class="ti-calendar"></i><span class="right-nav-text">المدن</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="cities" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('cities.index')}}">قائمة المدن</a></li>
                        </ul>
                    </li>


                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#specialties">
                            <div class="pull-left"><i class="ti-menu-alt"></i><span class="right-nav-text">التخصصات</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="specialties" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('specialties.index')}}">قائمة التخصصات</a> </li>
                        </ul>
                    </li>


                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#reachedUs">
                            <div class="pull-left"><i class="ti-file"></i><span class="right-nav-text">وسائل التواصل</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="reachedUs" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('reachedUs.index')}}">قائمة وسائل التواصل</a> </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#users">
                            <div class="pull-left"><i class="ti-user"></i><span class="right-nav-text">الموظفون</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="users" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('users.index')}}">قائمة الموظفين</a> </li>
                        </ul>
                    </li>


                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#companies">
                            <div class="pull-left"><i class="ti-archive"></i><span class="right-nav-text">الشركات</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="companies" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('companies.index')}}">قائمة الشركات</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#jobs">
                            <div class="pull-left"><i class="ti-joomla"></i><span class="right-nav-text">الوظائف</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="jobs" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('jobs.index')}}">قائمة الوظائف</a></li>
                        </ul>
                    </li>

{{--                    <li>--}}
{{--                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#offers">--}}
{{--                            <div class="pull-left"><i class="ti-dropbox"></i><span class="right-nav-text">العروض</span></div>--}}
{{--                            <div class="pull-right"><i class="ti-plus"></i></div>--}}
{{--                            <div class="clearfix"></div>--}}
{{--                        </a>--}}
{{--                        <ul id="offers" class="collapse" data-parent="#sidebarnav">--}}
{{--                            <li> <a href="{{route('offers.index')}}">قائمة العروض</a></li>--}}
{{--                            <li> <a href="{{route('offeredTasks.index')}}">قائمة عروض المهمات</a></li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}


{{--                    <li>--}}
{{--                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#jobRequirements">--}}
{{--                            <div class="pull-left"><i class="ti-hand-drag"></i><span class="right-nav-text">متطلبات الوظائف</span></div>--}}
{{--                            <div class="pull-right"><i class="ti-plus"></i></div>--}}
{{--                            <div class="clearfix"></div>--}}
{{--                        </a>--}}
{{--                        <ul id="jobRequirements" class="collapse" data-parent="#sidebarnav">--}}
{{--                            <li> <a href="{{route('jobRequirements.index')}}">قائمة متطلبات الوظائف</a></li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}


{{--                    <li>--}}
{{--                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#jobTerms">--}}
{{--                            <div class="pull-left"><i class="ti-hummer"></i><span class="right-nav-text">شروط الوظائف</span></div>--}}
{{--                            <div class="pull-right"><i class="ti-plus"></i></div>--}}
{{--                            <div class="clearfix"></div>--}}
{{--                        </a>--}}
{{--                        <ul id="jobTerms" class="collapse" data-parent="#sidebarnav">--}}
{{--                            <li> <a href="{{route('jobTerms.index')}}">قائمة شروط الوظائف</a></li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}

{{--                    <li>--}}
{{--                        <a href="todo-list.html"><i class="ti-menu-alt"></i><span class="right-nav-text">Todo--}}
{{--                                list</span> </a>--}}
{{--                    </li>--}}
                    <!-- menu item chat-->
{{--                    <li>--}}
{{--                        <a href="chat-page.html"><i class="ti-comments"></i><span class="right-nav-text">Chat--}}
{{--                            </span></a>--}}
{{--                    </li>--}}
{{--                    <!-- menu item mailbox-->--}}
{{--                    <li>--}}
{{--                        <a href="mail-box.html"><i class="ti-email"></i><span class="right-nav-text">Mail--}}
{{--                                box</span> <span class="badge badge-pill badge-warning float-right mt-1">HOT</span> </a>--}}
{{--                    </li>--}}
{{--                    <!-- menu item Charts-->--}}


                    <!-- menu font icon-->
{{--                    <li>--}}
{{--                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#font-icon">--}}
{{--                            <div class="pull-left"><i class="ti-user"></i><span class="right-nav-text">إضافة مدير فرع جديد</span></div>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <!-- menu title -->--}}
{{--                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Widgets, Forms & Tables </li>--}}
{{--                    <!-- menu item Widgets-->--}}
{{--                    <li>--}}
{{--                        <a href="widgets.html"><i class="ti-blackboard"></i><span class="right-nav-text">Widgets</span>--}}
{{--                            <span class="badge badge-pill badge-danger float-right mt-1">59</span> </a>--}}
{{--                    </li>--}}
{{--                    <!-- menu item Form-->--}}

{{--                    <!-- menu item table -->--}}

{{--                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">More Pages</li>--}}
{{--                    <!-- menu item Custom pages-->--}}

{{--                    <!-- menu item Authentication-->--}}
{{--                    <li>--}}
{{--                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#authentication">--}}
{{--                            <div class="pull-left"><i class="ti-id-badge"></i><span--}}
{{--                                    class="right-nav-text">Authentication</span></div>--}}
{{--                            <div class="pull-right"><i class="ti-plus"></i></div>--}}
{{--                            <div class="clearfix"></div>--}}
{{--                        </a>--}}
{{--                        <ul id="authentication" class="collapse" data-parent="#sidebarnav">--}}
{{--                            <li> <a href="login.html">login</a> </li>--}}
{{--                            <li> <a href="register.html">register</a> </li>--}}
{{--                            <li> <a href="lockscreen.html">Lock screen</a> </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <!-- menu item maps-->--}}
{{--                    <li>--}}
{{--                        <a href="maps.html"><i class="ti-location-pin"></i><span class="right-nav-text">maps</span>--}}
{{--                            <span class="badge badge-pill badge-success float-right mt-1">06</span></a>--}}
{{--                    </li>--}}
{{--                    <!-- menu item timeline-->--}}
{{--                    <li>--}}
{{--                        <a href="timeline.html"><i class="ti-panel"></i><span class="right-nav-text">timeline</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <!-- menu item Multi level-->--}}
{{--                    <li>--}}
{{--                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#multi-level">--}}
{{--                            <div class="pull-left"><i class="ti-layers"></i><span class="right-nav-text">Multi--}}
{{--                                    level Menu</span></div>--}}
{{--                            <div class="pull-right"><i class="ti-plus"></i></div>--}}
{{--                            <div class="clearfix"></div>--}}
{{--                        </a>--}}
{{--                        <ul id="multi-level" class="collapse" data-parent="#sidebarnav">--}}
{{--                            <li>--}}
{{--                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#auth">Level--}}
{{--                                    item 1<div class="pull-right"><i class="ti-plus"></i></div>--}}
{{--                                    <div class="clearfix"></div>--}}
{{--                                </a>--}}
{{--                                <ul id="auth" class="collapse">--}}
{{--                                    <li>--}}
{{--                                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#login">Level--}}
{{--                                            item 1.1<div class="pull-right"><i class="ti-plus"></i></div>--}}
{{--                                            <div class="clearfix"></div>--}}
{{--                                        </a>--}}
{{--                                        <ul id="login" class="collapse">--}}
{{--                                            <li>--}}
{{--                                                <a href="javascript:void(0);" data-toggle="collapse"--}}
{{--                                                    data-target="#invoice">level item 1.1.1<div class="pull-right"><i--}}
{{--                                                            class="ti-plus"></i></div>--}}
{{--                                                    <div class="clearfix"></div>--}}
{{--                                                </a>--}}
{{--                                                <ul id="invoice" class="collapse">--}}
{{--                                                    <li> <a href="#">level item 1.1.1.1</a> </li>--}}
{{--                                                    <li> <a href="#">level item 1.1.1.2</a> </li>--}}
{{--                                                </ul>--}}
{{--                                            </li>--}}
{{--                                        </ul>--}}
{{--                                    </li>--}}
{{--                                    <li> <a href="#">level item 1.2</a> </li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#error">level--}}
{{--                                    item 2<div class="pull-right"><i class="ti-plus"></i></div>--}}
{{--                                    <div class="clearfix"></div>--}}
{{--                                </a>--}}
{{--                                <ul id="error" class="collapse">--}}
{{--                                    <li> <a href="#">level item 2.1</a> </li>--}}
{{--                                    <li> <a href="#">level item 2.2</a> </li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
