@extends('backend.layouts.setting')

@section('mainbar')
{{ trans('backend.backend_API') }}
@endsection


@section('content')
<div class="row">
  <div class="col-lg-12">
        <div class="box">
            <header>
           
               <h5> <a href="#" >&nbsp; {{ trans('backend.API_subtitle') }}
 </a></h5>

            </header>

     <div id="collapse4" class="body">
          <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
          <thead> 
            <tr>
                  <th>{{ trans('backend.API_url') }}</th>
                  <th>{{ trans('backend.API_show') }}</th>
            </tr>
          </thead>
          <tbody>
                <?php
              $api = Backend::apiData();
          ?>
                @foreach($api as $a => $data)
                <tr>
                <td>
                            @if($data['enabled'])
                                <i class="fa fa-check" aria-hidden="true"></i>
                            @else
                            <i class="fa fa-times-circle" aria-hidden="true"></i>
                            @endif
                            <a href="{{ route('API::show', ['table' => $a]) }}">/{{ $a }}/{accessor?}/{data?}</a>
                        </td>
                        <td>
                            @foreach($data['show'] as $d)
                              <div class="btn btn-default">{{ $d }}</div>
                            @endforeach
                        </td>
          </tr>
                    <tr>
                <td>
                            @if($data['enabled'])
                            <i class="fa fa-check" aria-hidden="true"></i>
                            @else
                                  <i class="fa fa-times-circle" aria-hidden="true"></i>
                            @endif
                            <a href="{{ route('API::show', ['table' => $a, 'accessor' => 'latest']) }}">/{{ $a }}/latest</a>
                        </td>
                        <td>
                            @foreach($data['show'] as $d)
                          
                              <div class="btn btn-default ">{{ $d }}</div>
                            @endforeach
                        </td>
          </tr>
                    <tr>
                <td>
                            @if($data['enabled'])
                                <i class="fa fa-check" aria-hidden="true"></i>
                            @else
                                 <i class="fa fa-times-circle" aria-hidden="true"></i>
                            @endif
                            <a href="{{ route('API::show', ['table' => $a, 'accessor' => 'latests']) }}">/{{ $a }}/latests/{number?}</a>
                        </td>
                        <td>
                            @foreach($data['show'] as $d)
                                
                                  <div class="btn btn-default ">{{ $d }}</div>
                            @endforeach
                        </td>
          </tr>
        @endforeach
          </tbody>
        </table>
        </div>
        </div>
  </div>
</div>


@endsection
