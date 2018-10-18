@extends('backend.layouts.media')

@section('mainbar')

<i class="fa fa-file-o" aria-hidden="true"></i>
&nbsp; Media
@endsection

@section('content')

  <div class="row">
    <div class="col-lg-12">
      <div class="box">
        <header>
          <div class="icons"><i class="fa fa-edit"></i></div>
            <h5> <a href="#" ><i class="fa fa-file-o" aria-hidden="true"></i>
&nbsp; Media 
            </a></h5>
        </header>
      </div>
    </div>
  </div>


      
            @if(count($files) == 0)
            <div class="row">
                <div class="col-lg-12">
                    <i class="frown icon"></i>
                    <div class="body">
                        <div class="header">
                            {{ trans('backend.missing_title') }}
                        </div>
                        <p>{{ trans('backend.missing_subtitle', ['element'  =>  "files"]) }}</p>
                    </div>
                </div>
            </div>
            @else
        <div class="row">
            @foreach($files as $file)
                <div class="col-lg-3">
                <div class="box">
                    @if(backend::isDocument($file))

                        <?php $doc = Backend::document('name', $file); $slug = $doc->slug; ?>

                        <div class="ui fluid blue card">
                          <div class="body">
                            <div class="header">{{ $file }}</div>
                            <div class="meta">{{ trans('backend.documents_document') }}</div>
                          </div>
                          <div class="description">
                              <center>
                                  <a href="{{ route('backend::files_download', ['file' => $file]) }}" class="ui no-disable button download ">
                                  <i class="fa fa-download" aria-hidden="true"></i>&nbsp;
                                      {{ trans('backend.download') }}

                                  </a>
                              </center>
                          </div><br>
                          <div class="body">
                            
                            {{ $doc->downloads }}
                            
                        
                            <div class=" dropdown">
                              {{ trans('backend.options') }}
<button data-toggle="dropdown" class="dropdown-toggle no-disable" href="{{ backend::downloadLink($file) }}" aria-expanded="false">
                         {{ trans('backend.download_link') }} <b class="caret"></b>
                          </button>
                         
                          <ul class="dropdown-menu">
                             <a href="{{ route('backend::documents_edit', ['slug' => $slug]) }}" class="item">{{ trans('backend.documents_edit') }}</a>
                             <a href="{{ route('backend::documents_delete', ['slug' => $slug]) }}" class="item">{{ trans('backend.documents_delete_document') }}</a>
                        
                                <a href="{{ route('backend::files_delete', ['file' => $file]) }}" class="item">{{ trans('backend.files_delete_file') }}</a>
                           </ul>
                            </div>

                          </div>
                        </div>
                    @else
                       
                          <div class="body">
                            <div class="header">{{ $file }}</div>
                            <div class="meta">{{ trans('backend.files_file') }}</div>
                          </div>
                          <div class="description">
                              <center>
                                  <a href="{{ route('backend::files_download', ['file' => $file]) }}" class="ui no-disable button download">
                                      {{ trans('backend.download') }}
                                  </a>
                              </center>
                          </div><br>
                          <div class="body">
                       
                            <div class=" dropdown">
<button data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">
  <i class="fa fa-wrench" aria-hidden="true"></i>&nbsp;         {{ trans('backend.options') }}
                              <b class="caret"></b>
                         </button>    
                       <ul class="dropdown-menu">
                             <a href="{{ route('backend::documents_create', ['file' => $file]) }}" class="item">{{ trans('backend.files_create_document') }}</a>
                              <li class="divider"></li>
                        <div>        <a href="{{ route('backend::files_delete', ['file' => $file]) }}" class="item">{{ trans('backend.files_delete_file') }}</a></div>
                          </ul>
                        </div>
                      </div>
                       
                    @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
      
  

@endsection

<script>
    $('.no-disable.button.download').click(function(){
        swal({
			title: "{{ trans('backend.downloaded') }}",
			text: "{{ trans('backend.downloaded_desc') }}",
			type: "success",
			confirmButtonText: "{{ trans('backend.okai') }}"
		});
    });
</script>

