@extends('ecommerce.layouts.master')


@section('content')
<section>
<div class="container">

  <ul class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i></a></li>
        <li><a href="#">Shopping Cart</a></li>
      </ul>
        <div class="row">               
         <div  class="col-sm-12">    
           <h1>Shopping Cart                &nbsp;
              </h1>
    
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <td class="text-center">Image</td>
                <td class="text-left">Product Name</td>
               
                <td class="text-left">Quantity</td>
                <td class="text-right">Unit Price</td>
                <td class="text-right">Total</td>
              </tr>
            </thead>
            <tbody>
            @foreach($content as $item)
                            <tr>
                <td class="text-center">  
              
     <a href="#"><img src="{!!asset('storage/app/'.$item->options['img'])!!}" width="47" height="47" alt="iPhone" title="iPhone" class="img-thumbnail" /></a>
                  </td>
                <td class="text-left"><a href="#">{!!$item->name!!}</a>
         </td>
                <td class="text-left">
                <span>{!!$item->qty!!}</span>
                 </td>
                <td class="text-right"> 
                ${{ sprintf('%.2f',$item->price)}}  </td>
                <td class="text-right">
                 ${{ sprintf('%.2f',$item->price * $item->qty )}}</td>
              </tr>
              @endforeach
                                        </tbody>
          </table>
        </div>
   



      <div class="row">
        <div class="col-sm-4 col-sm-offset-8">
          <table class="table table-bordered">
       
                        <tr>
              <td class="text-right"><strong>Total:</strong></td>
              <td class="text-right">${{ sprintf('%.2f',$total)}}</td>
            </tr>
                      </table>
        </div>
        <h2>What would you like to do next?</h2>
      </div>
            
    
    
 </div></div>

  <form action="{{url('/checkaddress')}}" method="POST">
                  {{ csrf_field() }}
<div class="row">
  <div class="col-sm-6 box">
 
          
     
                  <div class="form-group">
                  <label class="control-label">Email<i class="fa fa-star" aria-hidden="true" style="color: red;"></i> </label>
                  <div class="">
                  <input required  type="text" name="email" value="" class="form-control">             
                  </div>
                  </div>
                  <hr>
                  <div class="form-group">
                  <label class="control-label">First Name</label>

                  <input type="text" name="firstname" value="" class="form-control">             
                  </div>

                  <div class="form-group">
                  <label class="control-label">Last Name</label>

                  <input  type="text" name="lastname" value="" class="form-control">             

                  </div>
                 
                 

                 
                    <!-- /.row -->
  </div>
   <div class="col-sm-6 box">
    <div class="form-group">
                  <label class="control-label">Phone</label>

                  <input  type="text" name="phone" value="" class="form-control">             

                  </div>
                  <hr>
                  <div class="form-group">
                  <label class="control-label">Address</label>

                  <input  type="text" name="address" value="" class="form-control">             

                  </div>
                  <div class="form-group">
                  <label class="control-label">Message</label>
                  <textarea name="message" class="form-control" row =3></textarea>       


                  </div>
                  <div class="form-group">
                    <center>
                    <button type="submit" class="button btn btn-success">continue</button>
                    </center>
                  
                    </div> 
                    <!-- /.row -->

   </div>
</div>

</form>

<div style="padding:30px 0; "></div>

 </div></section>  


@endsection