<?php	
		
	namespace App\Http\Controllers\Superadmin;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\Common;
	use App\Models\User;
    use App\Models\Settings;
    use App\Models\Seller;	
	use App\Models\City;
	use App\Models\Offer;
	use App\Models\Maincategory;
	use App\Models\Category;
	use App\Models\Products;
	use App\Http\Requests\Offer\Addform;
	use DB;
		
	class SuperadminOffer extends Controller	
	{		
        protected $data = array();
        protected $page_details =array(
            'page_name'=> 'Offer',
            'page_auth'=> 'superadmin',
        );		
		/**  			
			* Contructor to aunthendicate user			
		*/		
		
		/**			
			* Display a listing of the resource.			
			*			
			* @return \Illuminate\Http\Response			
		*/		
				
		public function list(Request $request){			

            $this->data['offers'] = Offer::select('offer.*','city.city_name')->leftjoin('city','city.city_id','offer.city')->get();
            $this->data['message'] = 'No Offer Added';
           
            return view('superadmin.offer.manage', $this->data);  
		}		


		public function filter(Request $request){
			if($request->status == 'All'){
				$this->data['offers'] = Offer::select('offer.*','city.city_name')->leftjoin('city','city.city_id','offer.city')->get();
			}else{
           		$this->data['offers'] = Offer::select('offer.*','city.city_name')->leftjoin('city','city.city_id','offer.city')->where('offer.active',$request->status)->get();
			}
            $this->data['message'] = 'No Offer Added';
            return view('superadmin.offer.manage_ajax', $this->data);  

		}	
				
		public function form($id = NULL)		
		{			
			if($id){
				$this->data['offer'] = Offer::where('id',$id)->first();
				$this->data['action'] = "Edit";
			}else{
				$this->data['offer'] = new Offer;
				$this->data['action'] = "Add";
			}
			$this->data['cities'] = City::where('city_status',1)->get();
			$this->data['weeks'] = Offer::where('week')->get();
			$this->data['days'] = Offer::where('day')->get();
			$this->data['main_categories'] = Maincategory::where('mc_status',1)->get();
			$this->data['stores'] = Seller::where('sd_status',1)->get();
			$this->data['items'] = Products::where('product_status',1)->get();
			$this->data['sub_categories'] = Category::where('cat_is_parent_id','!=',NULL)->where('cat_status',1)->get();
			
			return view('superadmin.offer.addedit', $this->data); 		
		}		
				
		public function save(Request $request)		
		{			
			// dd($request->all());
			
			if($request->id){
				$offer = Offer::where('id',$request->id)->first();
				$maincategory_offer = DB::table('maincategory_offer')->where('offer_id',$request->id)->delete();
				$offer_products = DB::table('offer_products')->where('offer_id',$request->id)->delete();
				$offer_seller = DB::table('offer_seller')->where('offer_id',$request->id)->delete();
				$category_offer = DB::table('category_offer')->where('offer_id',$request->id)->delete();
			}else{
				$offer = new Offer;
			}

			$offer->city                = $request->city;
			$offer->coupon_code         = $request->coupon_code;
			$offer->subject             = $request->subject;
			$offer->coupon_name         = $request->coupon_name;
			$offer->details             = $request->details;
			$offer->type                = $request->type;
			$offer->value               = $request->value;
			$offer->coupon_for          = $request->coupon_for;
			$offer->loyalty_type        = $request->loyalty_type;
			$offer->loyalty             = $request->loyalty;
			$offer->total_customer_uses = $request->total_customer_uses;
			$offer->approve             = $request->approve;
			$offer->active              = $request->active;
			$offer->user_visible        = $request->user_visible;
			$offer->user_type           = $request->user_type;

			$offer->user_limit_per_day = $request->user_limit_per_day;
			if($request->user_limit_per_day == 'on'){
				$offer->user_limit = $request->user_limit;
			}else{
				$offer->user_limit = NULL;
			}
			$offer->apply_after_completion = $request->apply_after_completion;
			if($request->apply_after_completion == 'on'){
				$offer->apply_completion = $request->apply_completion;
			}else{
				$offer->apply_completion = NULL;
			}
			$offer->promo_uses = $request->promo_uses;
			if($request->promo_uses == 'on'){
				$offer->promo = $request->promo;
			}else{
				$offer->promo = NULL;
			}
			$offer->minimum_amount_limit = $request->minimum_amount_limit;
			if($request->minimum_amount_limit == 'on'){
				$offer->min_amount = $request->min_amount;
			}else{
				$offer->min_amount = NULL;
			}
			$offer->maximum_discount_limit = $request->maximum_discount_limit;
			if($request->maximum_discount_limit == 'on'){
				$offer->max_discount = $request->max_discount;
			}else{
				$offer->max_discount = NULL;
			}
			$offer->minimum_item_limit = $request->minimum_item_limit;
			if($request->minimum_item_limit == 'on'){
				$offer->min_limit = $request->min_limit;
			}else{
				$offer->min_limit = NULL;
			}
			$offer->coupon_order_order_value = $request->coupon_order_order_value;
			if($request->coupon_order_order_value == 'on'){
				$offer->coupon_order_value = $request->coupon_order_value;
			}else{
				$offer->coupon_order_value = NULL;
			}
			$offer->coupon_redeem = $request->coupon_redeem;
			if($request->coupon_redeem == 'on'){
				$offer->coupon_redeem_value = $request->coupon_redeem_value;
			}else{
				$offer->coupon_redeem_value = NULL;
			}

			$offer->admin_pay_amount = $request->admin_pay_amount;
			if($request->admin_pay_amount == 'on'){
				$offer->admin_pay_amount_value = $request->admin_pay_amount_value;
			}else{
				$offer->admin_pay_amount_value = NULL;
			}

			$offer->store_pay_amount = $request->store_pay_amount;
			if($request->store_pay_amount == 'on'){
				$offer->store_pay_amount_value = $request->store_pay_amount_value;
			}else{
				$offer->store_pay_amount_value = NULL;
			}

			$offer->date = $request->date;
			if($request->date == 'on'){
				$offer->start_date = $request->start_date;
				$offer->end_date = $request->end_date;
			}else{
				$offer->start_date = NULL;
				$offer->end_date = NULL;
			}

			$offer->recursion_type = $request->recursion_type;

			if($request->recursion_type == "monthly_recursion"){
				$offer->start_time     = $request->start_time;
				$offer->end_time       = $request->end_time;
				
				$weeks  = implode(',', $request->weeks);	
				$offer->week            = $weeks;	
				$days  = implode(',', $request->day);		
				$offer->day            = $days;
			}

			$image = $request->file('image');
			if(!empty($image)){
	            $offer->image = base64_encode(file_get_contents($image));
			}	

			$offer->save();

			$offer->main_categories()->sync($request->main_categories);
			$offer->sellers()->sync($request->sellers);
			$offer->products()->sync($request->products);
			$offer->sub_categories()->sync($request->sub_categories);

			return redirect('superadmin/offer');
			
		}	

		function action(Request $request)
	    {
	        $data = $request->all();

	        $query = $data['query'];

	        $this->data['filter_data'] = Maincategory::select('mc_name')
	                        ->where('mc_name', 'LIKE', '%'.$query.'%')
	                        ->get();

	        return response()->json($this->data);
	    }


	    public function search()
	    {
	    	$search_text  = $_GET['query'];
	    	$products = Maincategory::where('mc_name', 'LIKE', '%'.$search_text.'%')->get();


	    	return view('Superadmin/offer/search', compact('products'));
	    }

				
		public function deleteOffer(Request $request)		
		{			
			$user = Offer::find($request->delete_id);
			$user->delete();
			$maincategory_offer = DB::table('maincategory_offer')->where('offer_id',$request->delete_id)->delete();
			$offer_products = DB::table('offer_products')->where('offer_id',$request->delete_id)->delete();
			$offer_seller = DB::table('offer_seller')->where('offer_id',$request->delete_id)->delete();
			$category_offer = DB::table('category_offer')->where('offer_id',$request->delete_id)->delete();
			return redirect()->back()->with('success','Offer Deleted Successfully');	
		}

		public function inactiveData(Request $request){

			$change_status = Offer::where('id',$request->id)->first();
			$change_status->active = NULL;
			$change_status->save();
		}

		public function activeData(Request $request){
			
			$change_status = Offer::where('id',$request->id)->first();
			$change_status->active = "on";
			$change_status->save();
		}
		public function orderfilter(Request $request){

			if(($request->from_date != "") && ($request->to_date != "")){
				$finalfromdate=$request->from_date.' 00:00:00';
				$finaltodate=$request->to_date.' 23:59:59';
	  
				  $this->data['order_data'] = Order::select(
					  'orders.*','order_status.*',
					  'customer.name as customer',
					  'order_status.name as order_status_name',
					  'seller_details.sd_sname as store_name',
					  'add_tocart.created_at as created_time',
					  'users.first_name as delivery_boy_name',
	  
				  )
				  ->leftjoin('customer','customer.id','orders.customer_id')
				  ->leftjoin('add_tocart','add_tocart.id','orders.order_id')
				  ->leftjoin('seller_details','seller_details.sd_id','orders.store_id')
				  ->leftjoin('order_status','order_status.id','orders.order_status')
				  ->leftjoin('users','users.id','orders.delivery_man')
				  ->whereBetween('orders.created_at', [$finalfromdate, $finaltodate])
				  ->groupby('order_id')
				  ->get();

			}else{
				$finalfromdate=$request->from_date.' 00:00:00';
				$finaltodate=$request->to_date.' 23:59:59';
	  
				  $this->data['order_data'] = Order::select(
					  'orders.*','order_status.*',
					  'customer.name as customer',
					  'order_status.name as order_status_name',
					  'seller_details.sd_sname as store_name',
					  'add_tocart.created_at as created_time',
					  'users.first_name as delivery_boy_name',
	  
				  )
				  ->leftjoin('customer','customer.id','orders.customer_id')
				  ->leftjoin('add_tocart','add_tocart.id','orders.order_id')
				  ->leftjoin('seller_details','seller_details.sd_id','orders.store_id')
				  ->leftjoin('order_status','order_status.id','orders.order_status')
				  ->leftjoin('users','users.id','orders.delivery_man')
				 // ->whereBetween('orders.created_at', [$finalfromdate, $finaltodate])
				  ->groupby('order_id')
				  ->get();
			}



			$this->data['users'] = User::where('user_type',1)->get();

			$this->data['message'] = 'No Orders Available';
			$this->data['cancel_reasons'] = CancelReason::where('status',1)->get();

			return view('superadmin.orders.manage', $this->data);  
		}

	}	
