@section('title', $trick->pageTitle)

@section('description', $trick->pageDescription)
 
@section('scripts')

    <script src="{{ url('js/vendor/highlight.pack.1.js')}}"></script>
    <script type="text/javascript">
    (function($) {
        hljs.tabReplace = '  ';
        hljs.initHighlightingOnLoad();
        $('[data-toggle=tooltip]').tooltip();
    })(jQuery);
    </script>
    @if(Auth::check())
    <script>
    (function(e){e(".js-like-trick").click(function(t){t.preventDefault();var n=e(this).data("liked")=="0";var r={_token:"{{ csrf_token() }}"};e.post('{{ route("tricks.like", $trick->slug) }}',r,function(t){if(t!="error"){if(!n){e(".js-like-trick .fa").removeClass("text-primary");e(".js-like-trick").data("liked","0");e(".js-like-status").html("التقدم للوظيفة؟")}else{e(".js-like-trick .fa").addClass("text-primary");e(".js-like-trick").data("liked","1");e(".js-like-status").html("تقدمت للوظيفة")}e(".js-like-count").html(t+"متقدم")}})})})(jQuery)
    </script>
    @endif
@stop

@section('content')
 
    <div class="container" >
        <div class="row">
            <div class="col-lg-9 col-md-8">
                <div class="content-box">
                    @if(Auth::check() && (Auth::user()->id == $trick->user_id))
                        <div class="text-right">
                            <a data-toggle="modal" href="#deleteModal">حذف</a> |
                            <a href="{{$trick->editLink}}">تعديل</a>
                            @include('tricks.delete',['link'=>$trick->deleteLink])
                        </div>
                    @endif
                    <div class="trick-user">
                        <div class="trick-user-image">
                            <img src="{{ $trick->user->photocss }}" class="user-avatar">
                        </div>
                        <div class="trick-user-data">
                            <h1 class="page-title">
                                {{ $trick->title }}
                            </h1>
                            <div>
                                المعلن عن الوظيفة  :  -   <b><a href="{{ route('user.profile', $trick->user->username) }}">
                        @if(Auth::check() )
                           @if ((Auth::user()->is_admin ==1))  
                               {{ $trick->user->companyname }}
                            @else
                               @if(($trick->user->flag_name == 0))
                                {{ $trick->user->companyname }}
                               @else
                                إسم الشركة غير معلن
                                @endif
                             @endif
                        @else
                               @if(($trick->user->flag_name == 0))
                                {{ $trick->user->companyname }}
                               @else
                                إسم الشركة غير معلن
                                @endif
                         @endif
                               </a></b>
                            </div>
                           <div > <?php
$date = new DateTime($trick->created_at);
 
?>
                            تم الإعلان   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:-   {{ $date->format('Y-m-d') }}
                            </div>
                        </div>
                    </div>
                    <p>{{{ $trick->description }}}</p>
                    <pre><code class="php">{{{ $trick->code }}}</code></pre>
                </div>
            </div>
                <div class="col-lg-3 col-md-4">
                    <div class="content-box">
                        <b>حالة الوظيفة</b>
                        <ul class="list-group trick-stats">
                            
          @if(Auth::check())  
                       @if(\Auth::user()->user_cat==1)
                            <a href="#" class="list-group-item js-like-trick" data-liked="{{ $trick->likedByUser(Auth::user()) ? '1' : '0'}}">
                            <span class="fa fa-pencil @if($trick->likedByUser(Auth::user())) text-primary @endif"></span>
                                 <!--@if(Auth::check()) -->
                                <span class="js-like-status">
                                    @if($trick->likedByUser(Auth::user()))
                                        تقدمت  للوظيفة
                                    @else
                                        التقدم للوظيفة؟
                                    @endif
                                </span>
                                <span class="pull-right js-like-count"></span> </a>
                                <!--@endif -->
                       @endif
               
                @if(($trick->user_id==Auth::user()->id) || (Auth::user()->is_admin==1))
                        <a href="{{ route('tricks.applyreport', $trick->slug) }}" class="fa fa-pencil  " >  {{ Str::plural('عدد المتقدمين للوظيفة :', $trick->vote_cache) }}{{ $trick->vote_cache }}</a>
                @else
                      
                     @if(\Auth::user()->user_cat<>1) 
                        <span class="fa fa-pencil  "></span>  
                        {{ Str::plural('عدد المتقدمين للوظيفة :', $trick->vote_cache) }}{{ $trick->vote_cache }}
               
                  @endif

                @endif

                            
                          
     @else
                            &nbsp;&nbsp;&nbsp;
                            
 
                             <span class="fa fa-pencil @if($trick->likedByUser(Auth::user())) text-primary @endif"></span>
                               
 
                                عدد المتقدمين للوظيفة
                                    {{ $trick->vote_cache }}  
                                @if(Auth::check())</span>@endif
      @endif
                             
                            <li class="list-group-item">
                                <span class="fa fa-eye"></span> {{ $trick->view_cache }} تمت المشاهدة
                            </li>
                        </ul>
                        @if(count($trick->allCategories))
                            <b>التخصصات الرئيسية</b>
                            <ul class="nav nav-list push-down">
                                @foreach($trick->allCategories as $category)
                                    <li>
                                        <a href="{{ route('tricks.browse.category', $category->slug) }}">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        @if(count($trick->tags))
                            <b>التخصصات الفرعية</b>
                            <ul class="nav nav-list push-down">
                                @foreach($trick->tags as $tag)
                                    <li>
                                        <a href="{{ route('tricks.browse.tag', $tag->slug) }}">
                                            {{ $tag->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="clearfix">
                            @if($prev)
                                <a  href="{{ route('tricks.show', $prev->slug) }}"
                                    title="{{ $prev->title }}" data-toggle="tooltip"
                                    class="btn btn-sm btn-primary">
                                        &laquo; الوظيفة السابقة
                                </a>
                            @endif

                            @if($next)
                                <a  href="{{ route('tricks.show', $next->slug) }}"
                                    title="{{ $next->title }}" data-toggle="tooltip"
                                    class="btn btn-sm btn-primary pull-right">
                                        الوظيفة التالية &raquo;
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col-lg-9 col-md-8">
                        <div id="disqus_thread"></div>
                        <script type="text/javascript">
                            var disqus_shortname = '{{ Config::get("config.disqus_shortname") }}';
                            var disqus_identifier = '{{$trick->id}}';

                            (function() {
                                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                                dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                            })();
                        </script>
                        <noscript>Please enable JavaScript to view the </noscript>
                       
                    </div>
                </div>


        {{--<div class="row">
            <div class="col-lg-12">
                <h2 class="title-between">Related tricks</h2>
            </div>
        </div>
        <div class="row">
            @for($i = 0; $i < 3; $i++)
                @include('tricks.card', [ 'test' => $i ])
            @endfor
        </div>--}}

    </div>
@stop
