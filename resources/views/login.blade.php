<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="width" name="MobileOptimized">
<meta content="true" name="HandheldFriendly">
<title>Login page</title>
<link rel="stylesheet" href="{{asset('public/web/css/reset.css')}}">
<link rel="stylesheet" href="{{asset('public/web/css/responsive.css')}}">
<link rel="stylesheet" href="{{asset('public/web/css/style.css')}}">
<link rel="stylesheet" href="{{asset('public/web/css/bo otstrap.css')}}">
</head>

@include('common.admin.header_script')
<body id="signbg">
@include('common.web.flash_message')
<div class="signbox">
<div class="signinside">
<img class="loginlogo" src="{{asset('web/images/logo.png')}}" alt="">
<p>GROVERY</p>
<form class="login" method="post" action="loginsubmit">
@csrf

<div class="inval">
<label>Phone Number</label>
<input type="number" name="phone_no" id="">
</div>
<input type="submit" value="Log in" name="" id="">
<span class="newuser">New user?<a href='javascript:'> Signup</a></span>
</form>
</div>
</div>
@include('common.admin.footer_script')
</body>
</html>