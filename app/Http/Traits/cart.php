<?php

namespace App\Http\Traits;
use Auth;
use App\Models\Addtocart;
use App\Models\Seller;
use App\Models\Products;
use App\Models\Maincategory;
use DB;
trait cart {
    protected function getcart() {
				$addtocart=array();
		if(Auth::id()!="")
		{
			
		$customer_id=Auth::id();
		$addtocart=Addtocart::where('customer_id','=',$customer_id)->groupBY('store_id')->get();
			
		return $addtocart;	
		}
    }

	protected function cartcount() {
		
		if(Auth::id()!="")
		{
			
		$customer_id=Auth::id(); 
		$count=Addtocart::where('customer_id','=',$customer_id)->where('payment_status','!=','1')->count();
			
		return $count;	
		}
    }
	
	protected function seller_list()
	{
		$seller=Seller::all();
			
		$seller_list=array();
		foreach($seller as $seller)
		{
			$seller_list[$seller->sd_usid]=$seller->sd_sname;
		}
		return $seller_list;
	}
	
	
	protected function maincategorylist()
	{
		$mainlist=Maincategory::all();
			
		return $mainlist;
	}
	
	protected function cart_product()
	{
		//$product_list=array();
		if(Auth::id()!="")
		{
			
		$customer_id=Auth::id(); 
		$cart_products=DB::select( DB::Raw("select product.*,add_tocart.store_id from product left join add_tocart on add_tocart.product_id = product.product_id where add_tocart.customer_id='".$customer_id."'"));
			
		
		return $cart_products;
		}
		
		
	}
	
	
}