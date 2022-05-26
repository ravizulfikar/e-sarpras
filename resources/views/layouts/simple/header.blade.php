<div class="page-header">
  <div class="header-wrapper row m-0">
    
    @include('layouts.simple.searchbar')

    <div class="header-logo-wrapper col-auto p-0">
      <div class="logo-wrapper"><a href="{{route('/')}}"><img class="img-fluid" src="{{asset('assets/images/logo/logo.png')}}" alt=""></a></div>
      <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
    </div>
    
    <div class="left-header col-4 horizontal-wrapper ps-0">
      {{-- <ul class="horizontal-menu">
        <li class="mega-menu outside">
          <a class="nav-link" href="#!"><i data-feather="layers"></i><span>Bonus Ui</span></a>
          <div class="mega-menu-container nav-submenu menu-to-be-close header-mega">
            <div class="container-fluid">
              <div class="row">
                <div class="col mega-box">
                  <div class="mobile-title d-none">
                    <h5>Mega menu</h5>
                    <i data-feather="x"></i>
                  </div>
                  <div class="link-section icon">
                    <div>
                      <h6>Error Page</h6>
                    </div>
                    <ul>
                      <li><a href="{{route('error-400')}}">Error page 400</a></li>
                      <li><a href="{{route('error-401')}}">Error page 401</a></li>
                      <li><a href="{{route('error-403')}}">Error page 403</a></li>
                      <li><a href="{{route('error-404')}}">Error page 404</a></li>
                      <li><a href="{{route('error-500')}}">Error page 500</a></li>
                      <li><a href="{{route('error-503')}}">Error page 503</a></li>
                    </ul>
                  </div>
                </div>
                <div class="col mega-box">
                  <div class="link-section doted">
                    <div>
                      <h6> Authentication</h6>
                    </div>
                    <ul>
                      <li><a href="{{route('sign-up')}}">Sign Up</a></li>
                      <li><a href="{{route('sign-up-one')}}">SignUp with image</a></li>
                      <li><a href="{{route('sign-up-two')}}">SignUp with image</a></li>
                    </ul>
                  </div>
                </div>
                <div class="col mega-box">
                  <div class="link-section dashed-links">
                    <div>
                      <h6>Usefull Pages</h6>
                    </div>
                    <ul>
                      <li><a href="{{route('search')}}">Search Website</a></li>
                      <li><a href="{{route('unlock')}}">Unlock User</a></li>
                      <li><a href="{{route('forget-password')}}">Forget Password</a></li>
                      <li><a href="{{route('reset-password')}}">Reset Password</a></li>
                      <li><a href="{{route('maintenance')}}">Maintenance</a></li>
                    </ul>
                  </div>
                </div>
                <div class="col mega-box">
                  <div class="link-section">
                    <div>
                      <h6>Email templates</h6>
                    </div>
                    <ul>
                      <li class="ps-0"><a href="{{route('basic-template')}}">Basic Email</a></li>
                      <li class="ps-0"><a href="{{route('email-header')}}">Basic With Header</a></li>
                      <li class="ps-0"><a href="{{route('template-email')}}">Ecomerce Template</a></li>
                      <li class="ps-0"><a href="{{route('template-email-2')}}">Email Template 2</a></li>
                      <li class="ps-0"><a href="{{route('ecommerce-templates')}}">Ecommerce Email</a></li>
                      <li class="ps-0"><a href="{{route('email-order-success')}}">Order Success</a></li>
                    </ul>
                  </div>
                </div>
                <div class="col mega-box">
                  <div class="link-section">
                    <div>
                      <h6>Coming Soon</h6>
                    </div>
                    <ul class="svg-icon">
                      <li><a href="{{route('comingsoon')}}"> <i data-feather="file"> </i>Coming-soon</a></li>
                      <li><a href="{{route('comingsoon-bg-video')}}"> <i data-feather="film"> </i>Coming-video</a></li>
                      <li><a href="{{route('comingsoon-bg-img')}}"><i data-feather="image"> </i>Coming-Image</a></li>
                    </ul>
                    <div>
                      <h6>Other Soon</h6>
                    </div>
                    <ul class="svg-icon">
                      <li><a class="txt-secondary" href="{{route('sample-page')}}"> <i data-feather="airplay"></i>Sample Page</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </li>
        <li class="level-menu outside">
          <a class="nav-link" href="#!"><i data-feather="inbox"></i><span>Level Menu</span></a>
          <ul class="header-level-menu menu-to-be-close">
           <li>
              <a href="{{ route('file-manager') }}" data-original-title="" title=""> <i data-feather="git-pull-request"></i><span>File manager </span></a>
            </li>
            <li>
              <a href="#!" data-original-title="" title=""> <i data-feather="users"></i><span>Users</span></a>
              <ul class="header-level-sub-menu">
                <li>
                  <a href="{{route('user-profile')}}" data-original-title="" title=""> <i data-feather="user"></i><span>User Profile</span></a>
                </li>
                <li>
                  <a href="{{route('edit-profile')}}" data-original-title="" title=""> <i data-feather="user-minus"></i><span>User Edit</span></a>
                </li>
                <li>
                  <a href="{{route('user-cards')}}" data-original-title="" title=""> <i data-feather="user-check"></i><span>Users Cards</span></a>
                </li>
              </ul>
            </li>
            <li>
              <a href="{{ route('kanban') }}" data-original-title="" title=""> <i data-feather="airplay"></i><span>Kanban Board</span></a>
            </li>
            <li>
              <a href="{{ route('bookmark') }}" data-original-title="" title=""> <i data-feather="heart"></i><span>Bookmark</span></a>
            </li>
            <li>
              <a href="{{ route('social-app') }}" data-original-title="" title=""> <i data-feather="zap"></i><span>Social App </span></a>
            </li>
          </ul>
        </li>
      </ul> --}}
    </div>

    <div class="nav-right col-8 pull-right right-header col-sm-12 col-xs-12 p-0">
      <ul class="nav-menus">
        {{-- <li class="language-nav">
          <div class="translate_wrapper">
            <div class="current_lang">
              <div class="lang"><i class="flag-icon flag-icon-{{ (App::getLocale() == 'en') ? 'us' : App::getLocale() }}"></i><span class="lang-txt">{{ App::getLocale() }} </span></div>
            </div>
            <div class="more_lang">
              <a href="{{ route('lang', 'en' )}}" class="{{ (App::getLocale()  == 'en') ? 'active' : ''}}">
                <div class="lang {{ (App::getLocale()  == 'en') ? 'selected' : ''}}" data-value="en"><i class="flag-icon flag-icon-us"></i> <span class="lang-txt">English</span><span> (US)</span></div>
              </a>
              <a href="{{ route('lang' , 'de' )}}" class="{{ (App::getLocale()  == 'de') ? 'active' : ''}} ">
                <div class="lang {{ (App::getLocale()  == 'de') ? 'selected' : ''}}" data-value="de"><i class="flag-icon flag-icon-de"></i> <span class="lang-txt">Deutsch</span></div>
              </a>
              <a href="{{ route('lang' , 'es' )}}" class="{{ (App::getLocale()  == 'en') ? 'active' : ''}}">
                <div class="lang {{ (App::getLocale()  == 'es') ? 'selected' : ''}}" data-value="es"><i class="flag-icon flag-icon-es"></i> <span class="lang-txt">Español</span></div>
              </a>
              <a href="{{ route('lang' , 'fr' )}}" class="{{ (App::getLocale()  == 'fr') ? 'active' : ''}}">
                <div class="lang {{ (App::getLocale()  == 'fr') ? 'selected' : ''}}" data-value="fr"><i class="flag-icon flag-icon-fr"></i> <span class="lang-txt">Français</span></div>
              </a>
              <a href="{{ route('lang' , 'pt' )}}" class="{{ (App::getLocale()  == 'pt') ? 'active' : ''}}">
                <div class="lang {{ (App::getLocale()  == 'pt') ? 'selected' : ''}}" data-value="pt"><i class="flag-icon flag-icon-pt"></i> <span class="lang-txt">Português</span><span> (BR)</span></div>
              </a>
              <a href="{{ route('lang' , 'cn' )}}" class="{{ (App::getLocale()  == 'cn') ? 'active' : ''}}">
                <div class="lang {{ (App::getLocale()  == 'cn') ? 'selected' : ''}}" data-value="cn"><i class="flag-icon flag-icon-cn"></i> <span class="lang-txt">简体中文</span></div>
              </a>
              <a href="{{ route('lang' , 'ae' )}}" class="{{ (App::getLocale()  == 'ae') ? 'active' : ''}}">
                <div class="lang {{ (App::getLocale()  == 'ae') ? 'selected' : ''}}" data-value="en"><i class="flag-icon flag-icon-ae"></i> <span class="lang-txt">لعربية</span> <span> (ae)</span></div>
              </a>
            </div>
          </div>
        </li> --}}

        {{-- <li><span class="header-search"><i data-feather="search"></i></span></li> --}}

        {{-- <li class="onhover-dropdown">
          <div class="notification-box"><i data-feather="bell"> </i><span class="badge rounded-pill badge-secondary">4                                </span></div>
          <ul class="notification-dropdown onhover-show-div">
            <li>
              <i data-feather="bell"></i>
              <h6 class="f-18 mb-0">Notitications</h6>
            </li>
            <li>
              <p><i class="fa fa-circle-o me-3 font-primary"> </i>Delivery processing <span class="pull-right">10 min.</span></p>
            </li>
            <li>
              <p><i class="fa fa-circle-o me-3 font-success"></i>Order Complete<span class="pull-right">1 hr</span></p>
            </li>
            <li>
              <p><i class="fa fa-circle-o me-3 font-info"></i>Tickets Generated<span class="pull-right">3 hr</span></p>
            </li>
            <li>
              <p><i class="fa fa-circle-o me-3 font-danger"></i>Delivery Complete<span class="pull-right">6 hr</span></p>
            </li>
            <li><a class="btn btn-primary" href="#">Check all notification</a></li>
          </ul>
        </li> --}}

        <li>
          <div class="mode"><i class="fa fa-moon-o" id="modeTheme"></i></div>
        </li>

        <li class="maximize"><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
        
        {{-- <li class="profile-nav onhover-dropdown p-0 me-0">
          <div class="media profile-media">
            <img class="b-r-10" src="{{asset('assets/images/dashboard/profile.jpg')}}" alt="">
            <div class="media-body">
              <span>Emay Walter</span>
              <p class="mb-0 font-roboto">Admin <i class="middle fa fa-angle-down"></i></p>
            </div>
          </div>
          <ul class="profile-dropdown onhover-show-div">
            <li><a href="#"><i data-feather="user"></i><span>Account </span></a></li>
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i data-feather="log-out"> </i><span>{{ __('Logout') }}</span> 
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
          </ul>
        </li> --}}
        @include('layouts.simple.profile')

        
      </ul>
    </div>
    <script class="result-template" type="text/x-handlebars-template">
      <div class="ProfileCard u-cf">                        
      <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
      <div class="ProfileCard-details">
      <div class="ProfileCard-realName">@{{name}}</div>
      </div>
      </div>
    </script>
    <script class="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
  </div>
</div>
