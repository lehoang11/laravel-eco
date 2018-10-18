<!doctype html>
<html lang="en-us">

<head>
    
 @include('backend.partials.block.head')

</head>

        <body class="">
            <div class="bg-dark dk" id="wrap">

 <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
<!--++++++++++++++++top+++++++++++++++++++-->
<!--++-->     <div id="top">        <!--++-->
<!--+++++                            +++++-->
       @include('backend.partials.block.header')             
<!--+++++                           ++++++-->
<!--++-->     </div>                <!--++-->
<!--++++++++++++++++/top++++++++++++++++++-->
  
<!--+++++++++++++++navleft+++++++++++++-->
<!--++-->   <div id="left">      <!--++-->
 @include('backend.partials.navleft.media') 
 <!--++-->  </div>               <!--++-->
<!--+++++++++++++++/navleft++++++++++++-->

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<!--++++++++++++++++/#start blockcontent+++++++++++++++ -->
<!--++-->     <div id="content">                  <!--++-->
<!--++-->     <div class="outer">                 <!--++-->
<!--++-->     <div class="inner bg-light lter">   <!--++-->
<!--++-->    @yield('content')                                  <!--++--> @include('backend.partials.block.message')   
<!--++-->             </div>                      <!--++-->
<!--++-->          </div>                         <!--++-->
<!--++-->       </div>                            <!--++-->
<!--+++++++++++++++++++/ block content+++++++++++++++++ -->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++ -->
              
                 
    </div>
    <!-- /#wrap -->
<!--+++++++++++++++++++++++footer++++++++++++++++++++-->
<!--++--><footer class="Footer bg-dark dker">  <!--++-->
<!--++-->                                      <!--++--> 
       @include('backend.partials.block.footer')  
<!--++-->                                      <!--++--> 
<!--++-->              </footer>               <!--++-->
<!--++++++++++++++++++++++footer+++++++++++++++++++++-->



    <!--appjs -->
 @include('backend.partials.block.appjs') 
    <!--appjs -->
           
</body>
</html>
