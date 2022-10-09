@extends('layouts.web')
@section('title','Grovery') 
@section('content')
<div class="container-fluid">
<div class="row">
	<img class="banner" src="{{asset('public/web/images/banner.jpg')}}" alt="">
</div>
</div>

<div class="category">
<section class="container">
<h2>CATEGORY</h2>
			@foreach($maincategory as $maincategory)
			<div><a href="store/{{$maincategory['mc_id']}}"><img src="{{asset('public/admin/images/category/')}}/{{$maincategory['image']}}" alt=""><small>{{$maincategory['mc_name']}}</small></a></div>
			@endforeach
			<section class="clear"></section>
			</section>
</div>
@endsection