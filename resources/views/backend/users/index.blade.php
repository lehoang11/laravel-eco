@extends('backend.layouts.setting')

@section('mainbar')
<i class="fa fa-user" aria-hidden="true"></i>
&nbsp; Users
@endsection

@section('content')

                            <!--Begin Datatables-->
<div class="row">
  <div class="col-lg-12">
        <div class="box">
            <header>
            
                <div class="icons"><i class="fa fa-edit"></i></div>
               <h5> <a href="#" ><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;New Adminnistrator </a></h5>
            </header>

          
  <div id="collapse4" class="body">
          <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
              <thead>
               
	    <tr>
            <th>name</th>
            <th>email</th>
            <th>country</th>
            <th>options</th>
  </tr>
      </thead>
      <tbody>
    
          @foreach($users as $user)
		<tr>
			<td>
                    
                           <img class="media-object img-thumbnail user-img" alt="User Picture" src="{{ url('/')}}/public/backend/img/user.gif">
                          <a href="{{ route('backend::users_profile', ['id' => $user->id]) }}">{{ $user->name }}</a>
                          @if($user->su)
                            <p> super_user</p>
                            
                          @elseif(Backend::isAdmin($user))
                            <p>admin_access</p>
                          @endif
                     
          </td>
			<td>
                  @if($user->banned)
                      users_status_banned/
                  @elseif(!$user->active)
                      users_status_unactive/
                  @else
      <i data-position="top center" data-content="Everything Good" class="pop green checkmark icon"></i>
                      users_status_ok/
                  @endif
                  {{ $user->email }}
              </td>
			<td>vn</td>
          <td >
                @if(!Backend::isAdmin($user) or Backend::loggedInUser()->su)
           
                  <i class="configure icon"></i>
                editing_options
                        <a href="{{ route('backend::users_edit', ['id' => $user->id]) }}">
                          <i class="edit icon"></i>
                          users_edit ||
                        </a>
                        <a href="{{ route('backend::users_roles', ['id' => $user->id]) }}">
                          <i class="star icon"></i>
                         users_edit_roles
                        </a>
                        @if($user->id != Backend::loggedInUser()->id)
                        <hr>
                        <a href="{{ route('backend::users_delete', ['id' => $user->id]) }}" >
                          <i class="trash bin icon"></i>
                          users_delete
                        </a>
                        @endif
                  
                @else
               
                      <i class="lock icon"></i>
                  
                @endif
			</td>
		</tr>
	@endforeach
              </tbody>                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->
<!--End Datatables-->
@endsection
