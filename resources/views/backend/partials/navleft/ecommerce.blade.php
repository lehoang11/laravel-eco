

    <div class="media user-media bg-dark dker">
        <div class="user-media-toggleHover">
            <span class="fa fa-user"></span>
        </div>
        <div class="user-wrapper bg-dark">
            <a class="user-link" href="#">
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
       
 @if(Backend::loggedInUser()->hasPermission('backend.cate.access'))
              <li class="">
                <a href="javascript:;">
                  <i class="fa fa-building "></i>
                  <span class="link-title">Category</span>
                  <span class="fa arrow"></span>
                </a>
                <ul class="collapse">
            
                  <li>
                    <a href="{{ route('backend::cates') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; Cate list </a>
                  </li>
          @if(Backend::loggedInUser()->hasPermission('backend.cate.create'))  
             
                  <li>
                    <a href="{{ route('backend::cates_create') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; Cate create  </a>
                  </li>
            @endif
                </ul>
              </li>
     @endif


 @if(Backend::loggedInUser()->hasPermission('backend.product.access'))
              <li class="">
                <a href="javascript:;">
                  <i class="fa fa-building "></i>
                  <span class="link-title">Product</span>
                  <span class="fa arrow"></span>
                </a>
                <ul class="collapse">
            
                  <li>
                    <a href="{{ route('backend::products') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; Product list </a>
                  </li>
          @if(Backend::loggedInUser()->hasPermission('backend.product.create'))  
             
                  <li>
                    <a href="{{ route('backend::products_create') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; Product create  </a>
                  </li>
            @endif
                </ul>
              </li>
     @endif

 @if(Backend::loggedInUser()->hasPermission('backend.order.access'))
               <li class="">
                <a href="{{ route('backend::order') }}">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="link-title">&nbsp;Order</span>
                </a>
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
