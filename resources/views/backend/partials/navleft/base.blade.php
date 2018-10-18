
    <div class="media user-media bg-dark dker">
        <div class="user-media-toggleHover">
            <span class="fa fa-user"></span>
        </div>
        <div class="user-wrapper bg-dark">
            <a class="user-link" href="#">
                <img class="media-object img-thumbnail user-img" alt="User Picture" src="{{ url('/')}}/public/backend/img/user.gif">
               
            </a>
    
            <div class="media-body">
                <h5 class="media-heading">{{ Auth::user()->name }}</h5>
                <ul class="list-unstyled user-info">
                    <li><a href="">Administrator</a></li>
                  
                </ul>
            </div>
        </div>
    </div>
    <!-- #menu -->
    <ul id="menu" class="bg-blue dker">
              <li class="nav-header">Menu</li>
              <li class="nav-divider"></li>
              <li class="">
                <a href="{{ route('backend::dashboard') }}">
                  <i class="fa fa-dashboard"></i><span class="link-title">&nbsp;Dashboard</span>
                </a>
              </li>
              
        
              <li class="nav-divider"></li>
            <li>
                                    <a href="{{ url('/logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>

            </ul>
    <!-- /#menu -->
