<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="{{ asset('assets/images/header.png') }}"> 

<title>@yield('title')</title>

<!-- Vendors Style-->
<link rel="stylesheet" href="{{ url('admin_new/css/vendors_css.css') }}">
  
<!-- Style-->  
<link rel="stylesheet" href="{{ url('admin_new/css/style.css') }}">
<link rel="stylesheet" href="{{ url('admin_new/css/skin_color.css') }}">

@yield('css')

<!--- Style css -->

{{-- @if (App::getLocale() == 'ar')
    <link href="{{ URL::asset('assets/css/rtl.css') }}" rel="stylesheet">
@else
    <link href="{{ URL::asset('assets/css/ltr.css') }}" rel="stylesheet">
@endif --}}

@yield('style')
@livewireStyles
