<li class="profile-nav onhover-dropdown p-0 me-0">
    <div class="media profile-media">
        <img class="b-r-10" width="37px" src="{{ ShowFile(RenderJson(Auth::user()->profile, "photo"), 'uploads/avatar/', 
        'image', Auth::user()->name) }}" alt="">
        <div class="media-body"><span>{{ Auth::user()->name }}
            <p class="mb-0 font-roboto">{{ Auth::user()->email }} <i class="middle fa fa-angle-down"></i></p>
        </div>
    </div>
    <ul class="profile-dropdown onhover-show-div">
        <li><a href="{{ route('user.account', Auth::user()->username) }}"><i data-feather="user"></i><span>Account </span></a></li>
        <li>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i data-feather="log-out"> </i><span>{{ __('Logout') }}</span> 
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</li>
