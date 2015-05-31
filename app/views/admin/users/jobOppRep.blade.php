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
			    		<th>{{ trans('admin.company_name') }}</th>
				     	<th>{{ trans('admin.trick_title') }}</th>
						<th>{{ trans('admin.trick_desc') }}</th>
						<th>{{ trans('admin.trick_date') }}</th>
						<th>{{ trans('admin.trick_status') }}</th>
						<th>{{ trans('admin.count_eng') }}</th> 
			    	</tr>
			   	</thead>
			   	<tbody>
			   		
				  	@foreach($tricks as $trick)
				    {{ Form::open(array('class'=>'form-vertical','url'=>'admin/tricks/list','role'=>'form','method'=>'post'))}}
				  
				     <tr>
				     	<td>{{$trick->companyname}}</td>
				    	 <td>
{{ Form::hidden('trickid',$trick->id) }}
				    	 	{{$trick->title}}</td>
				       	<td> <a   href="{{ route('tricks.show', [ $trick->slug ]) }}">
				       		{{substr($trick->desc,1,15)}}
				       	</a></td>
				       	<td>{{date("d-m-Y", strtotime($trick->created_at))}}</td>
				       	<td>{{$trick->description}}</td>
				       	 <td>

  
					         <a href="{{ route('tricks.applyreport', $trick->slug) }}" class="fa fa-pencil  " >  {{ Str::plural('عدد المتقدمين للوظيفة :', $trick->vote_cache) }}{{ $trick->vote_cache }}</a>
					            
					         
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
			<div class="text-center"> </div>
		</div>
	</div>
</div>
@stop
