@extends('layouts.web');
@section('title','Grovery') 
@section('content')
<div class="container-fluid">
<div class="row">
	<img class="banner" src="{{asset('web/images/banner.jpg')}}" alt="">
</div>
</div>
<div class="container">
		<h4>Near  by store</h4>
<section class="stores">

			@foreach($storedetails as $storedetails)
			<div class="storedet">
			<a href="{{$type}}/{{$storedetails['sd_usid']}}">
				<img src="{{asset('web/images/dmart.jpg')}}" alt="">
				<div class="sdet">
				<h5>{{$storedetails['sd_sname']}} <small>Grocery.veg&fru</small></h5>
				<span>Ganapathy</span>
				</div>
				</a>
			<div class="clear"></div>
			</div>
			
			@endforeach
			
			<section class="clear"></section>
			</section>
			
			<h4>Closed Stores <small>But you can order now fr next day delivery</small></h4>
			<div class="storedet">
				<img src="{{asset('web/images/kstore.png')}}" alt="">
				<div class="sdet">
				<h5>Dmart <small>Grocery.veg&fru</small></h5>
				<span>Ganapathy</span>
				</div>
			<div class="clear"></div>
			</div>
			<div class="storedet">
				<img src="{{asset('web/images/gro.jpg')}}" alt="">
				<div class="sdet">
				<h5>Kannan <small>Grocery.veg&fru</small></h5>
				<span>Ganapathy</span>
				</div>
			<div class="clear"></div>
			</div>
			<section class="clear"></section>
</div>

@endsection