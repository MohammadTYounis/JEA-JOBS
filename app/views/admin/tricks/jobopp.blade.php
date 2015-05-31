@section('title', trans('admin.viewing_tricks'))

@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="page-header">
				<h1>{{ trans('admin.showing_all_tricks') }}  </h1>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<table class="table">
			   	<thead>
			    	<tr>
				     	<th>{{ trans('admin.trick_title') }}</th>
						<th>{{ trans('admin.trick_desc') }}</th>
						<th>{{ trans('admin.trick_date') }}</th>
						<th>{{ trans('admin.trick_status') }}</th>
						 
			    	</tr>
			   	</thead>
			   	<tbody>
			   		
				  	@foreach($tricks as $trick)
				    <form name="myform" id="myform">
				     <tr>
				    	 <td>{{$trick->title}}</td>
				       	<td>{{$trick->description}}</td>
				       	<td>{{$trick->created_at}}</td>
				       	<td>{{Form::select('tt', array('1' => 'اولي', '2' => 'فعال', '3' => 'مرفوض', '4' => 'منتهي الصلاحية'), $trick->trick_status);}}
				       	</td>
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
