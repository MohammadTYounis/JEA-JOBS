@section('title', trans('admin.viewing_seekers'))
@section('styles')
<link href="{{ URL::asset('css/jquery-ui.css') }}" rel="stylesheet" type="text/css"/>

@stop
  @section('scripts')
 <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>

<script src="{{ asset('js/jquery-ui.js') }}"></script>
  <script>
  $(document).ready(function() {
    $("#datepicker").datepicker();
    $("#datepicker2").datepicker();
  });
  </script>
 @stop
  		 
@section('content')

	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-push-2 col-md-8 col-md-push-2 col-sm-12 col-xs-12">
				<div class="content-box">
					<h1 class="page-title">
						{{ trans('admin.job_seeker') }}
					</h1>
					<br>
					@if(Session::get('errors'))
					    <div class="alert alert-danger alert-dismissable">
					        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					         <h5>{{ trans('tricks.errors_while_creating') }}</h5>
					         @foreach($errors->all('<li>:message</li>') as $message)
					            {{$message}}
					         @endforeach
					    </div>
					@endif
					{{ Form::open(array('class'=>'form-vertical','url'=>'admin/users/jobseekerReport','role'=>'form','method'=>'get'))}}
					  
					    <div class="form-group">
					    	<div class="col-lg-3"><label for="fromdate">{{ trans('admin.fromdate') }}</label>
					    	</div>
					    	<div class="col-lg-4">

            {{Form::input('text','fromdate', null, array('class'=>'form-control','placeholder'=>trans('admin.fromdate_placeholder'),'id' =>'datepicker','required' ));}}
					    </div>
					</div>
					<br>
					    <br>
					    <div class="form-group">
					    	<div class="col-lg-3"><label for="todate">{{ trans('admin.todate') }}</label>
					    	</div>
					    	<div class="col-lg-4">
		{{Form::input('text','todate', null, array('class'=>'form-control','placeholder'=>trans('admin.todate_placeholder'),'id' =>'datepicker2','required' ));}}
					    </div>
					    </div>
					    <br>
					    <br>
					    

				  <div class="form-group">
               <label for="flag_name" class="col-lg-3 control-label">{{ trans('admin.sex') }}</label>
                 <div class="col-lg-4">
               
                ذكر   : {{ Form::radio('GENDER','ذكر',true)."  " }} 
                أنثى  : {{ Form::radio('GENDER','أنثى')."  " }} 
                كلاهما  : {{ Form::radio('GENDER','0')."  " }} 
               </div>
             
             <br>
             <br>
              

             
              <div class="form-group">
					    	<div class="col-lg-3"><label for="fromdate">{{ trans('admin.main_spec') }}</label>
					    	</div>
					    	<div class="col-lg-4">
					    		   {{ Form::select('category', $categoryList, null, array('class'=>'form-vertical','id'=>'category' )); }} 
                   
					    </div>
					</div>
              </div>

             
             <br>
             
<br>
              <div class="form-group">
					    	<div class="col-lg-3"><label for="fromdate">{{ trans('admin.sub_spec') }}</label>
					    	</div>
					    	<div class="col-lg-4">

					    		  {{ Form::select('tags', array('0'=>'الجمــــيع',$tagList), null, array('class'=>'form-vertical','id'=>'tags' )); }} 
                   
					    </div>
					</div>
               

               <br>
               <br>
                <div class="form-group">
					    	<div class="col-lg-3"><label for="fromdate">{{ trans('admin.exc_desc') }}</label>
					    	</div>
					    	<div class="col-lg-4">{{Form::text('det_spec', null, array('class'=>'form-control','placeholder'=>trans('admin.exc_desc_placeholder') ));}}
					    </div>
					</div>
              

               <br>
               <br>	 
              <div class="form-group">
					    	<div class="col-lg-3"><label for="fromdate">{{ trans('admin.exc') }}</label>
					    	</div>
					    	<div class="col-lg-4">

					    		{{Form::selectRange('exp_no', 0, 20)}}
					    </div>
					</div>
              

               <br>
               <br>
          
                  
			   <div class="form-group">
					        <div class="text-right">
					          <button type="submit"  id="save-section" class="btn btn-primary ladda-button" data-style="expand-right">
					            {{ trans('admin.show_report') }}
					          </button>
					        </div>
					    </div>
					 
				</div>
			</div>
		</div>
	</div>
@stop

