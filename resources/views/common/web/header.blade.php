<header>

<div class="container">
<div class="mblnav">
	<img id='menucls' src="{{asset('public/web/images/mblnav.png')}}" alt="">
</div>
<div id="menu">
	<ul>
		@foreach($maincategorylist as $mainlists)
			<li><a href="store/{{$mainlists['mc_id']}}">{{$mainlists['mc_name']}}</a></li>
		@endforeach
	</ul>
	<a class="prime" href="javascript:">GROVERY PRIME</a>
</div>
<div class="logo">
	<img src="{{asset('public/web/images/logo.png')}}" alt="">
</div>
<div class="searchbx" style="width: 240px; margin-left: -50px;">
	<form>
		<input class="" id="" type="text" value="" placeholder="Search Products/Stores">
		<input class="" id="" type="submit" value="Search">
	</form>
</div>
<div class="locationbx" style="margin-left: -70px;">
	<form>
		<select class="" id="">
			<option value="">Ganapathy</option>
		</select>
	</form>
</div>
<div class="offer" style="margin-left: 100px;">
	<img src="{{asset('public/web/images/offer.png')}}" alt="">
</div>
<div class="cart" style="margin-left: -70px;">	
	<span>{{$cartcount}}</span>
</div>
@if(Auth::id()!="")
<div class="cartview">
	<div class="deliver">
		<form>
		<label>Deliver to:</label>
			<select class="" id="">
				 <option value="">Ganapathy</option>
			</select>
		</form>
		<img class="cls" src="{{asset('public/web/images/menucls.jpg')}}" alt="">
	</div>

@php
$j=1;
$savedprice=0;
@endphp
@foreach($addtocart as $addtocart)
@php
$subtotal=0;
$subtax=0;
$allsubtotal=0;
$final=0;

@endphp
<div class="deliver">
<div class="storepack">
	<div class="storeimg"><img src="{{asset('public/web/images/kannan.jpg')}}" alt=""></div>
	<p class="storename">{{$seller_list[$addtocart->store_id]}}</p>
	<button onclick="window.location.href='{{asset('/')}}'">ADD MORE</button>
	<div class="clear"></div>
</div>
</div>

@php
$subtotal=0;
$subtax=0;
$final=0;
$i=1;
@endphp
@foreach($cart_product as $cart_products)
@if($addtocart->store_id==$cart_products->store_id)
<div class="deliver">
<div class="storepack">
	<div class="storeimg"><img src="{{asset('public/admin/images/products')}}/{{$cart_products->main_image}}" alt=""></div>
	<div class="productdet">
	@php
	$saveprice=$cart_products->product_price-$cart_products->product_sales_price;
	@endphp
	    <p>{{$cart_products->product_name}}</p>
		<strike>RS.{{$cart_products->product_price}}</strike><span>RS.{{$cart_products->product_sales_price}}</span>
		<label>You save Rs.{{$saveprice}}</label>
		<div class="addcount">
		<span class="minus" onclick="getmincount({{$i}},{{$j}})" style="cursor:pointer">-</span>
		<label class="cartcount{{$i}}{{$j}}" >1</label>
		<span class="plus" onclick="getcount({{$i}},{{$j}}),{{$cart_products->product_sales_price}},{{$cart_products->product_tax}}" style="cursor:pointer">+</span>
		</div>
	</div>
	<div class="addlist"><a href="javascript:">Add List</a></div>
	<div class="clear"></div>
</div>
</div>
@php
$price=$cart_products->product_sales_price;
$subtotal +=$price;

$savedprice +=$saveprice;

$subtax +=$cart_products->product_tax;
$final=$subtotal+$subtax;

$i++;
@endphp

@endif
@endforeach
<div class="storebill">
<label>Instructions</label>
<form>
<textarea class="frmtext" name="" rows="" cols=""></textarea>
<div class="frmbtn">
<input type="text" name="" id="coupon" placeholder="Coupon code">
<input type="submit" id="applycou" name="" value="Apply coupon">
</div>
<div class="clear"></div>
</form>
<h4>Store Bill</h4>
<div class="billdet">
@php

@endphp
<span>{{$seller_list[$addtocart->store_id]}} store Subtotal</span> <label id="ajaxsubtotal">RS.{{$subtotal}}</label><div class="clear"></div>
</div>
<div class="billdet">
<span>Taxes and charges</span> <label id="ajaxsubtax">RS.{{$subtax}}</label><div class="clear"></div>
</div>
<!--<div class="billdet">
<span>Delivery charges</span> <label>RS.30.00</label><div class="clear"></div>
</div>-->
<div class="billdet borbot">
<span>To Pay</span> <label><strong id="ajaxfinal">RS.{{$final}}</strong></label><div class="clear"></div>
</div>
</div>
@php
$j++;
@endphp
@endforeach
<p class="saveorder">You Saved RS.{{$savedprice}} on this order</p>
<div class="checkoutbtn"><a href="javascript:">PROCESSED TO CHECKOUT</a></div>
</div>
@endif
<div class="profile" style="margin-left: -70px;">
	<img src="{{asset('public/web/images/profile.png')}}" alt="">
<div class="profileview">
<span class="arrow-up"></span>
<div class="proimg"><img src="{{asset('public/web/images/proimg.jpg')}}" alt=""></div>
<p>Hello <span>
@if(Auth::id()!="")
{{Auth::id()}}
@endif	

</span></p>
<div class="clear"></div>
<p class="prostrip">BANNER FOR GROVERY PRIME MEMBERSHIP</p>
<div class="promenu">
<ul>
<li><a href="javascript:">User profile</a></li>
<li><a href="{{route('customerAddress')}}">Address</a></li>
<li><a href="javascript:">Order history</a></li>
<li><a href="javascript:">Reorder</a></li>
<li><a href="{{route('addToListView')}}">Add list</a></li>
<li><a href="javascript:">Change Password</a></li>
<li><a href="customerlogout">Logout</a></li>
</ul>
</div>
</div>

</div>
<div class="clear"></div>
</div>
</header>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script>

	function getcount(val,val2,price,tax)
	{
	var cartcount=$(".cartcount"+val+val2).html();
	var newcount=parseInt(cartcount)+1;
	var subtotal=parseInt(newcount)*parseInt(price);
	var totaltax=parseInt(newcount)*parseInt(tax);
	$(".cartcount"+val+val2).html("");
	$(".cartcount"+val+val2).html(newcount);
	$(".ajaxsubtotal").html("");
	$(".cartcount").html(subtotal);
	$(".ajaxsubtax").html("");
	$(".ajaxsubtax").html(totaltax);
}
function getmincount(val,val2)
	{
	var cartcount=$(".cartcount"+val+val2).html();
	var newcount=parseInt(cartcount)-1;
	$(".cartcount"+val+val2).html("");
	$(".cartcount"+val+val2).html(newcount);
}

</script>
