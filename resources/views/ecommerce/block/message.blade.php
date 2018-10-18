@if(session('success'))

     <div class="alert alert-success alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Success!</strong> {!! session('success') !!}
  </div>
    @endif
    @if(session('error'))
        <script>
            swal({
                title: "Whops!",
                text: "{!! session('error') !!}",
                type: "error",
                confirmButtonText: "Okai"
            });
        </script>
    @endif
    @if(session('warning'))

  <div class="alert alert-warning alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Warning!</strong> {!! session('warning') !!}
  </div>
    @endif
    @if(session('info'))
 
  <div class="alert alert-info alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Info!</strong>{!! session('info') !!}.
  </div>
    @endif
    @if (count($errors) > 0)
  
 <div class="alert alert-danger alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Danger!</strong><?php foreach($errors->all() as $error){ echo "$error<br>"; } ?>
  </div>
    @endif


 
