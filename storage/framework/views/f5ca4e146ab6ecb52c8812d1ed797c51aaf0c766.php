<header>

<div class="container">
<div class="mblnav">
	<img id='menucls' src="<?php echo e(asset('public/web/images/mblnav.png')); ?>" alt="">
</div>
<div id="menu">
	<ul>
		<?php $__currentLoopData = $maincategorylist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mainlists): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<li><a href="store/<?php echo e($mainlists['mc_id']); ?>"><?php echo e($mainlists['mc_name']); ?></a></li>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</ul>
	<a class="prime" href="javascript:">GROVERY PRIME</a>
</div>
<div class="logo">
	<img src="<?php echo e(asset('public/web/images/logo.png')); ?>" alt="">
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
	<img src="<?php echo e(asset('public/web/images/offer.png')); ?>" alt="">
</div>
<div class="cart" style="margin-left: -70px;">	
	<span><?php echo e($cartcount); ?></span>
</div>
<?php if(Auth::id()!=""): ?>
<div class="cartview">
	<div class="deliver">
		<form>
		<label>Deliver to:</label>
			<select class="" id="">
				 <option value="">Ganapathy</option>
			</select>
		</form>
		<img class="cls" src="<?php echo e(asset('public/web/images/menucls.jpg')); ?>" alt="">
	</div>

<?php
$j=1;
$savedprice=0;
?>
<?php $__currentLoopData = $addtocart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addtocart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
$subtotal=0;
$subtax=0;
$allsubtotal=0;
$final=0;

?>
<div class="deliver">
<div class="storepack">
	<div class="storeimg"><img src="<?php echo e(asset('public/web/images/kannan.jpg')); ?>" alt=""></div>
	<p class="storename"><?php echo e($seller_list[$addtocart->store_id]); ?></p>
	<button onclick="window.location.href='<?php echo e(asset('/')); ?>'">ADD MORE</button>
	<div class="clear"></div>
</div>
</div>

<?php
$subtotal=0;
$subtax=0;
$final=0;
$i=1;
?>
<?php $__currentLoopData = $cart_product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart_products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($addtocart->store_id==$cart_products->store_id): ?>
<div class="deliver">
<div class="storepack">
	<div class="storeimg"><img src="<?php echo e(asset('public/admin/images/products')); ?>/<?php echo e($cart_products->main_image); ?>" alt=""></div>
	<div class="productdet">
	<?php
	$saveprice=$cart_products->product_price-$cart_products->product_sales_price;
	?>
	    <p><?php echo e($cart_products->product_name); ?></p>
		<strike>RS.<?php echo e($cart_products->product_price); ?></strike><span>RS.<?php echo e($cart_products->product_sales_price); ?></span>
		<label>You save Rs.<?php echo e($saveprice); ?></label>
		<div class="addcount">
		<span class="minus" onclick="getmincount(<?php echo e($i); ?>,<?php echo e($j); ?>)" style="cursor:pointer">-</span>
		<label class="cartcount<?php echo e($i); ?><?php echo e($j); ?>" >1</label>
		<span class="plus" onclick="getcount(<?php echo e($i); ?>,<?php echo e($j); ?>),<?php echo e($cart_products->product_sales_price); ?>,<?php echo e($cart_products->product_tax); ?>" style="cursor:pointer">+</span>
		</div>
	</div>
	<div class="addlist"><a href="javascript:">Add List</a></div>
	<div class="clear"></div>
</div>
</div>
<?php
$price=$cart_products->product_sales_price;
$subtotal +=$price;

$savedprice +=$saveprice;

$subtax +=$cart_products->product_tax;
$final=$subtotal+$subtax;

$i++;
?>

<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php

?>
<span><?php echo e($seller_list[$addtocart->store_id]); ?> store Subtotal</span> <label id="ajaxsubtotal">RS.<?php echo e($subtotal); ?></label><div class="clear"></div>
</div>
<div class="billdet">
<span>Taxes and charges</span> <label id="ajaxsubtax">RS.<?php echo e($subtax); ?></label><div class="clear"></div>
</div>
<!--<div class="billdet">
<span>Delivery charges</span> <label>RS.30.00</label><div class="clear"></div>
</div>-->
<div class="billdet borbot">
<span>To Pay</span> <label><strong id="ajaxfinal">RS.<?php echo e($final); ?></strong></label><div class="clear"></div>
</div>
</div>
<?php
$j++;
?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<p class="saveorder">You Saved RS.<?php echo e($savedprice); ?> on this order</p>
<div class="checkoutbtn"><a href="javascript:">PROCESSED TO CHECKOUT</a></div>
</div>
<?php endif; ?>
<div class="profile" style="margin-left: -70px;">
	<img src="<?php echo e(asset('public/web/images/profile.png')); ?>" alt="">
<div class="profileview">
<span class="arrow-up"></span>
<div class="proimg"><img src="<?php echo e(asset('public/web/images/proimg.jpg')); ?>" alt=""></div>
<p>Hello <span>
<?php if(Auth::id()!=""): ?>
<?php echo e(Auth::id()); ?>

<?php endif; ?>	

</span></p>
<div class="clear"></div>
<p class="prostrip">BANNER FOR GROVERY PRIME MEMBERSHIP</p>
<div class="promenu">
<ul>
<li><a href="javascript:">User profile</a></li>
<li><a href="<?php echo e(route('customerAddress')); ?>">Address</a></li>
<li><a href="javascript:">Order history</a></li>
<li><a href="javascript:">Reorder</a></li>
<li><a href="<?php echo e(route('addToListView')); ?>">Add list</a></li>
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
<?php /**PATH D:\XAMPP\htdocs\Laravel\backendGrovery\resources\views/common/web/header.blade.php ENDPATH**/ ?>