<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <div class="contactinfo">
              <ul class="nav nav-pills">
                <li><a href="#"><i class="fa fa-phone"></i> +2 88 88 88 888</a></li>
                <li><a href="#"><i class="fa fa-envelope"></i> cbdlamini@gmail.com </a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="social-icons pull-right">
              <ul class="nav navbar-nav">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div><!--/header_top-->
    
    <div class="header-middle"><!--header-middle-->
      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <div class="logo pull-left">
              <a href="{{url('/')}}"><img src="{{url('/public/ecommerce/images/home/logo.png')}}" alt="" /></a>
            </div>
       
          </div>
          <div class="col-sm-8">
            <div class="shop-menu pull-right">
              <ul class="nav navbar-nav">
               @if (Route::has('login'))
                @if(Auth::check())
            <li><a href="{{route('shopcart')}}"><i class="fa fa-shopping-cart"></i> Cart<span style="color:#FE980F;">
                <?php  $total = Cart::total(); 
                ?>
                @if($total) ${{ sprintf('%.2f',$total)}} @endif
                </span></a></li>

                <li> <a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a></li>
                
 @else
   <li><a href="{{route('shopcart')}}"><i class="fa fa-shopping-cart"></i> Cart<span style="color:#FE980F;">
           <?php  $total = Cart::total(); ?>
                @if($total) ${{ sprintf('%.2f',$total)}} @endif
                </span></a></li>

                <li><a href="{{ url('/login') }}"><i class="fa fa-lock"></i> Login</a></li>
                  <li><a href="{{ url('/register') }}"><i class="fa fa-user"></i> Register</a></li>
      @endif
            @endif


              </ul>
            </div>
          </div>
        </div>
      </div>
    </div><!--/header-middle-->
  
    <div class="header-bottom"><!--header-bottom-->
      <div class="container">
        <div class="row">
          <div class="col-sm-9">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
            <div class="mainmenu pull-left">
              <ul class="nav navbar-nav collapse navbar-collapse">
              

<?php 
  $menu_level_1= DB::table('cates')->where('parent_id',0)
                              ->orderBy('sort_order','DESC')->get();
  ?>
    @foreach($menu_level_1 as $item_level_1)

    <?php 
   $menu_level_2= DB::table('cates')->where('parent_id',$item_level_1->id)->get();
?>    @if(count($menu_level_2) > 0)
        <li class="dropdown"><a href="#">{!! $item_level_1->name!!}
        <i class="fa fa-angle-down"></i></a>
        @else
      <li><a href="{{ route('product_subcates', ['id' => $item_level_1->id,'alias'=>$item_level_1->alias]) }}">{!! $item_level_1->name!!}</a>
       @endif
              <ul role="menu" class="sub-menu">

@foreach($menu_level_2 as $item_level_2)                          
                    <li><a href="{{ route('product_subcates', ['id' => $item_level_2->id,'alias'=>$item_level_2->alias]) }}">{!! $item_level_2->name!!}</a></li> 
                  
    @endforeach        
  </ul>
  
 </li> 
  @endforeach


                <li><a href="{{url('/blog')}}">Blog</a></li>
               


              </ul>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="search_box pull-right">
 <form method="get" role="search" action="{{url('/product/search')}}">   
            
            <input type="text" name="search" placeholder="Search"/>
              <input type="submit" style="display:none;">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div><!--/header-bottom-->
  </header><!--/header-->


   