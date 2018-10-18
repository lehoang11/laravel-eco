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
 @include('backend.partials.navleft.base') 
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
              
<!--+++++++++++++++++++++++++right+++++++++++++++++++-->
<!--++--><div id="right" class="bg-light lter"><!--++-->
<!--++-->                                      <!--++--> 
    @include('backend.partials.navright.navright')
<!--++-->                                      <!--++--> 
<!--++-->              </div>                  <!--++-->
<!--+++++++++++++++++++++++right+++++++++++++++++++++-->
                 
    </div>
    <!-- /#wrap -->
<!--+++++++++++++++++++++++footer++++++++++++++++++++-->
<!--++--><footer class="Footer bg-dark dker">  <!--++-->
<!--++-->                                      <!--++--> 
       @include('backend.partials.block.footer')  
<!--++-->                                      <!--++--> 
<!--++-->              </footer>               <!--++-->
<!--++++++++++++++++++++++footer+++++++++++++++++++++-->


    <!-- #helpModal -->
    <div id="helpModal" class="modal fade">

        
    </div>
 <!-- /.modal-dialog -->
    <!--appjs -->
 @include('backend.partials.block.appjs') 
    <!--appjs -->
           
</body>
</html>
