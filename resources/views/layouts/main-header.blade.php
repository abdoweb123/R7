        <!--=================================
 header start-->
        <nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <!-- logo -->
            <div class="text-left navbar-brand-wrapper">
                <a class="navbar-brand brand-logo" href="index.html"><img src="{{asset('assets/images/New Project.png')}}" alt=""></a>
                <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{asset('assets/images/New Project.png')}}"
                        alt=""></a>
            </div>
            <!-- Top bar left -->
            <ul class="nav navbar-nav mr-auto">
                <li class="nav-item">
                    <a id="button-toggle" class="button-toggle-nav inline-block ml-20 pull-left"
                        href="javascript:void(0);"><i class="zmdi zmdi-menu ti-align-right"></i></a>
                </li>
               
            </ul>
            <!-- top bar right -->
            <ul class="nav navbar-nav ml-auto">
{{--                <li class="nav-item dropdown">--}}
{{--                    <a id="navbarDropdown" class="btn btn-success p-10 nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
{{--                         {{trans('main_trans.change_language')}}--}}
{{--                    </a>--}}

{{--                    <div class="dropdown-menu dropdown-menu-end p-10" aria-labelledby="navbarDropdown">--}}
{{--                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)--}}

{{--                                <a class="d-block p-1" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">--}}
{{--                                    {{ $properties['native'] }}--}}
{{--                                </a>--}}
{{--                            @endforeach--}}
{{--                    </div>--}}
{{--                </li>--}}

                <li class="nav-item dropdown">
                    <div class="btn-group mb-1">
                        <button type="button" class="btn p-10 btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{--   {{trans('main_trans.change_language')}}--}}
                            @if(App::getLocale() == 'ar')
                                العربية
                                <img src="{{ URL::asset('assets/images/flags/EG.png') }}" alt="">
                            @elseif(App::getLocale() == 'en')
                                 English
                                <img src="{{ URL::asset('assets/images/flags/US.png') }}" alt="">
                            @endif
                        </button>
                        <div class="dropdown-menu">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </li>

                <li class="nav-item fullscreen">
                    <a id="btnFullscreen" href="#" class="nav-link"><i class="ti-fullscreen"></i></a>
                </li>

                <livewire:notifactions.notifactions>
                
                <li class="nav-item dropdown mr-30">
                    <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        <img src="{{asset('assets/images/profile-avatar.jpg')}}" alt="avatar">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header">
                            <div class="media">
                                <div class="media-body">
{{--                                    <h5 class="mt-0 mb-0"> {{auth('admin')->user()->name}}</h5>--}}
{{--                                    <span>{{auth('admin')->user()->email}} </span>--}}
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <form method="GET" action="{{ route('logout.company') }}">
                            @csrf
                            <a class="dropdown-item" href="#" onclick="event.preventDefault();this.closest('form').submit();"><i class="bx bx-log-out"></i>تسجيل الخروج</a>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>

        <!--=================================
 header End-->
