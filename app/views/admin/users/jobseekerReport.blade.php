@section('title', trans('admin.viewing_users'))

@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="page-header">
				<h1>{{ trans('admin.job_seeker') }}</h1>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<table class="table">
			   	<thead>
			    	<tr>
				     	<th>{{ trans('admin.engavatar') }}</th>
						<th>{{ trans('admin.engname') }}</th>
						<th>{{ trans('admin.engkey') }}</th>
						<th>{{ trans('admin.email') }}</th>
						<th>{{ trans('admin.companyphone') }}</th>
						<th>{{ trans('admin.sex') }}</th>
						<th>{{ trans('admin.engage') }}</th>
						<th>{{ trans('admin.engcv') }}</th>
			    	</tr>
			   	</thead>
			   	<tbody>
			   		
				  	@foreach($users as $user)
				    <form name="myform" id="myform">
				     <tr>
				    	<td><img src="#" class="img-rounded" style="width:40px; height:40px;"></td>
				        <td>{{$user->companyname}}</td>
				       	<td>{{$user->username}}</td>
				       	<td>{{$user->email}}</td>
				       	<td>{{$user->phonenumber}}</td>
				       	<td>{{$user->GENDER}}</td>
				       	<td> 
 
				       		{{ date_diff(date_create($user->eng_birthdate), date_create('today'))->y}}</td>
				       	<td> @if (file_exists(public_path('img/CV/CV_'.$user->id)))
				       		 <a href="{{ URL::to('img/CV/'."CV_".$user->id)}}" target="_blank" class="btn btn-primary">مشاهدة السيرة الذاتية </a>
				       	    @else
                              السيرة الذاتية غير مرفقة
				       	    @endif </td>
				     </tr></form>
				    @endforeach

			    </tbody>
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="text-center"> </div>
		</div>
	</div>
</div>
@stop
