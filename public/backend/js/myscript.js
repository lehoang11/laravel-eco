
  $(document).ready(function(){
    $("#addImages").click(function() {
      $("#insert").append('<div class="field "><label>Add Image</label><input type="file" name="files[]"></div>');
    });
  });
$(document).ready(function(){
  $("a#img_detail").on('click',function(){
  var url ="http://localhost:55/ecommerce/admin123s5/products/detail/";

  var _token =$("form[name='formproduct']").find("input[name='_token']").val();
  var idFILE=$(this).parent().find("img").attr("idFILE");
  var img =$(this).parent().find("img").attr("src");
  var rid =$(this).parent().find("img").attr("id");
  $.ajax({
       url:url+idFILE,
       type:'GET',
       cache:false,
       data:{"_token":_token,"idFILE":idFILE,"urlHinh":img},
       success:function(data) {
        if(data=="Oke") {
          $("#"+rid).remove();
        }else {
          alert(error);
        }
        window.location =""
       }

  });
  
  })
});
