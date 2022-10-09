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
</head>
<body id="signbg">
<div class="signbox">
<div class="signinside">
<img class="loginlogo" src="{{asset('web/images/logo.png')}}" alt="">
<p>GROVERY</p>
<form class="login" method="post" action="submitregister">
@csrf
<div class="inval">
<label>Name</label>
<input type="text" name="name" id="" required>
</div>
<div class="inval">
<label>Email id</label>
<input type="email" name="email" id="" required>
</div>
<div class="inval">
<label>Phone No</label>
<input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
							type = "number" maxlength = "10" id="phone_no" name="phone_no"  required>

</div>


<input type="submit" value="Submit" name="" id="">
</form>
</div>
</div>
</body>
</html>