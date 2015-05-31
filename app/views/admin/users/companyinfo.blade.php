@section('title', trans('user.settings'))

@section('styles')
<link rel="stylesheet" href="{{ URL::asset('css/jquery.Jcrop.min.1.css') }}">
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
</script>
@stop

@section('content')
<div class="container">
  <div class="row push-down">
    <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12">
      <h1 class="page-title">{{ trans('admin.company_settings') }}</h1>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 text-right">
       
    </div>
  </div>

  <div class="row">
    <div class="col-lg-6 col-lg-push-3 col-md-6 col-md-push-3 col-sm-8 col-sm-push-2 col-xs-12">
      <div class="content-box">

          <h3 class="content-title">{{ trans('admin.account_settings') }}</h3>
@foreach($userList as $user)
 {{ Form::open(array('role'=>'form','id'=>'loginform','class'=>'form-horizontal'))}}
          <fieldset>
            <div class="form-group">
              <label for="companyname" class="col-lg-4 control-label">{{ trans('user.companyname') }}</label>
              <div class="col-lg-8">
               <input type="text" readonly class="form-control" id="" value="{{$user->companyname}}">
               </div>
            </div>
             <div class="form-group">
              <label for="phonenumber" class="col-lg-4 control-label">{{ trans('user.phonenumber') }}</label>
              <div class="col-lg-8">
              <input type="text" readonly class="form-control" id="" value="{{$user->phonenumber}}">
              </div>
              </div>
              <div class="form-group">
              <label for="Address" class="col-lg-4 control-label">{{ trans('user.Address') }}</label>
              <div class="col-lg-8">
                <input type="text" readonly class="form-control" id="" value="{{$user->Address}}">
               </div>
               </div>
               
             <div class="form-group">
               <label for="flag_name" class="col-lg-4 control-label">{{ trans('home.flag_name') }}</label>
                 <div class="col-lg-8">
                @if($user->flag_name==1)
                <input type="text" readonly class="form-control" id="" value="معلن">
                 @else
               <input type="text" readonly class="form-control" id="" value="غير معلن">
                 @endif
               </div>
              </div>
             <div class="form-group {{Session::get('username_required')? 'has-error': ''}}">
              <label for="username" class="col-lg-4 control-label">{{ trans('user.username') }}</label>
              <div class="col-lg-8">
                 <input type="text" readonly class="form-control" id="username" value="{{$user->username}}">
                @if(Session::get('username_required'))
                  <span class="help-block">{{ trans('user.github_user_already_taken') }}</span>
                @endif
              </div>
            </div>
            <div class="form-group">
              <label for="email" class="col-lg-4 control-label">{{ trans('user.email') }}</label>
              <div class="col-lg-8">
                <input type="email" readonly class="form-control" id="email" value="{{$user->email}}">
              </div>
            </div>
          -
   <div class="col-md-7">
     <div id="cropper-preview" style="display:none;">
       <div class="panel panel-info">
         <div class="panel-heading">
           <h3 class="panel-title">{{ trans('user.crop_picture') }}</h3>
         </div>
         <div class="panel-body">
           <div class="js-img"></div>
           <p>
             <div class="js-upload btn btn-primary">{{ trans('user.upload') }}</div>
           </p>
         </div>
       </div>
     </div>
    </div>
            <div class="form-group">
              <label for="avatar" class="col-lg-4 control-label">{{ trans('user.profile_picture') }}</label>
              <div class="col-lg-8">
                <input type="hidden" id="avatar-hidden" name="avatar" value="">
                <div id="upload-avatar" class="upload-avatar">
                  <div class="userpic" style="background-image: url('{{{ $user->photocss}}}');">
                     <div class="js-preview userpic__preview"></div>
                  </div>
                   
                </div>
              </div>
            </div>

          
            <div class="form-group">
              <div class="col-lg-offset-7 col-lg-12">
               
                
              </div>
             </div>
          </fieldset>
          {{ Form::close() }}
            @endforeach
      </div>
    </div>

 


    
          

  </div>
</div>
@stop
