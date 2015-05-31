<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="img/jea_logo.ico" type="image/x-icon" />
	</head>
	<body>
		<p><img width="230" height="50" src="{{ URL::to('img/logo@2x.1.png') }}">
	 </p>
		<p><h2>{{ trans('emails.jeaemail_reset') }}</h2></p>

		<h2>{{ trans('emails.password_reset') }}</h2>

		<div>
		<a href="{{  URL::to('password/reset', array($token)) }}">	{{ trans('emails.reset_password_here', array('form_link' => URL::to('password/reset', array($token)))) }}</a>
		</div>
	</body>
</html>