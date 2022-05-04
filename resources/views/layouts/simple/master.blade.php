<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    {{-- Meta Tags --}}
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('page_description', $page['description'] ?? 'E-SarprasTI adalah Website Aplikasi Kinerja di Bagian Sarana dan Prasarana Teknologi Informasi PMPTSP Pusdatin PMPTSP')">
    <meta name="keywords" content="e-sarpras, pusdatin, jakevo, ptsp, dpmptsp, jakarta">
    <meta name="author" content="Ravi Zulfikar">
    {{-- Meta Tags --}}

    {{-- Title --}}
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <title>{{ config('app.name') }} | @yield('title', $page['title'] ?? '')</title>
    {{-- Title --}}

    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    @include('layouts.simple.css')

    {{-- @yield('style') --}}

  </head>
  <body class="{{ (!empty(Auth::user()->theme->class)) ? Auth::user()->theme->class : "" }}" @if(Route::current()->getName() == 'index') onload="startTime()" @endif>

    @include('layouts.simple.loader')
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
      @include('layouts.simple.header')
      <!-- Page Header Ends  -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        @include('layouts.simple.sidebar')
        <!-- Page Sidebar Ends-->
        <div class="page-body">
          <div class="container-fluid">        
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  @yield('breadcrumb-title')
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('/') }}"> <i data-feather="home"></i></a></li>
                    @yield('breadcrumb-items')
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          @yield('content')
          <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
        @include('layouts.simple.footer') 
        
      </div>
    </div>
    <!-- latest jquery-->
    @include('layouts.simple.script')  
    <!-- Plugin used-->

    <script type="text/javascript">
      if ($(".page-wrapper").hasClass("horizontal-wrapper")) {
            $(".according-menu.other" ).css( "display", "none" );
            $(".sidebar-submenu" ).css( "display", "block" );
      }
    </script>

  </body>
</html>