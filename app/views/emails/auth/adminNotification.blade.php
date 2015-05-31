<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="img/jea_logo.ico" type="image/x-icon" />
	</head>
	<body>
		<p><img width="230" height="50" src="{{ URL::to('img/logo@2x.1.png') }}">
	 </p>
	 <p><a href="{{url('login')}}"> <h2><font color="blue">إسم الشركة : {{ $msg }}</font></h2></a></p>
		<p><h2>{{ trans('emails.newCompanyreset') }}</h2></p>

		<h2>{{ trans('emails.postactivation') }}</h2>

		<div>
		</div>
	</body>
</html>