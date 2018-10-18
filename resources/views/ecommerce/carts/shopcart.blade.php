@extends('ecommerce.layouts.master')


@section('content')
<section>
<div class="container">

  <ul class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i></a></li>
        <li><a href="#">Shopping Cart</a></li>
      </ul>
        <div class="row">                <div  class="col-sm-12">      <h1>Shopping Cart                &nbsp;
              </h1>
      <form action="{{ route('shopcart') }}" method="post" enctype="multipart/form-data">
       {{ csrf_field() }}
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
              
     <a href="#"><img src="{!!asset('storage/app/'.$item->options['img'])!!}" width="47" height="47" class="img-thumbnail" /></a>
                  </td>
                <td class="text-left"><a href="#">{!!$item->name!!}</a>
                                                                        </td>
              
                <td class="text-left"><div class="input-group btn-block" style="max-width: 200px;">
                    <input class="qty form-control" type="text" name="qty" value="{!!$item->qty!!}" size="1"  />
                    <span class="input-group-btn">
                    <a class="updatecart btn btn-success" id="{!!$item->rowId!!}"  href="#" data-toggle="tooltip"> <i class="fa fa-refresh"></i></a>
   
     <a class="btn btn-danger" data-toggle="tooltip" 
     href="{{ route('deletecart', ['id' => $item->rowId]) }}" type="button"> <i class="fa fa-times-circle"></i></a>
                 
                    </span></div></td>
                <td class="text-right"> 
                ${{ sprintf('%.2f',$item->price)}}  </td>
                <td class="text-right">
                 ${{ sprintf('%.2f',$item->price * $item->qty )}}</td>
              </tr>
              @endforeach
                                        </tbody>
          </table>
        </div>
      </form>
<script type="text/javascript">
  $(document).ready(function(){
    $(".updatecart").click(function() {
      var rowid =$(this).attr('id');
      var qty =$(this).parent().parent().find(".qty").val();
      var token = $("input[name='_token']").val();
      $.ajax({
             url:'updatecart/'+rowid+'/'+qty,
             type:'GET',
             cache:false,
             data:{"_token":token,"id":rowid,"qty":qty},
             success:function(data){
             	if(data=="oke"){
             		window.location =""
             	}
             }
      });
    });
  });    	
</script>
      <div class="row">
        <div class="col-sm-4 col-sm-offset-8">
          <table class="table table-bordered">
       
                        <tr>
              <td class="text-right"><strong>Total:</strong></td>
              <td class="text-right">${{ sprintf('%.2f',$total)}}</td>
            </tr>
                      </table>
        </div>
      </div>
            <h2>What would you like to do next?</h2>
   
    
      
      <div class="buttons clearfix">
        <div class="pull-left"><a href="{{url('/')}}" class="btn btn-default">Continue Shopping</a></div>
        <div class="pull-right"><a href="{{route('checkaddress')}}" class="btn btn-primary">Checkout Address</a></div>
      </div>
      <br><br>
      </div>
    </div>
</div>
</section>

@endsection