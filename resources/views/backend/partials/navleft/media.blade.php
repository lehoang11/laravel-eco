
    <div class="media user-media bg-dark dker">
        <div class="user-media-toggleHover">
            <span class="fa fa-user"></span>
        </div>
        <div class="user-wrapper bg-dark">
            <a class="user-link" href="">
                <img class="media-object img-thumbnail user-img" alt="User Picture" src="{{ url('/')}}/public/backend/img/user.gif">
                <span class="label label-danger user-label">16</span>
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
  @if(Backend::loggedInUser()->hasPermission('backend.files.access'))
              <li class="">
                <a href="javascript:;">
                  <i class="fa fa-building "></i>
                  <span class="link-title">File Manager</span>
                  <span class="fa arrow"></span>
                </a>
                <ul class="collapse">
            
                  <li>
                    <a href="{{ route('backend::files') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; File-Document </a>
                  </li>
            
      @if(Backend::loggedInUser()->hasPermission('backend.files.upload'))       
                  <li>
                    <a href="{{ route('backend::files_upload') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; UploadFile </a>
                  </li>
            @endif
                </ul>
              </li>
    @endif

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
