@section('title', trans('admin.viewing_jobopp'))
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
						{{ trans('admin.viewing_jobopp') }}
					</h1>
					@if(Session::get('errors'))
					    <div class="alert alert-danger alert-dismissable">
					        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					         <h5>{{ trans('tricks.errors_while_creating') }}</h5>
					         @foreach($errors->all('<li>:message</li>') as $message)
					            {{$message}}
					         @endforeach
					    </div>
					@endif
					{{ Form::open(array('class'=>'form-vertical','url'=>'admin/users/jobOppRep','role'=>'form','method'=>'get'))}}
					     <div class="form-group">
					   <br>
					    <div class="form-group">
					    	<div class="col-lg-3"><label for="fromdate">{{ trans('admin.adfromdate') }}</label>
					    	</div>
					    	 
					    	<div class="col-lg-4">
					    		 
	{{Form::input('text','fromdate', null, array('class'=>'form-control','placeholder'=>trans('admin.fromdate_placeholder'),'id' =>'datepicker','required' ));}}
					    </div>
					</div>
					<br>
					    <br>
					    <div class="form-group">
					    	<div class="col-lg-3"><label for="todate">{{ trans('admin.adtodate') }}</label>
					    	</div>
					    	<div class="col-lg-4">
	{{Form::input('text','todate', null, array('class'=>'form-control','placeholder'=>trans('admin.todate_placeholder'),'id' =>'datepicker2','required' ));}}
					    </div>
					    </div>
					    <br>
					    <br>
			
                
              <div class="form-group">
					    	<div class="col-lg-3"><label for="fromdate">{{ trans('admin.main_spec') }}</label>
					    	</div>
			<div class="col-lg-4"> {{ Form::select('category', $categoryList, null, array('class'=>'form-vertical','id'=>'category' )); }} 
					    </div>
					</div>
              </div>

             <br>
             <br>
             

              <div class="form-group">
					    	<div class="col-lg-3"><label for="fromdate">{{ trans('admin.company_namee') }}</label>
					    	</div>
					    	<div class="col-lg-4"> 
					    		
					    		 {{ Form::select('user', $userList, null, array('class'=>'form-vertical','id'=>'user' )); }} 
					   
					    </div>
					</div>
              

               <br>
               <br>
                
              

               <br>
   	       
			   <div class="form-group">
					        <div class="text-right">
					          <button type="submit"  id="save-section" class="btn btn-primary ladda-button" data-style="expand-right">
					            {{ trans('admin.show_report') }}
					          </button>
					        </div>
					    </div>
					{{Form::close()}}
				</div>
			</div>
		</div>
	</div>
@stop

