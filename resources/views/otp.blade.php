<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="width" name="MobileOptimized">
<meta content="true" name="HandheldFriendly">
<title>Register page</title>
<link rel="stylesheet" href="{{asset('web/css/reset.css')}}">
<link rel="stylesheet" href="{{asset('web/css/responsive.css')}}">
<link rel="stylesheet" href="{{asset('web/css/style.css')}}">
<link rel="stylesheet" href="{{asset('web/css/bo otstrap.css')}}">
@include('common.admin.header_script')
</head>
<body id="signbg">
@if ($uploadError!="")
<div class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	{{$uploadError}}
</div>
@endif
<div class="signbox otp">
<div class="signinside">

<p>Please enter the One-Time Password to verify your account 
<span>A One-Time Password has been sent to xxxx</span></p>



<form class="login" action="checkotp" method="post">
@csrf
<input type="hidden" name="id" value="{{$id}}" id="id">
<div class="inval">
<input type="text" name="otp1" id="" required>
<input type="text" name="otp2" id="" required>
<input type="text" name="otp3" id="" required>
<input type="text" name="otp4" id="" required>
</div>
<input type="submit" value="Validate" name="" id="">
<span class="newuser">Entered a wrong number?<a href='javascript:'> Resend One-Time Password</a></span>
</form>
</div>
</div>
@include('common.admin.footer_script')
</body>
</html>