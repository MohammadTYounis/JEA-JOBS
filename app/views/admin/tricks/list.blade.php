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
						<th>{{ trans('admin.edit') }}</th> 
			    	</tr>
			   	</thead>
			   	<tbody>
			   		
				  	@foreach($tricks as $trick)
				    {{ Form::open(array('class'=>'form-vertical','url'=>'admin/tricks/list','role'=>'form','method'=>'post'))}}
				  
				     <tr>
				    	 <td>
{{ Form::hidden('trickid',$trick->id) }}
				    	 	{{$trick->title}}</td>
				       	<td> <a   href="{{ route('tricks.show', [ $trick->slug ]) }}">
				       		{{substr($trick->description,1,15)}}
				       	</a></td>
				       	<td>{{date("d-m-Y", strtotime($trick->created_at))}}</td>
				       	<td>{{Form::select('tt', array('1' => 'اولي', '2' => 'فعال', '3' => 'مرفوض', '4' => 'منتهي الصلاحية'), $trick->trick_status);}}
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
			<div class="text-center"> </div>
		</div>
	</div>
</div>
@stop
