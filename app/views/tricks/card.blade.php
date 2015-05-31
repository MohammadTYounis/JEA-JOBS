<div href="#" class="trick-card col-lg-4 col-md-6 col-sm-6 col-xs-12">

	<div class="trick-card-inner js-goto-trick" data-slug="{{ $trick->slug }}">
		  
                        
		 <a class="trick-card-title" href="{{ route('tricks.show', [ $trick->slug ]) }}">
	 	<img class="img-responsive img-rounded" src="{{ $trick->user->photocss }}" height="48" width="48" border="1" ismap> &nbsp;&nbsp;{{{ $trick->title }}}
		</a> 

		<div class="trick-card-stats trick-card-by">تم الاعلان من قبل :  <b><a href="{{ route('user.profile', $trick->user->username) }}">

                              @if (($trick->user->flag_name == 0))
                                {{ $trick->user->companyname }}
                               @else
                                إسم الشركة غير معلن
                                @endif
	</a></b></div>
		<div class="trick-card-stats clearfix">
			<?php
$date = new DateTime($trick->created_at);
 
?>
			<div class="trick-card-timeago">  {{ trans('tricks.submitted', array('timeago' => $date->format('Y-m-d') , 'categories' => $trick->categories)) }} </div>
			<div class="trick-card-stat-block"><span class="fa fa-eye"></span> {{$trick->view_cache}}</div>
			<div class="trick-card-stat-block text-center"></span> <a href="{{ url('tricks/'.$trick->slug.'#disqus_thread') }}" data-disqus-identifier="{{$trick->id}}" style="color: #777;">
 
<?php
    if(!empty(Auth::user()->id)) {
    $useAuth = Auth::user()->id;

?>
  
 
 
@if ((  $useAuth== $trick->user_id ))
   @if( $trick->trick_status == 1)
        إنتظار الموافقة
    @elseif ( $trick->trick_status == 2)
     الطلب فعال
    @elseif ( $trick->trick_status == 3)
     الطلب مرفوض
    @elseif ( $trick->trick_status == 4)
      منتهي الصلاحية
  @endif
@endif       
		<?php
}
		?>	</a></div>
			<div class="trick-card-stat-block text-right"><span class="fa fa-pencil"></span> {{$trick->vote_cache}}</div>
		</div>
		<div class="trick-card-tags clearfix">
			@foreach($trick->tags as $tag)
			    <a href="{{url('tags/'.$tag->slug)}}" class="tag" title="{{$tag->name}}">{{$tag->name}}</a>
			@endforeach
		</div>
	</div>
</div>

