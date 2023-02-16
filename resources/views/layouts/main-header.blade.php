<div id="loader"></div>

<header class="main-header">
	<div class="d-flex align-items-center logo-box justify-content-center">	
		<!-- Logo -->
		<a href="{{ url('/') }}" class="logo">
		  <!-- logo-->
		  {{-- <div class="logo-mini w-30">
			  <span class="light-logo"><img src="{{ asset('admin/images/logo-letter.png') }}" alt="logo"></span>
			  <span class="dark-logo"><img src="{{ asset('admin/images/logo-letter.png') }}" alt="logo"></span>
		  </div> --}}
		  <div class="logo-lg">
			  <span class="light-logo"><img src="{{ asset('assets/images/New Project.png') }}" alt="logo"></span>
			  <span class="dark-logo"><img src="{{ asset('assets/images/New Project.png') }}" alt="logo"></span>
		  </div>
		</a>	
	</div>  
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
	  <div class="app-menu">
		<ul class="header-megamenu nav">
			<li class="btn-group nav-item">
				<a href="#" class="waves-effect waves-light nav-link push-btn btn-outline no-border btn-primary-light text-dark hover-white" data-toggle="push-menu" role="button">
					<i data-feather="align-left"></i>
			    </a>
			</li>				  
			{{-- <li class="btn-group d-lg-inline-flex d-none">
				<div class="app-menu">
					<div class="search-bx mx-5">
						<form>
							<div class="input-group">
							  <input type="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
							  <div class="input-group-append">
								<button class="btn" type="submit" id="button-addon3"><i data-feather="search"></i></button>
							  </div>
							</div>
						</form>
					</div>
				</div>
			</li> --}}
			{{-- <li class="btn-group nav-item d-none d-xl-inline-block">
				<a href="contact_app_chat.html" class="waves-effect waves-light nav-link btn-outline no-border svg-bt-icon btn-info-light text-dark hover-white" title="Chat">
					<i data-feather="message-circle"></i>
			    </a>
			</li>
			<li class="btn-group nav-item d-none d-xl-inline-block">
				<a href="mailbox.html" class="waves-effect waves-light nav-link btn-outline no-border svg-bt-icon btn-danger-light text-dark hover-white" title="Mailbox">
					<i data-feather="at-sign"></i>
			    </a>
			</li> --}}
			<li class="btn-group nav-item d-none d-xl-inline-block">
				<a href="{{ url('everyday-tasks') }}" class="waves-effect waves-light btn-outline no-border nav-link svg-bt-icon btn-success-light text-dark hover-white" title="المهام اليوميه">
					<i data-feather="clipboard"></i>
			    </a>
			</li>
		</ul> 
	  </div>
		
      <div class="navbar-custom-menu r-side">
        <ul class="nav navbar-nav">		 
			<li class="btn-group nav-item d-lg-inline-flex d-none">
				<a href="#" data-provide="fullscreen" class="waves-effect waves-light nav-link btn-outline no-border full-screen btn-warning-light text-dark hover-white" title="Full Screen">
					<i data-feather="maximize"></i>
			    </a>
			</li>
		  <!-- Notifications -->
		  @livewire('notifactions.notifaction-header')
		  
	      <!-- User Account-->
          <li class="dropdown user user-menu">
            <a href="#" class="waves-effect waves-light dropdown-toggle no-border p-5 text-dark hover-white" data-bs-toggle="dropdown" title="User">
				<img class="avatar avatar-pill" src="{{ image_exist(auth('company')->user()->logo_image) }}" alt="">
            </a>
            <ul class="dropdown-menu animated flipInX">
              <li class="user-body">
				 <a class="dropdown-item" href="{{ url('profile') }}"><i class="ti-user text-muted me-2"></i> الملف الشخصي</a>
				 {{-- <a class="dropdown-item" href="#"><i class="ti-wallet text-muted me-2"></i> My Wallet</a>
				 <a class="dropdown-item" href="#"><i class="ti-settings text-muted me-2"></i> Settings</a> --}}
				 <div class="dropdown-divider"></div>
				 {{-- <a class="dropdown-item" href="#"><i class="ti-lock text-muted me-2"></i> تسجيل خروج</a> --}}
				 <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
					<i class="ti-lock text-muted me-2"></i>تسجيل خروج
				</a>

				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					@csrf
				</form>
              </li>
            </ul>
          </li>			  
          <!-- Control Sidebar Toggle Button -->
          <li>
              <a href="#" data-toggle="control-sidebar" title="Setting" class="waves-effect waves-light btn-outline no-border btn-danger-light text-dark hover-white">
			  	<i data-feather="settings"></i>
			  </a>
          </li>
			
        </ul>
      </div>
    </nav>
</header>