<!doctype html>
<html lang="en-us">

<head>
<link rel="shortcut icon" href="{{url('/public/ecommerce/images/ico/favicon.ico')}}">
 <link rel="stylesheet" type="text/css" href="{{url('/public/ecommerce/css/bootstrap.min.css')}}">  
 <link rel="stylesheet" type="text/css" href=""> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

  <link rel="stylesheet" type="text/css" href="{{url('/public/ecommerce/css/font-awesome.min.css')}}"> 

 <link rel="stylesheet" type="text/css" href="{{url('/public/ecommerce/css/prettyPhoto.css')}}">  
 <link rel="stylesheet" type="text/css" href="{{url('/public/ecommerce/css/price-range.css')}}"> 
 <link rel="stylesheet" type="text/css" href="{{url('/public/ecommerce/css/animate.css')}}"> 
 <link rel="stylesheet" type="text/css" href="{{url('/public/ecommerce/css/main.css')}}"> 
<link rel="stylesheet" type="text/css" href="{{url('/public/ecommerce/css/responsive.css')}}"> 


</head>

        <body class="">
            <div class="bg-dark dk" id="wrap">

<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>

<!--++++++++++++++++top+++++++++++++++++++-->
<!--++-->     <div id="top">        <!--++-->
<!--+++++                            +++++-->
     @include('ecommerce.block.navbar')             
<!--+++++                           ++++++-->
<!--++-->     </div>                <!--++-->
<!--++++++++++++++++/top++++++++++++++++++-->
  


<!--+++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<!--++++++++++++++++/#start blockcontent+++++++++++++++ -->
<!--++-->     <div id="content" class="container">                  <!--++-->
<!--++-->                  <!--++-->
<!--++-->     <div class="inner bg-light lter">   <!--++-->
<!--++-->    @yield('content')                     <!--++-->            @include('ecommerce.block.message')   
         
<!--++-->                              <!--++-->
<!--++-->          </div>                         <!--++-->
<!--++-->       </div>                            <!--++-->
<!--+++++++++++++++++++/ block content+++++++++++++++++ -->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++ -->
              

                 
    </div>
    <!-- /#wrap -->
<!--+++++++++++++++++++++++footer++++++++++++++++++++-->
<!--++--><footer class="Footer bg-dark dker">  <!--++-->
<!--++-->                                      <!--++--> 
            @include('ecommerce.block.footer')  
<!--++-->                                      <!--++--> 
<!--++-->              </footer>               <!--++-->
<!--++++++++++++++++++++++footer+++++++++++++++++++++-->


<script src="{{url('/public/ecommerce/js/jquery.js')}}">	
</script>
<script src="{{url('/public/ecommerce/js/bootstrap.min.js')}}">  
</script>
<script src="{{url('/public/ecommerce/js/jquery.scrollUp.min.js')}}">  
</script>
<script src="{{url('/public/ecommerce/js/price-range.js')}}">  
</script>
<script src="{{url('/public/ecommerce/js/jquery.prettyPhoto.js')}}">  
</script>
<script src="{{url('/public/ecommerce/js/main.js')}}">  
</script>
</body>
</html>
