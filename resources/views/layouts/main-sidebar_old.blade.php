  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
	<div class="user-profile">
		<div class="profile-pic">
			
			<img src="{{ image_exist(auth('company')->user()->logo_image) }}"" alt="user">	
			{{-- <div class="profile-info"><h4>John Doe</h4>
				<div class="list-icons-item dropdown">
					<a href="#" class="list-icons-item dropdown-toggle" data-bs-toggle="dropdown"><span class="badge badge-ring fill badge-primary mx-2"></span>Online</a>
					<div class="dropdown-menu">
						<a href="#" class="dropdown-item">Update data</a>
						<a href="#" class="dropdown-item">Detailed log</a>
						<a href="#" class="dropdown-item">Statistics</a>
						<a href="#" class="dropdown-item">Clear list</a>
					</div>
				</div>
			</div> --}}
		</div>
	</div>
    <!-- sidebar-->
    <section class="sidebar position-relative">	
	  	<div class="multinav">
		  <div class="multinav-scroll" style="height: 100%;">	
			  <!-- sidebar menu-->
			  <ul class="sidebar-menu" data-widget="tree">	
				<li class="header">لوحه التحكم </li>
				@if (auth('company')->user()->role_id == 1 || auth('company')->user()->role_id == 3) 
					@if(auth('company')->user()->role_id == 3 && auth('company')->user()->parent_id == 1)
						<li class="treeview">
							<a href="#">
							<i data-feather="grid"></i>
							<span>قاعده البيانات </span>
							<span class="pull-right-container">
								<i class="fa fa-angle-right pull-right"></i>
							</span>
							</a>
							<ul class="treeview-menu">
								@if(auth('company')->user()->can('الدول'))
								<li> <a href="{{route('countries.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i> قائمة الدول</a></li>
								@endif
								@if(auth('company')->user()->can('المدن'))
								<li> <a href="{{route('cities.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i> قائمة المدن</a></li>
								@endif
								@if(auth('company')->user()->can('الجنسيات'))
								<li> <a href="{{route('nationalities.index')}}"> <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>قائمة الجنسيات</a> </li>
								@endif
								@if(auth('company')->user()->can('التخصصات'))
								<li> <a href="{{route('specialties.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i> قائمة التخصصات</a> </li>
								@endif
								@if(auth('company')->user()->can('الدعايا'))
								<li> <a href="{{route('reachedUs.index')}}" ><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i> قائمة الدعايا </a> </li>
								@endif
								@if(auth('company')->user()->can('الشركات'))
								<li> <a href="{{route('companies.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i> قائمة الشركات</a></li>
								@endif
								@if(auth('company')->user()->can('الخصوصيه'))
								<li> <a href="{{route('polices')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i> سياسه الخصوصيه </a></li>
								@endif
								@if(auth('company')->user()->can('الاستفسارات'))
								<li> <a href="{{url('static-table/inquiry')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i> الاستفسارات  </a></li>
								@endif
								<li> <a href="{{url('commen-questions')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i> الاسئله الشائعه  </a></li>
								<li> <a href="{{url('support-pending')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>  التذاكر المعلقه  </a></li>
								<li> <a href="{{url('commen-questions')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i> التذاكر المنتهيه  </a></li>
							</ul>
						</li>
					@elseif(auth('company')->user()->role_id == 1)
						<li class="treeview">
						<a href="#">
							<i data-feather="grid"></i>
							<span>قاعده البيانات </span>
							<span class="pull-right-container">
							<i class="fa fa-angle-right pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li> <a href="{{route('countries.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i> قائمة الدول</a></li>
							<li> <a href="{{route('cities.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i> قائمة المدن</a></li>
							<li> <a href="{{route('nationalities.index')}}"> <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>قائمة الجنسيات</a> </li>
							<li> <a href="{{route('specialties.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i> قائمة التخصصات</a> </li>
							<li> <a href="{{route('reachedUs.index')}}" ><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i> قائمة الدعايا </a> </li>
							<li> <a href="{{route('companies.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i> قائمة الشركات</a></li>
							<li> <a href="{{route('polices')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i> سياسه الخصوصيه </a></li>
							<li> <a href="{{url('static-table/inquiry')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i> الاستفسارات  </a></li>
							<li> <a href="{{url('commen-questions')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i> الاسئله الشائعه  </a></li>
							<li> <a href="{{url('support-pending')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>  التذاكر المعلقه  </a></li>
							<li> <a href="{{url('commen-questions')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i> التذاكر المنتهيه  </a></li>
						</ul>
						</li>
					@endif
				@endif
			
				<li class="treeview">
					<a href="#">
						<i data-feather="edit"></i>
						<span>ادارة الموارد البشريه</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-right pull-right"></i>
						</span>
					</a>
				  	<ul class="treeview-menu">
						@if(auth('company')->user()->can('مستخدمين لوحه التحكم'))
						<li> <a href="{{url('employees-dashboard')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i> مستخدمي لوحه التحكم</a> </li>
						@endif
						@if(auth('company')->user()->can('الموظفين'))
						<li> <a href="{{route('users.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>قائمة الموظفين</a> </li>
						@endif
						@if(auth('company')->user()->can('الوظائف'))
						<li> <a href="{{route('jobs.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>قائمة الوظائف</a></li>
						@endif
						@if(auth('company')->user()->can('الدورات التدريبيه'))
						<li> <a href="{{url('traning-course')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i> الدورات التدريبيه</a></li>
						@endif
						@if(auth('company')->user()->can('اضافه دوره لمستخدم'))
						<li> <a href="{{url('user-traning')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>  اضافه دوره لمستخدم</a></li>
						@endif
					</ul>
				</li> 				 
	
				<li class="treeview">
				  <a href="#">
					<i data-feather="cast"></i>
					<span>التقارير</span>
					<span class="pull-right-container">
					  <i class="fa fa-angle-right pull-right"></i>
					</span>
				  </a>
				  <ul class="treeview-menu">
					@if(auth('company')->user()->can('الغيابات'))
					<li> <a href="{{route('absences')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i> تقرير الغيابات</a></li>
					@endif
					@if(auth('company')->user()->can('التاخير'))
					<li> <a href="{{route('latest')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>تقرير التاخير</a></li>

					@endif
					@if(auth('company')->user()->can('التحويلات'))
					<li> <a href="{{route('user-moey')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>تقرير التحويلات</a></li>

					@endif
					@if(auth('company')->user()->can('تقرير الدورات التدريبيه'))
					<li> <a href="{{route('tranings')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>تقرير الدورات التدريبه</a></li>
					@endif
					@if(auth('company')->user()->can('التوظيف'))
					<li> <a href="{{route('employments')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>تقرير التوظيف</a></li>
					@endif
					
					
				  </ul>
				</li>
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