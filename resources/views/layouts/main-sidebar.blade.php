<aside class="main-sidebar">
	<div class="user-profile">
		<div class="profile-pic">
			<img src="{{ image_exist(auth('company')->user()->logo_image) }}" alt="user">	
			<div class="profile-info text-white"><h4>{{ auth('company')->user()->company_name }}</h4>
				<div class="list-icons-item dropdown">
					<a href="#" class="list-icons-item dropdown-toggle text-white-50 hover-primary" data-bs-toggle="dropdown"><span class="badge badge-ring fill badge-primary mx-2"></span>Online</a>
					<div class="dropdown-menu">
						{{-- <a href="#" class="dropdown-item">Update data</a>
						<a href="#" class="dropdown-item">Detailed log</a>
						<a href="#" class="dropdown-item">Statistics</a>
						<a href="#" class="dropdown-item">Clear list</a> --}}
					</div>
				</div>
			</div>
		</div>
	</div> 
    <!-- sidebar-->
	<section class="sidebar position-relative">	
		<div class="multinav">
		<div class="multinav-scroll" style="height: 100%;">	
			<!-- sidebar menu-->
			<ul class="sidebar-menu" data-widget="tree">	
			  {{-- <li class="header">لوحه التحكم </li> --}}
			  <li  class="{{ request()->segment(1) == '' || request()->segment(2) == 'dashboard' ? 'active' : ''}}"> <a href="{{url('/')}}"><i class="fa fa-home"></i>الرئيسيه </a> </li>

			  @if (auth('company')->user()->role_id == 1 || auth('company')->user()->role_id == 3) 
				  @if(auth('company')->user()->role_id == 3 && auth('company')->user()->parent_id == 1)
						@if(auth('company')->user()->can('الدول'))
						<li class="{{ request()->segment(2) == 'countries' ? 'active' : ''}}"><i class="fa fa-globe"></i> قائمة الدول</a></li>
						@endif
						@if(auth('company')->user()->can('المدن'))
						<li class="{{ request()->segment(2) == 'cities' ? 'active' : ''}}"> <a href="{{route('cities.index')}}"><i class="fa fa-globe"></i> قائمة المدن</a></li>
						@endif
						@if(auth('company')->user()->can('الجنسيات'))
						<li class="{{ request()->segment(2) == 'nationalities' ? 'active' : ''}}"> <a href="{{route('nationalities.index')}}"> <i class="fa fa-hand-lizard-o"></i>قائمة الجنسيات</a> </li>
						@endif
						@if(auth('company')->user()->can('التخصصات'))
						<li class="{{ request()->segment(2) == 'specialties' ? 'active' : ''}}"> <a href="{{route('specialties.index')}}"><i class="fa fa-hourglass-start"></i> قائمة التخصصات</a> </li>
						@endif
						@if(auth('company')->user()->can('الدعايا'))
						<li class="{{ request()->segment(2) == 'reachedUs' ? 'active' : ''}}"> <a href="{{route('reachedUs.index')}}" ><i class="fa fa-futbol-o"></i> قائمة الدعايا </a> </li>
						@endif
						@if(auth('company')->user()->can('الشركات'))
						<li class="{{ request()->segment(2) == 'companies' ? 'active' : ''}}"> <a href="{{route('companies.index')}}"><i class="fa fa-industry"></i> قائمة الشركات</a></li>
						@endif
						@if(auth('company')->user()->can('الخصوصيه'))
						<li class="{{ request()->segment(2) == 'polices' ? 'active' : ''}}"> <a href="{{route('polices')}}"><i class="fa fa-info-circle"></i> سياسه الخصوصيه </a></li>
						@endif
						@if(auth('company')->user()->can('الاستفسارات'))
						<li class="{{ request()->segment(3) == 'inquiry' ? 'active' : ''}}"> <a href="{{url('static-table/inquiry')}}"><i class="fa fa-question"></i> الاستفسارات  </a></li>
						@endif
						<li class="{{ request()->segment(2) == 'trainers' ? 'active' : ''}}"> <a href="{{url('trainers')}}"><i class="fa fa-question-circle-o"></i>  المدربين  </a></li>
						<li class="{{ request()->segment(2) == 'commen-questions' ? 'active' : ''}}"> <a href="{{url('commen-questions')}}"><i class="fa fa-question-circle-o"></i> الاسئله الشائعه  </a></li>
						<li class="{{ request()->segment(2) == 'support-pending' ? 'active' : ''}}"> <a href="{{url('support-pending')}}"><i class="fa fa-toggle-on"></i>  التذاكر المعلقه  </a></li>
						<li class="{{ request()->segment(2) == 'support-done' ? 'active' : ''}}"> <a href="{{url('support-done')}}"><i class="fa fa-toggle-off"></i> التذاكر المنتهيه  </a></li>
				  @elseif(auth('company')->user()->role_id == 1)
						<li class="{{ request()->segment(2) == 'countries' ? 'active' : ''}}"> <a href="{{route('countries.index')}}"><i class="fa fa-globe"></i> قائمة الدول</a></li>
						<li class="{{ request()->segment(2) == 'cities' ? 'active' : ''}}"> <a href="{{route('cities.index')}}"><i class="fa fa-globe"></i> قائمة المدن</a></li>
						<li class="{{ request()->segment(2) == 'nationalities' ? 'active' : ''}}"> <a href="{{route('nationalities.index')}}"><i class="fa fa-hand-lizard-o"></i> قائمة الجنسيات</a> </li>
						<li class="{{ request()->segment(2) == 'specialties' ? 'active' : ''}}"> <a href="{{route('specialties.index')}}"><i class="fa fa-hourglass-start"></i> قائمة التخصصات</a> </li>
						<li class="{{ request()->segment(2) == 'reachedUs' ? 'active' : ''}}"> <a href="{{route('reachedUs.index')}}" ><i class="fa fa-futbol-o"></i> قائمة الدعايا </a> </li>
						<li class="{{ request()->segment(2) == 'companies' ? 'active' : ''}}"> <a href="{{route('companies.index')}}"><i class="fa fa-industry"></i> قائمة الشركات</a></li>
						<li class="{{ request()->segment(2) == 'polices' ? 'active' : ''}}"> <a href="{{route('polices')}}"><i class="fa fa-info-circle"></i> سياسه الخصوصيه </a></li>
						<li class="{{ request()->segment(3) == 'inquiry' ? 'active' : ''}}"> <a href="{{url('static-table/inquiry')}}"><i class="fa fa-question"></i> الاستفسارات  </a></li>
						<li class="{{ request()->segment(2) == 'trainers' ? 'active' : ''}}"> <a href="{{url('trainers')}}"><i class="fa fa-question-circle-o"></i>  المدربين  </a></li>
						<li class="{{ request()->segment(2) == 'commen-questions' ? 'active' : ''}}"> <a href="{{url('commen-questions')}}"><i class="fa fa-question-circle-o"></i> الاسئله الشائعه  </a></li>
						<li class="{{ request()->segment(2) == 'support-pending' ? 'active' : ''}}"> <a href="{{url('support-pending')}}"><i class="fa fa-toggle-on"></i>  التذاكر المعلقه  </a></li>
						<li class="{{ request()->segment(2) == 'support-done' ? 'active' : ''}}"> <a href="{{url('support-done')}}"><i class="fa fa-toggle-off"></i> التذاكر المنتهيه  </a></li>
				  @endif
			  @endif
				@if(auth('company')->user()->can('مستخدمين لوحه التحكم'))
				<li  class="{{ request()->segment(2) == 'employees-dashboard' ? 'active' : ''}}"> <a href="{{url('employees-dashboard')}}"><i class="wi wi-day-cloudy-high"></i> مستخدمي لوحه التحكم</a> </li>
				@endif
				@if(auth('company')->user()->can('الموظفين'))
				<li  class="{{ request()->segment(2) == 'users' ? 'active' : ''}}"> <a href="{{route('users.index')}}"><i class="fa fa-user-o" aria-hidden="true"></i> قائمة الموظفين</a> </li>
				@endif
				@if(auth('company')->user()->can('الوظائف'))
				{{-- <li class="{{ (request()->segment(2) == 'jobs' || request()->segment(2) == 'jobs-expaire'  ? 'active' : '')}}"> --}}
						<li class="{{ (request()->segment(2) == 'jobs' || request()->segment(2) == 'jobs-expaire'  ? 'active' : 'treeview')}}">
							<a href="#">
								<i class="fa fa-random"  aria-hidden="true"></i>
								<span>قائمه المشاريع</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">


						<li  class=""> <a href="{{route('jobs.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i> المشاريع الحاليه</a></li>
						<li  class=""> <a href="{{url('jobs-expaire')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i> المشاريع المنتهيه</a></li>
					</ul>
				</li>
				@endif
				@if(auth('company')->user()->can('الدورات التدريبيه'))
				<li  class="{{ request()->segment(2) == 'traning-course' ? 'active' : ''}}"> <a href="{{url('traning-course')}}"><i class="fa fa-pencil" aria-hidden="true"></i> الدورات التدريبيه</a></li>
				@endif
				@if(auth('company')->user()->can('اضافه دوره لمستخدم'))
				<li  class="{{ request()->segment(2) == 'user-traning' ? 'active' : ''}}"> <a href="{{url('user-traning')}}"><i class="fa fa-plus"  aria-hidden="true"></i>  اضافه دوره لمستخدم</a></li>
				@endif
				  @if(auth('company')->user()->can('الغيابات'))
				  <li class="{{ request()->segment(2) == 'absences' ? 'active' : ''}}"> <a href="{{route('absences')}}"><i class="fa fa-blind" aria-hidden="true"></i>  تقرير الغيابات</a></li>
				  @endif
				  @if(auth('company')->user()->can('التاخير'))
				  <li class="{{ request()->segment(2) == 'latest' ? 'active' : ''}}"> <a href="{{route('latest')}}"><i class="fa fa-bullhorn" aria-hidden="true"></i> تقرير التاخير</a></li>

				  @endif
				  @if(auth('company')->user()->can('التحويلات'))
				  <li class="{{ request()->segment(2) == 'user-moey' ? 'active' : ''}}"> <a href="{{route('user-moey')}}"><i class="fa fa-fw fa-transgender-alt" aria-hidden="true"></i> تقرير التحويلات</a></li>
				  @endif
				  @if(auth('company')->user()->can('تقرير الدورات التدريبيه'))
				  <li class="{{ request()->segment(2) == 'tranings' ? 'active' : ''}}"> <a href="{{route('tranings')}}"><i class="fa fa-square" aria-hidden="true"></i> تقرير الدورات التدريبه</a></li>
				  @endif
				  @if(auth('company')->user()->can('التوظيف'))
				  <li class="{{ request()->segment(2) == 'employments' ? 'active' : ''}}"> <a href="{{route('employments')}}"> <i class="fa fa-tasks" aria-hidden="true"></i> تقرير التوظيف</a></li> 
				  @endif
			</ul>
			
			<div class="sidebar-widgets" style="margin-top: 154px !important; ">				
			  <div class="copyright text-start m-25">
				  <p><strong class="d-block">R7 Dashboard</strong> © 2021 All Rights Reserved</p>
			  </div>
			</div>
		</div>
	  </div>
  </section>
  </aside>