@section('title', trans('tricks.viewing_tricks'))

@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="page-header">
				<h1>{{ trans('tricks.showing_all_user_trick') }}  </h1>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<table class="table">
			   	<thead>
			    	<tr>
				     	<th>{{ trans('tricks.username') }}</th>
				     	<th>{{ trans('tricks.engkey') }}</th>
				     	<th>{{ trans('tricks.GENDER') }}</th>
						<th>{{ trans('tricks.mobile') }}</th>
						<th>{{ trans('tricks.email') }}</th>
						<th>{{ trans('tricks.birthdate') }}</th>
						<th>{{ trans('tricks.cv_user') }}</th>
						 
			    	</tr>
			   	</thead>
			   	<tbody>
			   		 
				  	@foreach($results as $result)
				    <form name="myform" id="myform">
				     <tr>
				    	<td>{{$result->companyname}}</td>
				    	<td>{{$result->username}}</td>
				    	<td>{{$result->GENDER}}</td>
				       	<td>{{$result->phonenumber}}</td>
				       	<td>{{$result->email}}</td>
				       	<td>{{ date("d-m-Y", strtotime($result->eng_birthdate))}}</td>
				       	<td>

				       		@if (file_exists(public_path('img/CV/CV_'.$result->id)))
				       		 <a href="{{ URL::to('img/CV/'."CV_".$result->id)}}" target="_blank" class="btn btn-primary">مشاهدة السيرة الذاتية </a></td>
				       	    @else
                              السيرة الذاتية غير مرفقة
				       	    @endif
				       	<td>
				 


                 </td>
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
