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
				<li><a href="javascript;">Categories</a></li>
			</ul>
		</div>
		<div class="sidemenu"><img src="images/sidemenu.png" alt=""></div>
		<div class="cate-menu">
			<span><img id="clsmenu" src="images/clsmenu.png" alt=""></span>
			<h5>{{$maincategory['mc_name']}}</h5>
			<ul>
			@foreach($category as $category)
			@foreach($productcategory as $productcategorys)
			@php
			$mainid=$maincategory['mc_id'];
			$catid=$category['cat_id'];
			$subid1=$productcategorys->cat_id;
			@endphp
			@if($productcategorys->cat_is_parent_id==$category['cat_id'])
				<li class="act"><a href="{{asset('store')}}/{{$mainid}}/{{$sid}}/{{$catid}}/{{$subid1}}">{{$productcategorys->cat_name}}</a></li>
			@endif
				@endforeach
				@endforeach
			</ul>
		</div>
		<div class="cate-list">
			<div class="sortby">
				<ul>
					<li>Sort by</li>
					
					<li><a href="javascript:(0)" onclick="sortprice('{{$mainid}}','{{$sid}}','{{$catid}}','{{$subid}}','low')">Lower price</a></li>
					<li><a href="javascript:(0)" onclick="sortprice('{{$mainid}}','{{$sid}}','{{$catid}}','{{$subid}}','high')">Higher price</a></li>
					<li><a href="javascript:(0)">Offer</a></li>
					<li><a href="javascript:(0)" onclick="sortprice('{{$mainid}}','{{$sid}}','{{$catid}}','{{$subid}}','alpha')">Alphabet</a></li>
				</ul>
			</div>
			
			
		<div class="st-cate">
			<h4>{{$subcategoryname['cat_name']}} <span><a href="javascript:">See More</a></span></h4>
			<div id="box">
			@foreach($subcategory as $subcategory)
				@php
				$saveprice=$subcategory['product_price']-$subcategory['product_sales_price'];
				@endphp
			  <div class="item"><img width="70" height="88" src="{{asset('public/admin/images/')}}/{{$subcategory['cat_image']}}" alt=""> 
			  <p><strike>Rs.{{$subcategory['product_price']}}</strike> <code>Rs.{{$subcategory['product_sales_price']}}</code><span>Save Rs.{{$saveprice}}</span></p><div class="clear"></div>
			  <span><a href="javascript:">{{$subcategory['product_name']}}</a></span>
			  <a class="adlst" href="{{asset('addlist')}}/{{$sid}}/{{$subcategory['product_id']}}">Add list</a><a class="adcart" href="{{asset('addcart')}}/{{$sid}}/{{$subcategory['product_id']}}">Add carts</a>
			  </div>
			  @endforeach
			  <section class="clear"></section>
			</div>
		</div>
		
			<script>
			function sortprice(mainid,sid,catid,subid,sort)
			{
				$.ajax({
				  type:"GET",
				  url:"{{url('store')}}/"+mainid+"/"+sid+"/"+catid+"/"+subid+"/"+sort,
				  success:function(res){        
				  $("#box").html(res);
				  }
				  
				});
			}
			</script>
</div>

<section class="clear"></section>
</div>
@endsection