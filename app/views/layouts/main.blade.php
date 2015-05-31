<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:og="http://ogp.me/ns#"
      xmlns:fb="https://www.facebook.com/2008/fbml">
    <head>

        @section('description', trans('layouts.meta_description'))
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta property="og:title" content="" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="" />
        <meta property="og:image" content="" />
        <meta property="og:site_name" content="" />
        <meta property="og:description" content="@yield('description')" />
        <meta name="description" content="@yield('description')">
        <meta name="author" content="{{ trans('layouts.meta_author') }}">
        <title>
		@yield('title') 
		| 
		{{ trans('layouts.site_title') }}
	</title>
        <link rel="shortcut icon" href="img/jea_logo.ico" type="image/x-icon" />
        <link rel="stylesheet" href="{{ URL::asset('css/laratricks.min.4.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}" >
        
        @yield('styles')
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.2/html5shiv.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.2.0/respond.js"></script>
         
    </head>

    <body>
 
        <div id="wrap">
            @include('partials.navigation')
            @yield('content')
        </div>

        @include('partials.footer')

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
        @yield('scripts')
        <script type="text/javascript">
        $( document ).ready(function() {
            $('#companyRegLink').click(function(){
                $('#companyRegForm').show();
                return false;
            });
        });
                //$('#companyRegForm')
        </script>
    </body>
</html>
