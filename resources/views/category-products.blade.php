@extends('layouts.web')
@section('title','Grovery')
@section('content')
<div class="container-fluid filterbg">
<div class="container">
		<div class="filtermenu">
			<div class="stimg"></div>
			<div class="homebtn"><a href="javascript:">Home</a></div>
			<div class="categorybtn"><a href="javascript:">Categories</a></div>
			<div class="offerbtn"><a href="javascript:">Offer</a></div>
			<div class="loupe"><a href="javascript:">Search</a></div>
			<div class="formsearch"><img class="formcls" src="images/clsmenu.png" alt=""><form><input name="" id="" type="text" placeholder="Search products"><input type="submit" id="" name="" value="Search"><div class="clear"></div></form></div>
			<div class="reviewbtn"><a href="javascript:">Rate us</a></div>
			<div class="infobtn"><a href="javascript:">Info & Reviews</a></div>
			<div class="clear"></div>
		</div>
		</div>
		</div>
		<div class="container">
		<div class="breadcrumb">
			<ul>
				<li><a href="javaascript;">{{$maincategory['mc_name']}}</a></li>
				<li><a href="javaascript;">{{$seller['sd_sname']}}</a></li>
				<li><a href="javaascript;">Categories</a></li>
			</ul>
		</div>
		@foreach($category as $category)
		
		<div class="st-cate">
			<h4>{{$category['cat_name']}} <span><a href="javascript:">See More</a></span></h4>
			<div id="box2">
			@foreach($subcategory as $subcategorys)
			@php 
			$mainid=$maincategory['mc_id'];
			$catid=$category['cat_id'];
			$subid=$subcategorys->cat_id;
			@endphp
			@if($subcategorys->cat_is_parent_id==$category['cat_id'])
			  <div class="item"><img  width="220" height="130" src="{{asset('public/admin/images/')}}/{{$subcategorys->cat_image}}" alt=""><span><a href="{{asset('store')}}/{{$mainid}}/{{$sid}}/{{$catid}}/{{$subid}}">{{$subcategorys->cat_name}}</a></span></div>		
			@endif
				@endforeach		  
			  <section class="clear"></section>
			 
		</div>
</div>

@endforeach
</div>
@endsection