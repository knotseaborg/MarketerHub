<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">MarketerHub</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <!--<li class="{{ Request::url() == url('/') ? 'active' : ''}}"><a href="{{ url('/') }}">Home</a></li>-->
        <li class="{{ Request::url() == route('profile.dashboard') ? 'active' : ''}}"><a href="{{ route('profile.dashboard') }}">Home</a></li>
        <li class="{{ Request::url() == url('/explore') ? 'active' : ''}}"><a href="{{ route('explore.search') }}">Explore</a></li>
        <li class="{{ Request::url() == route('project.index') ? 'active' : ''}}"><a href="{{ route('project.index') }}">Projects</a></li>
         <li class="{{ Request::url() ==  route('invite.received')? 'active' : ''}}"><a href="{{ route('invite.received') }}">Invitations</a></li>
         <li class="{{Request::url() == url('setting') ? 'active' : ''}}">
                    <a href="{{url('setting')}}">Settings</a></li>
        <!--
        <li class="{{ Request::url() == url('/blog') ? 'active' : ''}}"><a href="{{ url('blog') }}">Followers</a></li>
        <li class="{{ Request::url() == url('/blog') ? 'active' : ''}}"><a href="{{ url('blog') }}">Following</a></li>
        -->
      </ul>
      <!-- Right Side Of Navbar -->
      <ul class="nav navbar-nav navbar-right">
          <!-- Authentication Links -->
          @if (Auth::guest())
              <li><a href="{{ route('login') }}">Login</a></li>
              <li><a href="{{ route('register') }}">Register</a></li>
          @else
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                      {{ Auth::user()->name }} <span class="caret"></span>
                  </a>

                  <ul class="dropdown-menu" role="menu">
                      <li>
                          <a href="{{ url('profile/dashboard') }}">
                             Profile
                          </a>
                          <a href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                              Logout
                          </a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              {{ csrf_field() }}
                          </form>
                      </li>
                  </ul>
              </li>
          @endif
      </ul>
      <!-- Dropdown
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">DropDown<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>
      -->
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
   @include('partials._message')
</nav>
