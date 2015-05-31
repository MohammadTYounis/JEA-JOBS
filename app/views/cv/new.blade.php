@section('title', trans('cv.trick'))

@section('styles')
<link rel="stylesheet" href="{{ URL::asset('css/jquery.Jcrop.min.1.css') }}">
<link href="{{ URL::asset('css/jquery-ui.css') }}" rel="stylesheet" type="text/css"/>
<link rel="shortcut icon" href="img/jea_logo.ico" type="image/x-icon" />
@stop

@section('scripts')
<script type="text/javascript">
  var FileAPI = {
          debug: false
          , staticPath: "{{ url('js/vendor/uploader') }}/"
          , postNameConcat: function (name, idx){
        return  name + (idx != null ? '['+ idx +']' : '');
      }
  };
</script>
<script src="{{ asset('js/vendor/uploader/FileAPI.min.js') }}"></script>
<script src="{{ asset('js/vendor/uploader/FileAPI.exif.js') }}"></script>
<script src="{{ asset('js/vendor/uploader/jquery.fileapi.js') }}"></script>
<script src="{{ asset('js/vendor/uploader/jquery.Jcrop.min.js') }}"></script>
 
<script src="{{ asset('js/jquery-ui.js') }}"></script>
  
  <script>
  $(document).ready(function() {
    $("#datepicker").datepicker();
    $("#datepicker2").datepicker();
  });
  </script>
<script type="text/javascript">
jQuery(function ($){
  $('#cropper-preview').on('click', '.js-upload', function (){
     $('#upload-avatar').fileapi('upload');
     $('#cropper-preview').fadeOut();
  });
  $('#upload-avatar').fileapi({
     url: '{{ route("user.avatar") }}',
     accept: 'image/*',
     data: { _token: "{{ csrf_token() }}" },
     imageSize: { minWidth: 100, minHeight: 100 },
     elements: {
        active: { show: '.js-upload', hide: '.js-browse' },
        preview: {
           el: '.js-preview',
           width: 96,
           height: 96
        },
        progress: '.js-progress'
     },
     onSelect: function (evt, ui){
        var file = ui.all[0];
        if( file ){
          $('#cropper-preview').show();

          $('.js-img').cropper({
             file: file,
             bgColor: '#fff',
             maxSize: [$('#cropper-preview').width()-40, $(window).height()-100],
             minSize: [100, 100],
             selection: '90%',
             aspectRatio: 1,
             onSelect: function (coords){
                $('#upload-avatar').fileapi('crop', file, coords);
             }
          });
        }
     },

    onComplete: function(evt, xhr)
     {
      try {
        var result = FileAPI.parseJSON(xhr.xhr.responseText);
        $('#avatar-hidden').attr("value",result.images.filename);
      } catch (er){
        FileAPI.log('PARSE ERROR:', er.message);
      }
     }
  });
});
function fillcv_exp(x){
  
    document.getElementById("ser2").value = x;
}
</script>
@stop

@section('content')

	<div class="container">
		<div class="row">

			<div class="col-lg-8 col-lg-push-2 col-md-8 col-md-push-2 col-sm-12 col-xs-12 text-right">
				<div class="content-box">
					
           
           
      <h1 class="page-title">{{ trans('cv.creating_new_trick') }}</h1>
        
     
					@if(Session::get('errors'))
					    <div class="alert alert-danger alert-dismissable">
					        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					         <h5>{{ trans('cv.errors_while_creating') }}</h5>
					         @foreach($errors->all('<li>:message</li>') as $message)
					            {{$message}}
					         @endforeach
					    </div>
					@endif

				<ul class="nav nav-pills" role="tablist">
  <li class="active btn-danger"><a href="#home" role="tab" data-toggle="tab">البيانات الشخصية</a></li>
  <li><a href="#profile" role="tab" data-toggle="tab">الخبرات و الدورات</a></li>
  <li><a href="#settings" role="tab" data-toggle="tab">إرفاق السيرة الذاتية</a></li>
</ul>
        
<div class="tab-content">
  <div class="tab-pane active" id="home">
   
   {{ Form::open(array('class'=>'form-vertical','id'=>'save-cv-form1','role'=>'form'))}}
      
      <fieldset>
					     <div class="form-group">

                <br>
               </div> 

               <div class="col-md-7">
     <div id="cropper-preview" style="display:none;">
       <div class="panel panel-info">
         <div class="panel-heading">
           <h3 class="panel-title">{{ trans('cv.crop_picture') }}</h3>
         </div>
         <div class="panel-body">
           <div class="js-img"></div>
           <p>
             <div class="js-upload btn btn-primary">{{ trans('cv.upload') }}</div>
           </p>
         </div>
       </div>
     </div>
    </div>
           
<div class="form-group" >
   
              <label for="avatar" class="col-lg-6 control-label">{{ trans('cv.profile_picture') }}</label>
              <div class="col-lg-4">
                <input type="hidden" id="avatar-hidden" name="avatar" value="">
                <div id="upload-avatar" class="upload-avatar">
                  <div class="userpic" style="background-image: url('{{{ Auth::user()->photocss}}}');">
                     <div class="js-preview userpic__preview"></div>
                  </div>
                  <div class="btn btn-sm btn-primary js-fileapi-wrapper">
                     <div class="js-browse">
                        <span class="btn-txt">{{ trans('cv.choose') }}</span>
                        <input type="file" name="filedata">
                     </div>
                     <div class="js-upload" style="display: none;">
                        <div class="progress progress-success"><div class="js-progress bar"></div></div>
                        <span class="btn-txt">{{ trans('cv.uploading') }}</span>
                     </div>
                  </div>
                </div>
              </div>
            </div>


         
              <div class="form-group">

                <br>
               </div>
               <div class="form-group">
                <label for="username" class="col-lg-4 control-label"> {{ trans('cv.username') }} </label>
                <div class="col-lg-6">
               <input type="text" disabled class="form-control" id="username" placeholder="{{Auth::user()->username}}">
               <br>
               </div>
               </div>   
              <div class="form-group">
                <label for="eng_name" class="col-lg-4 control-label"> {{ trans('cv.eng_name') }} </label>
               <div class="col-lg-6">  
               <input type="text" disabled class="form-control" id="companyname" placeholder="{{Auth::user()->companyname}}">
               <br>
               </div>
               </div> 
              
            <div class="form-group">
                <label for="birthdate" class="col-lg-4 control-label"> {{ trans('cv.birthdate') }}</label>
                <div class="col-lg-6"> 
             <input type="text" disabled class="form-control" id="eng_birthdate" placeholder="{{Auth::user()->eng_birthdate}}">
             <br/> 
              </div> 
            </div>
        <br/> 
            <div class="form-group">
                <label for="eng_phone" class="col-lg-4 control-label"> {{ trans('cv.eng_phone') }}</label>
               <div class="col-lg-6" > {{Form::text('cv_eng_phone',Auth::user()->phonenumber, array('class'=>'form-control','placeholder'=>trans('cv.phonenumber'),'required' ));}}
             <br>
              </div>
           </div>

           <div class="form-group">
                <label for="email" class="col-lg-4 control-label"> {{ trans('cv.email') }} </label>
              <div class="col-lg-6"> {{Form::email('cv_email',Auth::user()->email, array('class'=>'form-control','placeholder'=>trans('cv.email'),'required' ));}}
              <br>
              </div>
               </div>
		
<p></p>    
				 <input type="hidden" name ="flag_save" id="flag_save" value ="user">
					    <div class="form-group">
					        <div class="text-right">
					          <button type="submit"  id="save-section" class="btn label-primary ladda-button" data-style="expand-right">
					           <strong> {{ trans('cv.save_trick') }}</strong>
					          </button>
					        </div>
					    </div>
</fieldset>
					{{Form::close()}}
</div>

 <div class="tab-pane" id="profile">
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="page-header">
        <h1>{{ trans('cv.exp_addexp') }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="pull-center"> <a data-toggle="modal" href="#add_category" class="btn btn-primary btn-sm">{{ trans('cv.exp_addexp') }}</a></span></h1>
      </div>

      <table class="table">
         <thead>
           <tr>
             <th class="col-lg-3 text-center">{{ trans('cv.cvtitle') }}</th>
             <th class="col-lg-3 text-center">{{ trans('cv.cvdescription') }} {{ trans('cv.cvdesc') }}</th>
             
             <th class="col-lg-3 text-center">{{ trans('cv.cvfromdate') }}</th>
             
             <th class="col-lg-3 text-center">{{ trans('cv.cvtodate') }}</th>
             <th class="col-lg-3 text-center">{{ trans('cv.period') }}</th>
             <th class="col-lg-2 text-center">{{ trans('cv.cvactions') }}</th>
           </tr>
         </thead>
         <tbody id="sortable">
         {{ Form::open(array('class'=>'form-vertical','id'=>'save-cv-form7','role'=>'form'))}}    
         @if(!empty($items))
          @foreach($items as $item)
          <tr rel="{{ $item->ser }}">
              <td class="col-lg-3 text-center">@if($item->exp_type==0)
                              دورة 
                              @else
                              خبرة
                              @endif
                              <input type="hidden" name ="ser" id="ser" value ="{{ ($item->ser) }}">
              
  </td>
              <td class="col-lg-3 text-center">{{ substr(($item->title),1,5) }} / {{ substr(($item->des),1,5) }}</td>
              
              <td class="col-lg-3 text-center">{{ ($item->from_date) }}</td>
           
              <td class="col-lg-3 text-center">{{ ($item->to_date) }}</td>
              <td class="col-lg-3 text-center">{{ ($item->period) }}</td>
              <td class="col-lg-2 text-center">
                <div class="btn-group pull-center">
                  <span class="pull-center"> <a data-toggle="modal" onclick="fillcv_exp({{ ($item->ser) }})" href="#delete_category" class="delete_toggler btn btn-primary btn-sm" rel="{{$item->ser}}">{{ trans('cv.exp_delexp') }}</a></span>
                  
                </div>
             </td>
           </tr>

 
          @endforeach
          @endif
          <!-- Modal -->
 <div class="modal fade" id="delete_category" tabindex="5" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         <h4 class="modal-title"></h4>
       </div>
       <div class="modal-body">
          <p class="lead text-left">{{ trans('cv.category_will_be_deleted') }}</p>
       </div>
        <input type="hidden" name ="ser2" id="ser2" value= >
         <div class="modal-footer">
          <input type="hidden" name ="flag_save" id="flag_save" value ="cv_exp_delete">
          <a data-dismiss="modal" href="" class="btn btn-danger">{{ trans('cv.keep') }}</a>
          <button type="submit"  id="delete_link" class="btn label-primary ladda-button" data-style="expand-right">
                     <strong> {{ trans('cv.willdelete') }}</strong>
                    </button>


       </div>
     </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
 </div>

          {{Form::close()}}
          </tbody>
      </table>
    </div>
  </div>
</div>

   <div class="modal fade" id="add_category" tabindex="5" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         <h4 class="modal-title"></h4>
       </div>
       <div class="modal-body">
          @if($errors->all())
              <div class="bs-callout bs-callout-danger">
                  <h4>{{ trans('cv.please_fix_errors') }}</h4>
                  {{ HTML::ul($errors->all())}}
              </div>
          @endif
   {{ Form::model('cv_exp',array('class'=>'form-horizontal'))}}
           
           <div class="form-group">
              <div class="col-lg-5 ">
              <h4 class="modal-title">{{ trans('cv.adding_new_exp') }}</h4>
              </div>
          </div>



           <div class="form-group">
              <label for="name" class="col-lg-3 control-label">{{ trans('cv.exp_type') }}</label>
              <div class="col-lg-2 ">
                {{ Form::select('exp_type',array('-1'=>'يرجى الإختيار','0'=>'الدورات ','1'=>'الخبرات العملية'),'0') }}
              </div>
          </div>

           <div class="form-group">
              <label for="name" class="col-lg-3 control-label">{{ trans('cv.exp_fdate') }}</label>
              <div class="col-lg-4">
                {{Form::input('text', 'from_date', null, ['class' => 'form-control', 'placeholder' => 'من تاريخ ','pattern'=>'\d{1,2}/\d{1,2}/\d{4}','required','id' =>'datepicker']) }}
              </div>
          </div>
         
         <div class="form-group">
              <label for="name" class="col-lg-3 control-label">{{ trans('cv.exp_tdate') }}</label>
              <div class="col-lg-4">
                {{Form::input('text', 'to_date', null, ['class' => 'form-control', 'placeholder' => 'إلى تاريخ','pattern'=>'\d{1,2}/\d{1,2}/\d{4}','required','id' =>'datepicker2']) }}
             </div>
          </div>

   <div class="form-group">
     <label for="name" class="col-lg-3 control-label">{{ trans('cv.tags') }}</label>
                <div class="col-lg-4">
                  {{ Form::select('tags', $tagList, null, array('id'=>'tags' )); }}</p>
                   
              </div>
          </div>
    
          <div class="form-group">
              <label for="name" class="col-lg-2 control-label">{{ trans('cv.exp_title') }}</label>
              <div class="col-lg-10">
                {{ Form::text('title',null,array('class'=>'form-control','required'))}}
              </div>
          </div>
            <div class="form-group">
                <label for="description" class="col-lg-2 control-label">{{ trans('cv.exp_desc') }}</label>
                <div class="col-lg-10">
                    {{ Form::textarea('desc',null,array('class'=>'form-control','rows'=>'5'))}}
                </div>
            </div>
          <div class="form-group">    
        <input type="hidden" name ="flag_save" id="flag_save" value ="cv_exp">
          <br>
          </div>

          <div class="form-group">
                  <div class="text-right">
                   <button type="submit"  id="save-section" class="btn label-primary ladda-button" data-style="expand-right">
                     <strong> {{ trans('cv.save_exp') }}</strong>
                    </button>
                     
                  </div>
              </div>
              
          {{ Form::close()}}

          </div>
     </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
 </div><!-- /.modal -->

 

 </div>
 <div class="tab-pane" id="settings">
 
{{ Form::open(array('class'=>'form-vertical','id'=>'save-cv-form3','role'=>'form','files'=>'true'))}}
      
             
               <div class="form-group" >
                <label for="title" class="col-lg-4 control-label">{{ trans('cv.title') }}</label>
               <div class="col-lg-6"> {{Form::text('cv_title',isset($cv->cv_title) ? $cv->cv_title : '' , array('class'=>'form-control','placeholder'=>trans('cv.title_placeholder'),'required' ));}}
              <br>
              </div>
           </div>
              
              <div class="form-group">
                <label for="description" class="col-lg-4 control-label">{{ trans('cv.summary') }}</label>
               <div class="col-lg-6"> {{Form::textarea('cv_summary',isset($cv->cv_summary) ? $cv->cv_summary : '', array('class'=>'form-control','placeholder'=>trans('cv.cv_summary_placeholder'),'rows'=>'3','required'));}}
              
 </div> <br></div>
        <div class="form-group" >
          <div class="col-lg-1">
<br> <br><br> <br>
          </div>
        </div>       
       <div class="form-group">      
      <label for="exampleInputFile" class="col-lg-4 control-label">أنواع الملفات المتاحة :</label>
    <div class="col-lg-6"> <input type="text" disabled class="form-control" id="xxx" placeholder=" إمتداد الملفات .doc .pdf  ">
      </div><br>
       </div>
     <div class="form-group" >
          <div class="col-lg-1">
<br> <br> 
          </div>
        </div> 
      
       <div class="form-group">
      <label for="outputFile" class="col-lg-4 control-label">إرفاق السيرة الذاتية :</label>
       <div class="col-lg-3">
        {{ Form::file('cv_attachment','',array('id'=>'cv_attachment')) }}
         </div>  <br>
          </div>

          <div class="form-group" >
          <div class="col-lg-1">
<br> <br> 
          </div>
        </div>  
        <div class="form-group" >
          <div class="col-lg-1">
<br> 
          </div>
        </div> 
         
          <div></div> 
@if(!empty($cv->cv_attachment))
   <div class="form-group">      
      <div class="col-lg-6 control-label"> 
      <a href="{{ URL::to('img/CV/'.$cv->cv_attachment)}}" target="_blank" class="btn btn-primary">مشاهدة السيرة الذاتية {{ $cv->cv_attachment."/".$cv->updated_at  }}</a>
     </div> <br> 
  @else
  <div class="form-group">      
      <div class="col-lg-6 control-label"> 
      لم يتم تحميل ملف السيرة الذاتية
     </div> <br>
    @endif  
</div>
<div class="container">
   <div class="form-group">    
        <input type="hidden" name ="flag_save" id="flag_save" value ="cv">
          <br>
          </div>
</div>
 
        
          
                  <div class="form-group">
                  <div class="text-right">
                   <button type="submit"   id="save-section" class="btn label-primary ladda-button" data-style="expand-right">
                     <strong> {{ trans('cv.save_cv') }}</strong>
                    </button>
                     
                  </div>
              </div>

          {{Form::close()}}
 
 </div>
 
				</div>
			</div>
		</div>
	</div>
  </div>
</div>
 
@stop

