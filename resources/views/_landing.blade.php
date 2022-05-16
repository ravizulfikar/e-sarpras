<!DOCTYPE html>
<html lang="en">
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
    <title>{{ config('app.name') }} | Website Kinerja SarprasTI Pusdatin PMPTSP</title>
    {{-- Title --}}

    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.css') }}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/icofont.css') }}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/flag-icon.css') }}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">
    <!-- Plugins css start-->
    <link rel="stylesheet" href="{{ asset('assets/plugin/izitoast/dist/css/iziToast.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/owlcarousel.css') }}">
    <!-- Plugins css Ends-->
    
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('assets/css/color-1.css') }}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">
  </head>
  <body class="landing-page">
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper landing-page">
      <!-- Page Body Start            -->
      <div class="landing-home">
        <ul class="decoration">
          <li class="one"><img class="img-fluid" src="{{ asset('assets/images/landing/decore/1.png') }}" alt=""></li>
          <li class="two"><img class="img-fluid" src="{{ asset('assets/images/landing/decore/2.png') }}" alt=""></li>
          <li class="three"><img class="img-fluid" src="{{ asset('assets/images/landing/decore/4.png') }}" alt=""></li>
          <li class="four"><img class="img-fluid" src="{{ asset('assets/images/landing/decore/3.png') }}" alt=""></li>
          <li class="five"><img class="img-fluid" src="{{ asset('assets/images/landing/2.png') }}" alt=""></li>
          <li class="six"><img class="img-fluid" src="{{ asset('assets/images/landing/decore/cloud.png') }}" alt=""></li>
          <li class="seven"><img class="img-fluid" src="{{ asset('assets/images/landing/2.png') }}" alt=""></li>
        </ul>
        <div class="container-fluid">
          <div class="sticky-header">
            <header>                       
              <nav class="navbar navbar-b navbar-trans navbar-expand-xl fixed-top nav-padding" id="sidebar-menu"><a class="navbar-brand p-0" href="#"><img class="img-fluid" src="{{ asset('assets/images/landing/landing_logo.png') }}" alt=""></a>
                <button class="navbar-toggler navabr_btn-set custom_nav" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation"><span></span><span></span><span></span></button>
                <div class="navbar-collapse justify-content-end collapse hidenav" id="navbarDefault">
                  <ul class="navbar-nav navbar_nav_modify" id="scroll-spy">
                    <li class="nav-item"><a class="nav-link" href="#layout">Activity</a></li>
                    <li class="nav-item"><a class="nav-link" href="#frameworks">The Teams</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('ticket.createUser') }}">Create Ticket</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('ticket.historyUser') }}">History Ticket</a></li>
                    @guest
                    <li class="nav-item buy-btn"><a class="nav-link js-scroll" href="{{ route('login') }}">Login</a></li>
                    @else
                    <li class="nav-item buy-btn"><a class="nav-link js-scroll" href="{{ route('index') }}">Dashboard</a></li>
                    @endguest
                  </ul>
                </div>
              </nav>
            </header>
          </div>
          <div class="row">
            <div class="col-xl-5 col-lg-6">
              <div class="content">
                <div>
                  <h1 class="wow fadeIn">Pusdatin  </h1>
                  <h1 class="wow fadeIn">PMPTSP</h1>
                  <h2 class="txt-secondary wow fadeIn">DPMPTSP Provinsi DKI Jakarta</h2>
                  <p class="mt-3 wow fadeIn">Sarana dan Prasarana Teknologi Informasi</p>
                  
                </div>
              </div>
            </div>
            <div class="col-xl-7 col-lg-6">                 
              <div class="wow fadeIn"><img class="screen1" src="{{ asset('assets/images/landing/screen1.jpg') }}" alt=""></div>
              <div class="wow fadeIn"><img class="screen2" src="{{ asset('assets/images/landing/screen2.jpg') }}" alt=""></div>
            </div>
          </div>
        </div>
      </div>
      <section class="section-space cuba-demo-section layout" id="layout">
        <div class="container">
          <div class="row">
            <div class="col-sm-12 wow pulse">
              <div class="cuba-demo-content">
                <div class="couting">
                  <h2>Activity</h2>
                  <p>Sarana dan Prasarana Teknologi Informasi</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="row demo-imgs">

            <div class="col-lg-4 col-md-6 wow pulse demo-content">
              <div class="cuba-demo-img">
                <div class="overflow-hidden">
                  <img class="img-fluid" src="{{ asset('assets/images/landing/layout-images/dubai.jpg') }}" alt="default">
                </div>
              </div>
              <div class="title-wrapper">
                <div class="content">
                  <h3 class="theme-name mb-0">Troubelshooting</h3>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 wow pulse demo-content">
              <div class="cuba-demo-img">
                <div class="overflow-hidden">
                  <img class="img-fluid" src="{{ asset('assets/images/landing/layout-images/dubai.jpg') }}" alt="default">
                </div>
              </div>
              <div class="title-wrapper">
                <div class="content">
                  <h3 class="theme-name mb-0">Maintenance</h3>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 wow pulse demo-content">
              <div class="cuba-demo-img">
                <div class="overflow-hidden">
                  <img class="img-fluid" src="{{ asset('assets/images/landing/layout-images/dubai.jpg') }}" alt="default">
                </div>
              </div>
              <div class="title-wrapper">
                <div class="content">
                  <h3 class="theme-name mb-0">Monitoring</h3>
                </div>
              </div>
            </div>

          </div>
        </div>
      </section>
      <section class="section-space cuba-demo-section app_bg frameworks-section" id="frameworks">
        <div class="container">
          <div class="row">                 
            <div class="col-sm-12 wow pulse">
              <div class="cuba-demo-content mt50">
                <div class="couting">
                  <h2>The Teams</h2>
                </div>
                <p class="mb-0">Sarana dan Prasarana Teknologi Informasi</p>
              </div>
            </div>
            <div class="col-sm-12 framworks">                 
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                  <ul class="framworks-list">
                    <li class="box wow fadeInUp">
                      <div> <img src="{{ asset('assets/images/landing/icon/html/bootstrap.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Booxstrap 4X</h6>
                    </li>
                    <li class="box wow fadeInUp">
                      <div> <img src="{{ asset('assets/images/landing/icon/html/css.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">CSS</h6>
                    </li>
                    <li class="box wow fadeInUp">
                      <div> <img src="{{ asset('assets/images/landing/icon/html/sass.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Sass</h6>
                    </li>
                    <li class="box wow fadeInUp">
                      <div> <img src="{{ asset('assets/images/landing/icon/html/pug.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Pug</h6>
                    </li>
                    <li class="box wow fadeInUp">
                      <div> <img src="{{ asset('assets/images/landing/icon/html/npm.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">NPM</h6>
                    </li>
                    <li class="box wow fadeInUp">
                      <div> <img src="{{ asset('assets/images/landing/icon/html/gulp.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Gulp</h6>
                    </li>
                    <li class="box wow bounceIn">                                   
                      <div> <img src="{{ asset('assets/images/landing/icon/html/kit.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Starter Kit</h6>
                    </li>
                    <li class="box wow bounceIn">                                    
                      <div> <img src="{{ asset('assets/images/landing/icon/html/uikits.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">40+ UI Kits</h6>
                    </li>
                    <li class="box wow bounceIn">                                    
                      <div> <img src="{{ asset('assets/images/landing/icon/html/layout.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">8+ Layout</h6>
                    </li>
                    <li class="box wow bounceIn">                                    
                      <div> <img src="{{ asset('assets/images/landing/icon/html/builders.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Builders</h6>
                    </li>
                    <li class="box wow bounceIn">                                    
                      <div> <img src="{{ asset('assets/images/landing/icon/html/iconset.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">11 Icon Sets</h6>
                    </li>
                    <li class="box wow bounceIn">                                    
                      <div> <img src="{{ asset('assets/images/landing/icon/html/forms.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Forms</h6>
                    </li>
                    <li class="box wow bounceIn">                                    
                      <div> <img src="{{ asset('assets/images/landing/icon/html/table.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Tables</h6>
                    </li>
                    <li class="box wow bounceIn">                                    
                      <div> <img src="{{ asset('assets/images/landing/icon/html/apps.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">17+ Apps</h6>
                    </li>
                  </ul>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                  <ul class="framworks-list">
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/react/hook.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">React Hook</h6>
                    </li>
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/react/reactstrap.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">React Strap</h6>
                    </li>
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/react/noquery.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">No Jquery</h6>
                    </li>
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/react/redux.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Redux</h6>
                    </li>
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/react/firebase.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Firebase Auth</h6>
                    </li>
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/react/crud.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Firebase Crud</h6>
                    </li>
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/react/chat.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Chat</h6>
                    </li>
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/react/animation.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Router Animation</h6>
                    </li>
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/react/props_state.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">State & Props</h6>
                    </li>
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/react/reactrouter.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Reactrouter</h6>
                    </li>
                    <li class="box wow bounceIn">                                    
                      <div> <img src="{{ asset('assets/images/landing/icon/react/chart.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Amazing Chart</h6>
                    </li>
                    <li class="box wow bounceIn">                                    
                      <div> <img src="{{ asset('assets/images/landing/icon/react/map.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Map</h6>
                    </li>
                    <li class="box wow bounceIn">                                    
                      <div> <img src="{{ asset('assets/images/landing/icon/react/gallery.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Gallery</h6>
                    </li>
                    <li class="box wow bounceIn">                                    
                      <div> <img src="{{ asset('assets/images/landing/icon/react/application.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">9+ Apps</h6>
                    </li>
                  </ul>
                </div>
                <div class="tab-pane fade" id="pills-angular" role="tabpanel" aria-labelledby="pills-angular-tab">
                  <ul class="framworks-list">
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/angular/1.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">SCSS</h6>
                    </li>
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/angular/2.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Ng Bootstrap</h6>
                    </li>
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/angular/3.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">RXjs</h6>
                    </li>
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/angular/4.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Router</h6>
                    </li>
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/angular/5.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Form</h6>
                    </li>
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/angular/6.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Apex chart</h6>
                    </li>
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/angular/7.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Chart.js</h6>
                    </li>
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/angular/8.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Chartist</h6>
                    </li>
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/angular/9.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Google Map</h6>
                    </li>
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/angular/10.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Gallery</h6>
                    </li>
                    <li class="box wow bounceIn">                                    
                      <div> <img src="{{ asset('assets/images/landing/icon/angular/11.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Ecommerce</h6>
                    </li>
                    <li class="box wow bounceIn">                                    
                      <div> <img src="{{ asset('assets/images/landing/icon/angular/12.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Firebase Auth</h6>
                    </li>
                    <li class="box wow bounceIn">                                    
                      <div> <img src="{{ asset('assets/images/landing/icon/angular/13.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Firebase Crud</h6>
                    </li>
                    <li class="box wow bounceIn">                                    
                      <div> <img src="{{ asset('assets/images/landing/icon/angular/14.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Chat</h6>
                    </li>
                  </ul>
                </div>
                <div class="tab-pane fade" id="pills-vue" role="tabpanel" aria-labelledby="pills-vue-tab">
                  <ul class="framworks-list">
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/vue/firebase.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Firebase</h6>
                    </li>
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/vue/nojquery.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">No jquery</h6>
                    </li>
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/vue/vuebootstrap.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Vue Bootstrap</h6>
                    </li>
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/vue/vuex.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Vuex</h6>
                    </li>
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/vue/chart.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Chart</h6>
                    </li>
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/vue/vueswiper.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Vue Swiper</h6>
                    </li>
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/vue/vuerouter.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Vue Router</h6>
                    </li>
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/vue/vuemasonary.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Vue Masonary</h6>
                    </li>
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/vue/vuecli.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Vue Cli</h6>
                    </li>
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/vue/animation.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Animation</h6>
                    </li>
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/vue/rangeslider.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Range Slider</h6>
                    </li>
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/vue/rtlsupport.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">RTL Support</h6>
                    </li>
                  </ul>
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                  <ul class="framworks-list">
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/laravel/laravel.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Laravel 7</h6>
                    </li>
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/laravel/bootstrap.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Bootstrap 5</h6>
                    </li>
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/html/sass.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">SASS</h6>
                    </li>
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/laravel/blade.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Blade</h6>
                    </li>
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/laravel/layouts.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Layouts</h6>
                    </li>
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/laravel/npm.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">NPM</h6>
                    </li>
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/laravel/mix.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">MIX</h6>
                    </li>
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/laravel/yarn.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Yarn</h6>
                    </li>
                    <li class="box">
                      <div> <img src="{{ asset('assets/images/landing/icon/laravel/sasswebpack.png') }}" alt=""></div>
                      <h6 class="mb-0 mt-3">Sasswebpack</h6>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <footer class="footer-bg">
        <div class="container">
          <div class="landing-center ptb50">
            <div class="title"><img class="img-fluid" src="{{ asset('assets/images/landing/landing_logo.png') }}" alt=""></div>
            <div class="footer-content">
              <h1>Website Application support ticket in Dinas PMPTSP Provinsi DKI Jakarta</h1>
              <p>If You Have any trouble ?. Let's Create the Ticket!</p>
              <a class="btn mrl5 btn-lg btn-primary default-view" target="_blank" href="{{ route('ticket.createUser') }}">Create Ticket Now</a>
              <a class="btn mrl5 btn-lg btn-warning default-view" target="_blank" href="{{ route('ticket.historyUser') }}">History Ticket</a>
              {{-- <a class="btn mrl5 btn-lg btn-secondary btn-md-res" target="_blank" href="https://1.envato.market/3GVzd">Buy Now                    </a> --}}
            </div>
            <br><br><br><br><br><br>
          </div>
        </div>
      </footer>
    </div>
    <!-- latest jquery-->
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>
    <!-- scrollbar js-->
    <!-- Sidebar jquery-->
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <!-- Plugins JS start-->
    <script src="{{ asset('assets/js/owlcarousel/owl.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
    <script src="{{ asset('assets/js/animation/wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/landing_sticky.js') }}"></script>
    <script src="{{ asset('assets/js/landing.js') }}"></script>
    
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <!-- login js-->
    <!-- Plugin used-->

    <script src="{{ asset('assets/plugin/izitoast/dist/js/iziToast.min.js')}}"></script>
    
    <script>
      @if ($errors->any())
          @foreach ($errors->all() as $error)
              iziToast.error({
                  message: "{{ $error }}",
                  position: 'bottomRight'
              });
          @endforeach
      @endif

      @if(Session::has('success'))
          iziToast.success({
              message: "{{ session('success') }}",
              position: 'topRight'
          });
      @endif
      
      @if(Session::has('error'))
          iziToast.error({
              message: "{{ session('error') }}",
              position: 'topRight'
          });
      @endif
      
      @if(Session::has('info'))
          iziToast.info({
              message: "{{ session('info') }}",
              position: 'topRight'
          });
      @endif
      
      @if(Session::has('warning'))
          iziToast.warning({
              message: "{{ session('warning') }}",
              position: 'topRight'
          });
      @endif

  </script>
  </body>
</html>