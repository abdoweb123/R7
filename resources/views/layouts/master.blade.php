<!DOCTYPE html>
<html lang="en">
  <head>
    @include('layouts.head')
    @livewireStyles
  </head>

<body class="hold-transition {{ (auth('company')->user()->dark_mode == 'Y' ? 'dark' :'light' ) }}-skin  sidebar-mini theme-primary fixed {{ (auth('company')->user()->lang=='ar' ? 'rtl' :'') }}">
	
<div class="wrapper">

    @include('layouts.main-header')

    @include('layouts.main-sidebar')
  


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Main content -->
		<section class="content">			
			@yield('content')
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  </div>
  </div>
 
  @include('layouts.footer')
  
</div>

@include('layouts.footer-scripts')
	
	
</body>
</html>
