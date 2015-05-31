@section('title', trans('admin.viewing_users'))

@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="page-header">
				<h1>{{ trans('admin.showing_all_users') }} ({{ $users->getTotal() }})</h1>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<table class="table">
			   	<thead>
			    	<tr>
				     	<th>{{ trans('admin.avatar') }}</th>
						<th>{{ trans('admin.username') }}</th>
						<th>{{ trans('admin.email') }}</th>
						<th>{{ trans('admin.companyphone') }}</th>
						<th>{{ trans('admin.tricks') }}</th>
						<th>{{ trans('admin.date_registered') }}</th>
						<th>{{ trans('admin.companyStatus') }}</th>
						<th>{{ trans('admin.edit') }}</th>
			    	</tr>
			   	</thead>
			   	<tbody>
			   		
				  	@foreach($users as $user)
				   {{ Form::open(array('class'=>'form-vertical','url'=>'admin/users/list','role'=>'form','method'=>'post'))}}
				     <tr>
				    	<td><img src="{{ $user->photocss }}" class="img-rounded" style="width:40px; height:40px;"></td>
				        <td><a href="company/{{  $user->username }}" target="_blank">{{$user->companyname}}</a></td>
				       	<td>{{$user->email}}</td>
				       	<td>
 {{ Form::hidden('userid',$user->id) }}
 {{ Form::hidden('emailcompany',$user->email) }}
				       		{{$user->phonenumber}}</td>
				       	<td><a href="{{url($user->username)}}" target="_blank">{{count($user->tricks)}}</a></td>
				       	<td> {{ date("d-m-Y", strtotime($user->created_at))}}</td>
				       	<td>
				@if($user->active_account==1)
                فعال : {{ Form::radio('active_account',1,true)."  " }} 
                غير فعال: {{ Form::radio('active_account',0)."  " }} 
                 

                 @else
                  فعال : {{ Form::radio('active_account',1)."  " }} 
                غير فعال : {{ Form::radio('active_account',0,true)."  " }} 
                
                 
                 @endif


                 </td>
                 <td>

 <div class="text-right">
					          <button type="submit"  id="save-section" class="btn btn-primary ladda-button" data-style="expand-right">
					            {{ trans('admin.edit') }}
					          </button>
					        </div>
                 </td>
				     </tr>
				     {{Form::close()}}
				    @endforeach

			    </tbody>
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="text-center">{{ $users->links(); }}</div>
		</div>
	</div>
</div>
@stop
