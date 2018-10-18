
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
@if(Backend::loggedInUser()->hasPermission('backend.users.access'))
              <li class="">
                <a href="javascript:;">
                  <i class="fa fa-building "></i>
                  <span class="link-title">User manager</span>
                  <span class="fa arrow"></span>
                </a>
                <ul class="collapse">
            
                  <li>
                    <a href="{{ route('backend::users') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; User List </a>
                  </li>
            
      @if(Backend::loggedInUser()->hasPermission('backend.users.create'))       
                  <li>
                  <a href="{{ route('backend::users_create') }}">
                      <i class="fa fa-angle-right"></i>&nbsp;  Create User  </a>
                  </li>
            @endif
      @if(Backend::loggedInUser()->hasPermission('backend.users.settings'))
                  <li>
                    <a href="{{ route('backend::users_settings') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; User Setting </a>
                  </li>
            @endif
                </ul>
              </li>
      @endif
  @if(Backend::loggedInUser()->hasPermission('backend.roles.access'))
              <li class="">
                <a href="javascript:;">
                  <i class="fa fa-building "></i>
                  <span class="link-title">Role Manager</span>
                  <span class="fa arrow"></span>
                </a>
                <ul class="collapse">
            
                  <li>
                    <a href="{{ route('backend::roles') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; Role List </a>
                  </li>
            
        @if(Backend::loggedInUser()->hasPermission('backend.roles.create'))     
                  <li>
                    <a href="{{ route('backend::roles_create') }}">
                      <i class="fa fa-angle-right"></i>&nbsp;  Create Role  </a>
                  </li>
          @endif     
                </ul>
              </li>
    @endif

      @if(Backend::loggedInUser()->hasPermission('backend.permissions.access'))        
              <li class="">
                <a href="javascript:;">
                  <i class="fa fa-building "></i>
                  <span class="link-title">Permission Manager</span>
                  <span class="fa arrow"></span>
                </a>
                <ul class="collapse">
            
                  <li>
                    <a href="{{ route('backend::permissions') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; Permission List </a>
                  </li>
      @if(Backend::loggedInUser()->hasPermission('backend.permissions.create'))      
             
                  <li>
                    <a href="{{ route('backend::permissions_create') }}">
                      <i class="fa fa-angle-right"></i>&nbsp;  Create Permission  </a>
                  </li>
          @endif     
                </ul>
              </li>
    @endif   

     

      
              <li class="">
                <a href="javascript:;">
                  <i class="fa fa-building "></i>
                  <span class="link-title">{{ trans('backend.developer_tools') }}</span>
                  <span class="fa arrow"></span>
                </a>
                <ul class="collapse">
         @if(Backend::loggedInUser()->hasPermission('backend.CRUD.access'))    
                  <li>
                    <a href="{{ route('backend::CRUD') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; {{ trans('backend.database_CRUD') }}</a>
                  </li>
                  @endif
        
                  <li>
                    <a href="{{ route('backend::API') }}">
                      <i class="fa fa-angle-right"></i>&nbsp;  Backend API  </a>
                  </li>
           
                </ul>
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





