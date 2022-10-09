<?php

	namespace App\Http\Controllers\Api;

	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;
    use App\Models\Common;
	use App\Models\Customer;
	use App\Models\Maincategory;
	use App\Models\Category;
	use App\Models\Seller;
	use App\Models\Products;
	use App\Models\Banner;
	use App\Models\AreaBanner;
	use App\Models\Offer;
	use App\Models\StoreSettings;
	use App\Models\Review;
  	use App\Models\ProductReview;
  	use App\Models\Pages;
  	use App\Models\Faq;
  	use App\Models\ProductQuantity;
  	use App\Models\Upload;
  	use App\Models\Plan;
  	use App\Models\Tag;
  	use App\Models\Addtocart;
	use Auth;
	use DB;

	class CartController extends Controller
	{

       //Main Categories

	   public function maincategory()
	   {
		   $maincategorylists=Maincategory::where('mc_status',1)->get();
		   $finalarray=array();
		   foreach($maincategorylists as $maincategorylist){
			$sellercountcheck=Seller::where('main_category',$maincategorylist->mc_id)->where('sd_status',1)->count();
			if($sellercountcheck > 0){
				array_push($finalarray,$maincategorylist);
			}
		   }
		   $banners = Banner::all();
		   return response()->json([
		   	'status' => true,
		   	'maincategory'=>$finalarray,
			'banners'=>$banners,
			'message'=>'maincategory banners List'
		   ]);
	   }



	   public function store_search($sd_sname)
	   	{
	   		return Seller::where("sd_sname","like","%".$sd_sname."%")->get();
	   	}

	   	public function main_category_search($mc_name)
	   	{
	   		return Maincategory::where("mc_name","like","%".$mc_name."%")
	   		->where("mc_status","=","1")->get();
	   	}

	   	public function product_search($product_name)
	   	{
	   		return Products::where("product_name","like","%".$product_name."%")->get();
	   	}

	   	public function product_store_search($sd_sname)
	   	{
	   		return Products::where("sd_sname","like","%".$sd_sname."%")
	   		->select('product.*','seller_details.*')
	   		->leftjoin('seller_details','seller_details.sd_usid','product.seller_id')
	   		->get();
	   	}


	   // Stores Under Main Category


	   public function store(Request $request)
	   {

		   $main_id= $request->main_id;
		   $stores = Seller::where('main_category','=',$main_id)->get();

		   $data = [];


			   foreach ($stores as $value) {
				   	 $store_review_count=Review::where('store_id',$value->sd_usid)->count();
				     $ratingnullcheck=Review::where('store_id',$value->sd_usid)->avg('rating');
					 if($ratingnullcheck != null){
						$store_review_average=round(Review::where('store_id',$value->sd_usid)->avg('rating'));
					 }else{
						$store_review_average=0;
					 }

			   		$seller_data = [
			   			"sd_id" => $value->sd_id,
			            "sd_usid" => $value->sd_usid,
			            "sd_sname" => $value->sd_sname,
			            "main_category" => $value->main_category,
			            "sd_snumber" => $value->sd_snumber,
			            "sd_sadminshare" => $value->sd_sadminshare,
			            "sd_scityid" => $value->sd_scityid,
			            "sd_sdeliverykm" => $value->sd_sdeliverykm,
			            "sd_spincode" => $value->sd_spincode,
			            "sd_address" => $value->sd_address,
			            "store_image" => $value->store_image,
			            "store_logo" => $value->store_logo,
			            "sd_status" => $value->sd_status,
			            "tag" => $value->tag,
			            "created_by" => $value->created_by,
			            "updated_by" => $value->updated_by,
						"store_review_count"=> $store_review_count,
						"store_review_average"=>$store_review_average,
			   		];

			   		$data[] = $seller_data;
			   }
			   if($data != NULL)
	            {
				   $area_banners = AreaBanner::all();
					   return response()->json([
					  	'status' => true,
					   	'store'=> $data,
						'area_banners'=>$area_banners
					   ]);
				}
				elseif($data == NULL) {

					$area_banners = AreaBanner::all();
	                return response()->json([
	                    'status' => false,
	                    'message' => 'Store is not available',
	                    'area_banners'=>$area_banners
	                ]);
	            }

	   }



	   // Stores List with 2 Products under Main Category (Store Items)



		public function storeProducts(Request $request){

			$main_id= $request->main_id;

		   	$seller = Seller::where('main_category',$main_id)->get();

		   	$result = [];

		   	foreach ($seller as $data) {
		   		$store = Seller::where('sd_usid',$data->sd_usid)->first();
		   		$products = Products::where('seller_id',$store->sd_usid)->take(2)->get();
				  // $data["store_review_count"]=Review::where('store_id',$store->sd_usid)->count();
				    //$ratingnullcheck=Review::where('store_id',$store->sd_usid)->avg('rating');
					///if($ratingnullcheck != null){
						//$data["store_review_average"]=round(Review::where('store_id',$store->sd_usid)->avg('rating'));
					//}else{
					//	$data["store_review_average"]=0;
					//}

		   		$new_product = [];
		   		foreach ($products as $key => $data) {

		   			$product_quantity = ProductQuantity::where('product_id',$data->product_id)->first();
		   			$new_product[] = [
						'product_id' => $data['product_id'],
						'product_name' => $data['product_name'],
						'main_image' => $data['main_image'],
						'product_tax' => $data['product_tax'],
						'measurement' => $product_quantity['measurement'],
						'product_price' => $product_quantity['price'],
						'product_offer' => $product_quantity['offer'],
						'product_sales_price' => $product_quantity['sales_price'],
						'product_quantity_id' => $product_quantity['id'],
					];
		   		}

		   		$seller1 = [
		   			"sd_id" => $store->sd_id,
	                "sd_usid" => $store->sd_usid,
	                "sd_sname" => $store->sd_sname,
	                "main_category" => $store->main_category,
	                "sd_snumber" => $store->sd_snumber,
	                "sd_sadminshare" => $store->sd_sadminshare,
	                "sd_scityid" => $store->sd_scityid,
	                "sd_sdeliverykm" => $store->sd_sdeliverykm,
	                "sd_spincode" => $store->sd_spincode,
	                "sd_address" => $store->sd_address,
	                "store_image" => $store->store_image,
	                "store_logo" => $store->store_logo,
	                "products" => $new_product
		   		];

		   		$result[] = $seller1;
		   	}

		   	if($result != NULL)
		   	{
			   	return response()->json([
			  		'status' => true,
			  		'stores' => $seller,
			   		'data' => $result,

			    ]);
		   }
		   elseif($result == NULL) {

                return response()->json([
                    'status' => false,
                    'message' => 'Store is not available',
                ]);
            }

		}

		// Store's Categories and Subcategories

		public function list(Request $request)
		{
			$sid = $request->sid;

			$seller_details = Seller::where('sd_usid',$sid)->first();

			$categories = Products::select('category.cat_id','category.cat_name')->leftjoin('category','category.cat_id','product.product_category_id')->where('seller_id',$sid)->groupBy('category.cat_id')->get();

			$result = [];
		   	foreach ($categories as $data) {

		   		$category = Category::where('cat_id',$data->cat_id)->first();
		   		$subcategories = Products::select(
						   			'category.cat_id',
						   			'category.cat_name',
						   			'category.cat_is_parent_id',
						   			'category.cat_image'
						   		)
		   						->leftjoin('category','category.cat_is_parent_id','product.product_category_id')
		   						->where('product.seller_id',$sid)
		   						->where('category.cat_is_parent_id',$category->cat_id)
		   						->groupBy('category.cat_id')
		   						->get();

		   		$category = [
		   			'id' => $category->cat_id,
		   			'cat_name' => $category->cat_name,
		   			'cat_image' => $category->cat_image,
		   			'subcategory' => $subcategories
		   		];

		   		$result[] = $category;
		   	}

		   	if($result != NULL)
		   	{
			   	return response()->json([
					'status'=>true,
					'seller'=>$seller_details,
					'category'=>$result
				]);
		   }
		   elseif($result == NULL) {

                return response()->json([
                    'status' => false,
                    'message' => 'Details is not available',
                ]);
            }



		}

		// Store's Reviews by Customer

		public function storeReview(Request $request){

			$sid = $request->sid;

			$count = Review::where('reviews.store_id',$sid)->where('reviews.status',1)->count();

			if($count == 0){
				return response()->json([
                    'status'=>false,
                    'message'=>'No reviews found'
                ]);
			}else{
				$review = Review::select('reviews.*','customer.*')->leftjoin('customer','customer.id','reviews.customer_id')->where('reviews.store_id',$sid)->where('reviews.status',1)->orderBy('reviews.id', 'desc')->get();
								foreach($review as $reviewlist){
					$reviewlist['created_at']=date('d/m/Y H:i a',strtotime($reviewlist['created_at']));
				}
				return response()->json([
		  			'status' => true,
		   			'review' => $review
		    	]);
			}
		}

		//Store's Information (Address & Shop TImings)

		public function shopInformation(Request $request){

			$seller_id = $request->sid;

			$seller = Seller::where('sd_usid',$seller_id)->first();

			$shop_timing = StoreSettings::select('opening_day')->where('seller_id',$seller_id)->first();

			$days = explode(',', $shop_timing->opening_day);

			$result = [];

			foreach ($days as $value) {

				$timing = StoreSettings::where('seller_id',$seller_id)->first();

				$data = [

					'opening_day' => $value,
					'opening_time' => $timing->opening_time,
					'closing_time' => $timing->closing_time,

				];

				$result[] = $data;
			}

			return response()->json([
		  		'status' => true,
		   		'seller' => $seller,
		   		'shop_timing' => $result
		    ]);
		}

		// Store's Categories, Subcategories & Products with Offers

		public function offers(Request $request)
		{
			$sid=$request->sid;

			$categories = Products::select('category.cat_id','category.cat_name')->leftjoin('product_quantity','product_quantity.product_id','product.product_id')->leftjoin('category','category.cat_id','product.product_category_id')->where('product_quantity.offer','!=',null)->where('seller_id',$sid)->groupBy('category.cat_id')->get();

			$subcategory = Products::select(
								'category.*'
							)
							->leftjoin('product_quantity','product_quantity.product_id','product.product_id')
							->leftjoin('category','category.cat_id','product.sub_category_id')
							->where('category.cat_is_parent_id','!=',null)
							->where('product_quantity.offer','!=',null)
							->where('seller_id',$sid)
							->groupBy('category.cat_id')
							->get();

			$products = Products::select(
				'product.product_id',
				'product.product_name',
				'product.main_image',
				'product.product_tax'
			)
				->where('product.product_status',1)
				->where('product.seller_id','=',$sid)
				->where('product_quantity.offer','!=',null)
				->leftjoin('category','category.cat_id','=','product.product_category_id')
				->leftjoin('product_quantity','product_quantity.product_id','=','product.product_id')
				->get();

				$new_product = [];
				foreach ($products as $key => $data) {
					$product_quantity = ProductQuantity::where('product_id',$data->product_id)->first();
$twoFloatValue=number_format($product_quantity['offer'],2);

					$new_product[] = [
						'product_id' => $data['product_id'],
						'product_name' => $data['name'],
						'main_image' => $data['main_image'],
						'product_tax' => $data['product_tax'],
						'product_price' => $product_quantity['price'],
						'product_offer' => $twoFloatValue,
						'product_sales_price' => $product_quantity['sales_price'],
					];
				}

			return response()->json([
				'status'=>true,
				'category'=>$categories,
				'subcategory'=>$subcategory,
				'products'=>$new_product
			]);
		}


		// Product Detailed View

		public function productView(Request $request){

			$product_id = $request->product_id;

			$count = Products::where('product_id',$product_id)->where('product_status',1)->count();
			if($count == 0){
				return response()->json([
                    'status'=>false,
                    'message'=>'Product Does not Exist'
                ]);
			}else{
				$product = Products::where('product_id',$product_id)->where('product_status',1)->first();
				$product_quantity = ProductQuantity::select('id as product_quantity_id','product_id','measurement','price','offer','sales_price')->where('product_id',$product_id)->get();
				$uploads = Upload::where('product_id',$product_id)->get();
				$product_reviews = ProductReview::select('customer.name','product_reviews.review','product_reviews.rating')->leftjoin('customer','customer.id','product_reviews.customer_id')->where('product_reviews.product_id',$product_id)->where('product_reviews.status',1)->get();
				$related_products = Products::where('product_category_id',$product->product_category_id)->where('product_id','!=',$product_id)->get();

				$recent_search = [];
				foreach ($related_products as $value) {

					$recent_product_quantity = ProductQuantity::where('product_id',$value->product_id)->first();

					$recent_search[] = [
						'product_id' => $value['product_id'],
						'product_name' => $value['name'],
						'main_image' => $value['main_image'],
						'product_tax' => $value['product_tax'],
						'product_price' => $recent_product_quantity['price'],
						'product_offer' => $recent_product_quantity['offer'],
						'product_sales_price' => $recent_product_quantity['sales_price'],
					];
				}

				return response()->json([
			  		'status' => true,
			   		'product' => $product,
			   		'product_details' => $product_quantity,
			   		'uploads' => $uploads,
			   		'product_reviews' => $product_reviews,
			   		'related_products' => $recent_search
		    	]);

			}
		}

		// Today Coupons

		public function coupon(Request $request){

			$count = offer::count();

			if($count == 0){
				return response()->json([
                    'status'=>false,
                    'message'=>'no coupon'
                ]);
			}else{
				$coupon = offer::all();

				return response()->json([
		  		'status' => true,
		   		'coupon' => $coupon
		    ]);
			}


		}

		// Pages (Privacy Policy, Terms and Conditions, About Us, Refund Policy)

		public function pages(Request $request){

			$page_type = $request->page_type;

			$count = Pages::where('page_type',$page_type)->count();

			if($count == 0){
				return response()->json([
                    'status'=>false,
                    'message'=>'Page does not exist'
                ]);
			}else{
				$pages = Pages::where('page_type',$page_type)->get();

				if($page_type == '1'){
					$message = "About Us";
				}else if($page_type == '2'){
					$message = "Privacy Policy";
				}else if($page_type == '3'){
					$message = "Terms And Conditions";
				}else if($page_type == '4'){
					$message = "Return Policy";
				}

				return response()->json([
					'status'=>true,
					'data'=>$pages,
					'message'=>$message
				]);
			}
		}

		// Faq

		public function faq(Request $request){

			$type = $request->type;

			$count = Faq::where('type',$type)->count();

			if($count == 0){
				return response()->json([
                    'status'=>false,
                    'message'=>'FAQ does not exist'
                ]);
			}else{
				$faq = Faq::where('type',$type)->get();

				if($type == '1'){
					$message = "Seller";
				}else if($type == '2'){
					$message = "Customer";
				}else if($type == '3'){
					$message = "Membership";
				}

				return response()->json([
					'status'=>true,
					'data'=>$faq,
					'message'=>$message
				]);
			}
		}

		//Membership Plans


		public function membership(Request $request){

			$plans_count = Plan::count();

			if($plans_count == 0){
				return response()->json([
                    'status'=>false,
                    'message'=>'No Plans Available'
                ]);
			}else{

				$plans = Plan::get();

				$membership_faq = Faq::where('type',3)->get();


				return response()->json([
					'status'=>true,
					'plans'=>$plans,
					'faq'=>$membership_faq
				]);
			}
		}

		public function search(Request $request){

			$search = $request->search;

			$sellercount = Seller::where('sd_status',1)->count();
			$productcount = Products::where('product_status',1)->count();

			if($sellercount == 0 && $productcount == 0){
				return response()->json([
					'status'=>false,
					'message'=>'No data found'
				]);
			}else{
				$searchsellercount = Seller::where('sd_sname', 'like', '%' . $search . '%')->where('sd_status',1)->count();
				$searchproductcount = Products::where('product_name', 'like', '%' . $search . '%')->where('product_status',1)->count();

				if($searchsellercount != 0){
					if($search != ''){
						$stores = Seller::where('sd_sname', 'like', '%' . $search . '%')->where('sd_status',1)->get();
					}else{
						$stores = Seller::get();
					}
					return response()->json([
						'status'=>true,
						'data'=>$stores,
						'message'=>'Stores List'
					]);
				}
				else if($searchproductcount !=0){
					if($search != ''){
						$product = Products::select('product.*','product_quantity.*')->leftjoin('product_quantity','product_quantity.product_id','product.product_id')->where('product.product_status',1)->where('product.product_name', 'like', '%' . $search . '%')->get();
					}else{
						$stores = Seller::get();
					}
					return response()->json([
						'status'=>true,
						'data'=>$product,
						'message'=>'Product List'
					]);
				}
			}
		}

		public function subcategories(Request $request){

			$sid=$request->sid;
			$catid=$request->catid;

			$subcategory=DB::select( DB::Raw("select category.cat_is_parent_id,category.cat_id,category.cat_image,category.cat_name from category left join product on product.sub_category_id = category.cat_id where `cat_is_parent_id` is not null and product.seller_id = '".$sid."' and product.product_category_id = '".$catid."' group by product.sub_category_id,category.cat_id,category.cat_is_parent_id,category.cat_name,category.cat_image"));

			$products = Products::select(
				'product.product_id',
				'product.product_name',
				'product.main_image',
				'product.product_tax'
			)
				->where('product.product_status',1)
				->where('product.seller_id','=',$sid)
				->where('product.product_category_id','=',$catid)
				->leftjoin('category','category.cat_id','=','product.product_category_id')
				->leftjoin('measurement','measurement.id','=','product.measurement_id')
				->get();

				$new_product = [];
				foreach ($products as $key => $data) {
					$product_quantity = ProductQuantity::where('product_id',$data->product_id)->first();

					$new_product[] = [
						'product_id' => $data['product_id'],
						'product_name' => $data['name'],
						'main_image' => $data['main_image'],
						'product_tax' => $data['product_tax'],
						'product_price' => $product_quantity['price'],
						'product_sales_price' => $product_quantity['sales_price'],
					];
				}

				if($new_product != NULL)
			   	{
				   	return response()->json([
						'status'=>true,
						'subcategory'=>$subcategory,
						'products'=>$new_product
					]);
			   }
			   elseif($new_product == NULL) {

	                return response()->json([
	                    'status' => false,
	                    'message' => 'Details not available',
	                ]);
	            }

		}


		public function products(Request $request){

			$sid=$request->sid;
			$catid = $request->catid;
			$subid = $request->subid;


			$products = Products::select(
				'product.product_id',
				'product.product_name',
				'product.main_image',
				'product.product_tax'
			)
				->where('product.product_status',1)
				->where('product.seller_id','=',$sid)
				->where('product.product_category_id','=',$catid)
				->where('product.sub_category_id','=',$subid)
				->leftjoin('category','category.cat_id','=','product.product_category_id')
				->leftjoin('measurement','measurement.id','=','product.measurement_id')
				->get();

				$new_product = [];
				foreach ($products as $key => $data) {
					$product_quantity = ProductQuantity::where('product_id',$data->product_id)->first();

					$new_product[] = [
						'product_id' => $data['product_id'],
						'product_name' => $data['name'],
						'main_image' => $data['main_image'],
						'product_tax' => $data['product_tax'],
						'product_price' => $product_quantity['price'],
						'product_sales_price' => $product_quantity['sales_price'],
					];
				}

				if($new_product != NULL)
			   	{
				   	return response()->json([
				   		'status' => true,
						'products' => $new_product
				   ]);
			   }
			   elseif($new_product == NULL) {

	                return response()->json([
	                    'status' => false,
	                    'message' => 'Details not available',
	                ]);
	            }

		}


		public function offerSubcategories(Request $request){

			$sid=$request->sid;
			$catid=$request->catid;

			$subcategory = Products::select(
								'category.*'
							)
							->leftjoin('product_quantity','product_quantity.product_id','product.product_id')
							->leftjoin('category','category.cat_id','product.sub_category_id')
							->where('category.cat_is_parent_id','!=',null)
							->where('product_quantity.offer','!=',null)
							->where('product.seller_id',$sid)
							->where('product.product_category_id',$catid)
							->groupBy('category.cat_id')
							->get();


			$products = Products::select(
				'product.product_id',
				'product.product_name',
				'product.main_image',
				'product.product_tax'
			)
				->where('product.product_status',1)
				->where('product.seller_id','=',$sid)
				->where('product.product_category_id','=',$catid)
				->where('product_quantity.offer','!=',NULL)
				->leftjoin('category','category.cat_id','=','product.product_category_id')
				->leftjoin('measurement','measurement.id','=','product.measurement_id')
				->leftjoin('product_quantity','product_quantity.product_id','product.product_id')
				->get();

				$new_product = [];
				foreach ($products as $key => $data) {
					$product_quantity = ProductQuantity::where('product_id',$data->product_id)->first();

					$new_product[] = [
						'product_id' => $data['product_id'],
						'product_name' => $data['name'],
						'main_image' => $data['main_image'],
						'product_tax' => $data['product_tax'],
						'product_price' => $product_quantity['price'],
						'product_offer' => $product_quantity['offer'],
						'product_sales_price' => $product_quantity['sales_price'],
					];
				}

				if($new_product != NULL)
			   	{
				   	return response()->json([
						'status'=>true,
						'subcategory'=>$subcategory,
						'products'=>$new_product
					]);
			   }
			   elseif($new_product == NULL) {

	                return response()->json([
	                    'status' => false,
	                    'message' => 'Details not available',
	                ]);
	            }

		}

		public function offerProducts(Request $request){

			$sid=$request->sid;
			$catid = $request->catid;
			$subid = $request->subid;


			$products = Products::select(
				'product.product_id',
				'product.product_name',
				'product.main_image',
				'product.product_tax'
			)
				->where('product.product_status',1)
				->where('product.seller_id','=',$sid)
				->where('product.product_category_id','=',$catid)
				->where('product.sub_category_id','=',$subid)
				->where('product_quantity.offer','!=',NULL)
				->leftjoin('category','category.cat_id','=','product.product_category_id')
				->leftjoin('measurement','measurement.id','=','product.measurement_id')
				->leftjoin('product_quantity','product_quantity.product_id','product.product_id')
				->get();


				$new_product = [];
				foreach ($products as $key => $data) {
					$product_quantity = ProductQuantity::where('product_id',$data->product_id)->first();

					$new_product[] = [
						'product_id' => $data['product_id'],
						'product_name' => $data['name'],
						'main_image' => $data['main_image'],
						'product_tax' => $data['product_tax'],
						'product_price' => $product_quantity['price'],
						'product_offer' => $product_quantity['offer'],
						'product_sales_price' => $product_quantity['sales_price'],
					];
				}

			return response()->json([
		   		'status' => true,
				'products' => $new_product
		   ]);

		}


		//Store Sub Categories and Sub Sub Categories

		public function get_subsubcategories(Request $request)
		{
			$subid = $request->subid;

			$subcategories = Category::where('cat_is_parent_id','!=',Null)->where('cat_id',$subid)->get();

			$result = [];
		   	foreach ($subcategories as $data) {

		   		$subsubcategories = Products::select(
						   			'sub_sub_categories.id',
						   			'sub_sub_categories.name',
						   			'sub_sub_categories.sub_category_id',
						   			'sub_sub_categories.image'
						   		)
		   						->leftjoin('sub_sub_categories','sub_sub_categories.id','product.sub_sub_category_id')
		   						->where('sub_sub_categories.sub_category_id',$data->cat_id)
		   						->groupBy('sub_sub_categories.id')
		   						->get();

		   		$subcategory = [
		   			'id' => $data->cat_id,
		   			'cat_name' => $data->cat_name,
		   			'cat_image' => $data->cat_image,
		   			'subsubcategory' => $subsubcategories
		   		];

		   		$result[] = $subcategory;
		   	}

		   	if($result != NULL)
		   	{
			   	return response()->json([
					'status'=>true,
					'category'=>$result
				]);
		    }
		    elseif($result == NULL) {

                return response()->json([
                    'status' => false,
                    'message' => 'Details not available',
                ]);
            }


		}


		// First Category, Sub Category, Sub Sub Categories and Products


		public function storeCategoriesFirstData(Request $request){

			$sid=$request->sid;
            $subsubcategory=[];
			$categories_count = Products::select(
				'category.cat_id',
				'category.cat_name',
				DB::raw('count(product.product_category_id) as category_count')
			)->where('product.product_status',1)
			->where('product.seller_id','=',$sid)
			->leftjoin('category','category.cat_id','=','product.product_category_id')
			->groupBy('product.product_category_id')
			->get();

			$category = Products::select('category.cat_id','category.cat_name')->where('product.product_status',1)->where('product.seller_id','=',$sid)->leftjoin('category','category.cat_id','=','product.product_category_id')->first();

			$subcategories = Products::select(
					'category.cat_id',
					'category.cat_name',
					'category.cat_image'
				)
				->leftjoin('category','category.cat_id','=','product.sub_category_id')
				->where('product.product_status',1)
				->where('product.seller_id','=',$sid)
				->where('category.cat_is_parent_id',$category->cat_id)
				->groupBy('product.sub_category_id')
				->get();
			//	echo "<pre>";
			//	print_r($subcategories);
			//	exit;
			//	$subsubcategory=[];
			$result = [];
			$subsubcategories=[];
			foreach ($subcategories as $data) {
			     unset($subsubcategories);
				$subsubcategories = Products::select(
						   			'sub_sub_categories.id',
						   			'sub_sub_categories.name',
						   			'sub_sub_categories.image'
						   		)
		   						->leftjoin('sub_sub_categories','sub_sub_categories.id','product.sub_sub_category_id')
		   						->where('sub_sub_categories.sub_category_id',$data->cat_id)
		   						->where('product.seller_id','=',$sid)
		   						->where('product.product_status',1)
		   						->where('product.sub_sub_category_id','!=', NULL)
		   						->groupBy('sub_sub_categories.id')
		   						->get();
					//	if(count($subsubcategories) > 0){
						//	$subsubcategory=[];
							    unset($subsubcategory);
							$subsubcategory = array();
						foreach ($subsubcategories as $value) {

								$products = Products::select(
								'product.product_id',
								'product.product_name',
								'product.main_image',
								'product.product_tax'
							)
							->where('product.product_status',1)
							->where('product.seller_id','=',$sid)
							->where('product.sub_sub_category_id', $value->id)
							->get();

							$new_product = [];
							foreach ($products as $key => $product) {
								$product_quantity = ProductQuantity::where('product_id',$product->product_id)->first();
								if($product_quantity){
									$new_product[] = [
										'product_id' => $product['product_id'],
										'product_name' => $product['name'],
										'main_image' => $product['main_image'],
										'product_tax' => $product['product_tax'],
										'product_price' => $product_quantity['price'],
										'product_offer' => $product_quantity['offer'],
										'product_sales_price' => $product_quantity['sales_price'],
									];

								}

							}

							$subsubcategory[] = [
								'id' => $value->id,
								'name' => $value->name,
								'image' => $value->image,
								'products' => $new_product
							];


						}
				//	}


							$subcategory = [
								'cat_id' => $data->cat_id,
								'cat_name' => $data->cat_name,
								'cat_image' => $data->cat_image,
								'subsubcategories' => $subsubcategory ? $subsubcategory : []
							];

							$result[] = $subcategory;
							$subcategory=[];

					/*	}else{
							$result=[];
						}*/






			}

			return response()->json([
				'status'=>true,
				'categories_count'=>$categories_count,
				'category'=>$category,
				'subcategory'=>$result
			]);

		}

		// Store's Categories, Subcategories, SubSubCategories & Products

		public function storeCategories(Request $request){

			$cat_id = $request->cat_id;
			$sid = $request->sid;
            $result = [];
			$categories_count = Products::select(
				'category.cat_id',
				'category.cat_name',
				DB::raw('count(product.product_category_id) as category_count')
			)->where('product.product_status',1)
			->where('product.seller_id','=',$sid)
			->leftjoin('category','category.cat_id','=','product.product_category_id')
			->groupBy('product.product_category_id')
			->get();

			$categories = Products::select('category.cat_id','category.cat_name')->where('product.product_status',1)->where('product.seller_id','=',$sid)->where('product.product_category_id',$cat_id)->leftjoin('category','category.cat_id','=','product.product_category_id')->groupBy('product.product_category_id')->get();

			$result1 = [];

			foreach ($categories as $key => $category) {

				$subcategories = Products::select(
					'category.cat_id',
					'category.cat_name',
					'category.cat_image'
				)
				->leftjoin('category','category.cat_id','=','product.sub_category_id')
				->where('product.product_status',1)
				->where('product.seller_id','=',$sid)
				->where('category.cat_is_parent_id',$cat_id)
				->groupBy('product.sub_category_id')
				->get();

			//	$result = [];
				foreach ($subcategories as $data) {
					$subsubcategories = Products::select(
							   			'sub_sub_categories.id',
							   			'sub_sub_categories.name',
							   			'sub_sub_categories.image'
							   		)
			   						->leftjoin('sub_sub_categories','sub_sub_categories.id','product.sub_sub_category_id')
			   						->where('sub_sub_categories.sub_category_id',$data->cat_id)
			   						->where('product.seller_id','=',$sid)
			   						->where('product.product_status',1)
			   						->where('product.sub_sub_category_id','!=', NULL)
			   						->groupBy('sub_sub_categories.id')
			   						->get();

			   		foreach ($subsubcategories as $value) {

			   			$products = Products::select(
							'product.product_id',
							'product.product_name',
							'product.main_image',
							'product.product_tax'
						)
						->where('product.product_status',1)
						->where('product.seller_id','=',$sid)
						->where('product.sub_sub_category_id', $value->id)
						->get();

						$new_product = [];
						foreach ($products as $key => $product) {
							$product_quantity = ProductQuantity::where('product_id',$product->product_id)->first();

							$new_product[] = [
								'product_id' => $product['product_id'],
								'product_name' => $product['product_name'],
								'main_image' => $product['main_image'],
								'product_tax' => $product['product_tax'],
								'product_price' => $product_quantity['price'],
								'product_offer' => $product_quantity['offer'],
								'product_sales_price' => $product_quantity['sales_price'],
							];
						}

						$subsubcategory[] = [
							'id' => $value->id,
							'name' => $value->name,
							'image' => $value->image,
							'products' => $new_product
						];
			   		}

			   		$subcategory = [
			   			'cat_id' => $data->cat_id,
			   			'cat_name' => $data->cat_name,
			   			'cat_image' => $data->cat_image,
			   			'subsubcategories' => $subsubcategory
			   		];

			   		$result[] = $subcategory;
				}

				$category_data = [
					'category_id' => $category->cat_id,
					'category_name' => $category->cat_name,
					'subcategory' => $result
				];

				$result1[] = $category_data;


			}

							$data = [
					'cat_id' => NULL,
			   		'cat_name' => NULL,
				];


			return response()->json([
				'status'=>true,
				'categories_count'=>$categories_count,
				'category'=> $data,
				'subcategory'=>$result,
			]);

		}

		// Store's Subcategories, SubSubCategories & Products

		public function storeSubCategories(Request $request){

			$sub_id = $request->sub_id;
			$sid = $request->sid;
            $subsubcategory=[];
			$categories_count = Products::select(
				'category.cat_id',
				'category.cat_name',
				DB::raw('count(product.product_category_id) as category_count')
			)->where('product.product_status',1)
			->where('product.seller_id','=',$sid)
			->leftjoin('category','category.cat_id','=','product.product_category_id')
			->groupBy('product.product_category_id')
			->get();

			$subcategories = Products::select(
				'category.cat_id',
				'category.cat_name',
				'category.cat_image',
			)
			->leftjoin('category','category.cat_id','=','product.sub_category_id')
			->where('product.product_status',1)
			->where('product.seller_id','=',$sid)
			->where('category.cat_is_parent_id','!=', NULL)
			->where('category.cat_id', $sub_id)
			->groupBy('product.sub_category_id')
			->get();

			$result = [];
			foreach ($subcategories as $data) {
				$subsubcategories = Products::select(
						   			'sub_sub_categories.id',
						   			'sub_sub_categories.name',
						   			'sub_sub_categories.image'
						   		)
		   						->leftjoin('sub_sub_categories','sub_sub_categories.id','product.sub_sub_category_id')
		   						->where('sub_sub_categories.sub_category_id',$data->cat_id)
		   						->where('product.seller_id','=',$sid)
		   						->where('product.product_status',1)
		   						->where('product.sub_sub_category_id','!=', NULL)
		   						->groupBy('sub_sub_categories.id')
		   						->get();

		   		foreach ($subsubcategories as $value) {

		   			$products = Products::select(
						'product.product_id',
						'product.product_name',
						'product.main_image',
						'product.product_tax'
					)
					->where('product.product_status',1)
					->where('product.seller_id','=',$sid)
					->where('product.sub_sub_category_id', $value->id)
					->get();

					$new_product = [];
					foreach ($products as $key => $product) {
						$product_quantity = ProductQuantity::where('product_id',$product->product_id)->first();

						if($product_quantity){
							$new_product[] = [
								'product_id' => $product['product_id'],
								'product_name' => $product['product_name'],
								'main_image' => $product['main_image'],
								'product_tax' => $product['product_tax'],
								'product_price' => $product_quantity['price'],
								'product_offer' => $product_quantity['offer'],
								'product_sales_price' => $product_quantity['sales_price'],
							];

						}
					}

					$subsubcategory[] = [
						'id' => $value->id,
						'name' => $value->name,
						'image' => $value->image,
						'products' => $new_product
					];
		   		}

		   		$subcategory = [
		   			'cat_id' => $data->cat_id,
		   			'cat_name' => $data->cat_name,
		   			'cat_image' => $data->cat_image,
		   			'subsubcategories' => $subsubcategory
		   		];

		   		$result[] = $subcategory;

		   		$data = [
					'cat_id' => NULL,
			   		'cat_name' => NULL,
				];

			}

			return response()->json([
				'status'=>true,
				'categories_count'=>$categories_count,
				// 'category'=>$data,
				'sub_category'=>$result
			]);

		}


		// Store's SubSubCategories & Products

		public function storeSubSubCategories(Request $request){

			$sub_sub_id = $request->sub_sub_id;
			$sid = $request->sid;


			$categories_count = Products::select(
				'category.cat_id',
				'category.cat_name',
				DB::raw('count(product.product_category_id) as category_count')
			)->where('product.product_status',1)
			->where('product.seller_id','=',$sid)
			->leftjoin('category','category.cat_id','=','product.product_category_id')
			->groupBy('product.product_category_id')
			->get();

			$subsubcategories = Products::select(
					   			'sub_sub_categories.id',
					   			'sub_sub_categories.name',
					   			'sub_sub_categories.image'
					   		)
	   						->leftjoin('sub_sub_categories','sub_sub_categories.id','product.sub_sub_category_id')
	   						->where('sub_sub_categories.id',$sub_sub_id)
	   						->where('product.seller_id','=',$sid)
	   						->where('product.product_status',1)
	   						->where('product.sub_sub_category_id','!=', NULL)
	   						->groupBy('sub_sub_categories.id')
	   						->get();

	   		$result = [];

	   		foreach ($subsubcategories as $value) {

	   			$products = Products::select(
					'product.product_id',
					'product.product_name',
					'product.main_image',
					'product.product_tax'
				)
				->where('product.product_status',1)
				->where('product.seller_id','=',$sid)
				->where('product.sub_sub_category_id', $value->id)
				->get();

				$new_product = [];
				foreach ($products as $key => $product) {
					$product_quantity = ProductQuantity::where('product_id',$product->product_id)->first();

					$new_product[] = [
						'product_id' => $product['product_id'],
						'product_name' => $product['product_name'],
						'main_image' => $product['main_image'],
						'product_tax' => $product['product_tax'],
						'product_price' => $product_quantity['price'],
						'product_offer' => $product_quantity['offer'],
						'product_sales_price' => $product_quantity['sales_price'],
					];
				}

				$subsubcategory = [
					'id' => $value->id,
					'name' => $value->name,
					'image' => $value->image,
					'products' => $new_product
				];

				$subcategory = [
		   			'cat_id' => null,
		   			'cat_name' => null,
		   			'cat_image' => null,
		   			'subsubcategories' => $subsubcategory
		   		];

				$result[] = $subcategory;

				$data = [
					'cat_id' => NULL,
			   		'cat_name' => NULL,
				];

			}

			return response()->json([
				'status'=>true,
				'categories_count'=>$categories_count,
				// 'category'=>$data,
				'sub_category'=>$result
			]);
		}


		public function allProducts(Request $request){

			$sid = $request->sid;
			$cat_id = $request->cat_id;
			$sub_id = $request->sub_id;
			$sub_sub_id = $request->sub_sub_id;

			if($cat_id == '' && $sub_id == '' && $sub_sub_id == ''){

				$products = Products::select(
					'product.product_id',
					'product.product_name',
					'product.main_image',
					'product.product_tax'
				)
				->where('product.product_status',1)
				->where('product.seller_id',$sid)
				->get();

				$new_product = [];
				foreach ($products as $key => $product) {
					$product_quantity = ProductQuantity::where('product_id',$product->product_id)->first();

					$new_product[] = [
						'product_id' => $product['product_id'],
						'product_name' => $product['product_name'],
						'main_image' => $product['main_image'],
						'product_tax' => $product['product_tax'],
						'product_price' => $product_quantity['price'],
						'product_offer' => $product_quantity['offer'],
						'product_sales_price' => $product_quantity['sales_price'],
						'measurement' => $product_quantity['measurement'],
						'product_quantity_id' => $product_quantity['id'],
					];
				}

			}

			if($cat_id != ''){

				$products = Products::select(
					'product.product_id',
					'product.product_name',
					'product.main_image',
					'product.product_tax'
				)
				->where('product.product_status',1)
				->where('product.seller_id',$sid)
				->where('product.product_category_id',$cat_id)
				->get();

				$new_product = [];
				foreach ($products as $key => $product) {
					$product_quantity = ProductQuantity::where('product_id',$product->product_id)->first();

					$new_product[] = [
						'product_id' => $product['product_id'],
						'product_name' => $product['product_name'],
						'main_image' => $product['main_image'],
						'product_tax' => $product['product_tax'],
						'product_price' => $product_quantity['price'],
						'product_offer' => $product_quantity['offer'],
						'product_sales_price' => $product_quantity['sales_price'],
						'measurement' => $product_quantity['measurement'],
						'product_quantity_id' => $product_quantity['id'],
					];
				}
			}

			if($sub_id != ''){

				$products = Products::select(
					'product.product_id',
					'product.product_name',
					'product.main_image',
					'product.product_tax'
				)
				->where('product.product_status',1)
				->where('product.seller_id',$sid)
				->where('product.sub_category_id',$sub_id)
				->get();

				$new_product = [];
				foreach ($products as $key => $product) {
					$product_quantity = ProductQuantity::where('product_id',$product->product_id)->first();

					$new_product[] = [
						'product_id' => $product['product_id'],
						'product_name' => $product['product_name'],
						'main_image' => $product['main_image'],
						'product_tax' => $product['product_tax'],
						'product_price' => $product_quantity['price'],
						'product_offer' => $product_quantity['offer'],
						'product_sales_price' => $product_quantity['sales_price'],
						'measurement' => $product_quantity['measurement'],
						'product_quantity_id' => $product_quantity['id'],
					];
				}
			}

			if($sub_sub_id != ''){

				$products = Products::select(
					'product.product_id',
					'product.product_name',
					'product.main_image',
					'product.product_tax'
				)
				->where('product.product_status',1)
				->where('product.seller_id',$sid)
				->where('product.sub_sub_category_id',$sub_sub_id)
				->get();

				$new_product = [];
				foreach ($products as $key => $product) {
					$product_quantity = ProductQuantity::where('product_id',$product->product_id)->first();

					$new_product[] = [
						'product_id' => $product['product_id'],
						'product_name' => $product['product_name'],
						'main_image' => $product['main_image'],
						'product_tax' => $product['product_tax'],
						'product_price' => $product_quantity['price'],
						'product_offer' => $product_quantity['offer'],
						'product_sales_price' => $product_quantity['sales_price'],
						'measurement' => $product_quantity['measurement'],
						'product_quantity_id' => $product_quantity['id'],
					];
				}
			}

			return response()->json([
				'status'=>true,
				'products'=>$new_product
			]);
		}

		public function getMeasurement(Request $request){

			$product_id = $request->product_id;

			$product = Products::select('product.product_id','product.product_name','sub_sub_categories.name as subsubcategory')->where('product_id',$product_id)->leftjoin('sub_sub_categories','sub_sub_categories.id','product.sub_sub_category_id')->first();

			$product_quantity = ProductQuantity::where('product_id',$product_id)->get();

			return response()->json([
				'status' => true,
				'product' => $product,
				'product_quantity' => $product_quantity
			]);
		}

		// First Category, Sub Category, Sub Sub Categories and Products with Offer

		public function storeCategoriesFirstDataOffer(Request $request){

			$sid=$request->sid;

			$categories_count = Products::select(
				'category.cat_id',
				'category.cat_name',
				DB::raw('count(product.product_category_id) as category_count')
			)
			->leftjoin('category','category.cat_id','=','product.product_category_id')
			->leftjoin('product_quantity','product_quantity.product_id','=','product.product_id')
			->where('product.product_status',1)
			->where('product.seller_id','=',$sid)
			->where('product_quantity.offer','!=',0)
			->groupBy('product.product_category_id')
			->get();

			$category = Products::select('category.cat_id','category.cat_name')->where('product.product_status',1)->where('product.seller_id','=',$sid)->where('product_quantity.offer','!=',0)->leftjoin('product_quantity','product_quantity.product_id','=','product.product_id')->leftjoin('category','category.cat_id','=','product.product_category_id')->first();

			$subcategories = Products::select(
					'category.cat_id',
					'category.cat_name',
					'category.cat_image'
				)
				->leftjoin('category','category.cat_id','=','product.sub_category_id')
				->leftjoin('product_quantity','product_quantity.product_id','=','product.product_id')
				->where('product.product_status',1)
				->where('product.seller_id','=',$sid)
				->where('category.cat_is_parent_id',$category->cat_id)
				->where('product_quantity.offer','!=',0)
				->groupBy('product.sub_category_id')
				->get();

			$result = [];
			foreach ($subcategories as $data) {
				$subsubcategories = Products::select(
						   			'sub_sub_categories.id',
						   			'sub_sub_categories.name',
						   			'sub_sub_categories.image'
						   		)
		   						->leftjoin('sub_sub_categories','sub_sub_categories.id','product.sub_sub_category_id')
		   						->leftjoin('product_quantity','product_quantity.product_id','=','product.product_id')
		   						->where('sub_sub_categories.sub_category_id',$data->cat_id)
		   						->where('product.seller_id','=',$sid)
		   						->where('product.product_status',1)
		   						->where('product.sub_sub_category_id','!=', NULL)
		   						->where('product_quantity.offer','!=',0)
		   						->groupBy('sub_sub_categories.id')
		   						->get();

		   		foreach ($subsubcategories as $value) {

		   			$products = Products::select(
						'product.product_id',
						'product.product_name',
						'product.main_image',
						'product.product_tax'
					)
					->leftjoin('product_quantity','product_quantity.product_id','=','product.product_id')
					->where('product.product_status',1)
					->where('product.seller_id','=',$sid)
					->where('product.sub_sub_category_id', $value->id)
					->where('product_quantity.offer','!=',0)
					->get();

					$new_product = [];
					foreach ($products as $key => $product) {
						$product_quantity = ProductQuantity::where('product_id',$product->product_id)->where('product_quantity.offer','!=',0)->first();

						$new_product[] = [
							'product_id' => $product['product_id'],
							'product_name' => $product['name'],
							'main_image' => $product['main_image'],
							'product_tax' => $product['product_tax'],
							'product_price' => $product_quantity['price'],
							'product_offer' => $product_quantity['offer'],
							'product_sales_price' => $product_quantity['sales_price'],
						];
					}

					$subsubcategory[] = [
						'id' => $value->id,
						'name' => $value->name,
						'image' => $value->image,
						'products' => $new_product
					];
		   		}

		   		$subcategory = [
		   			'cat_id' => $data->cat_id,
		   			'cat_name' => $data->cat_name,
		   			'cat_image' => $data->cat_image,
		   			'subsubcategories' => $subsubcategory
		   		];

		   		$result[] = $subcategory;

			}

			return response()->json([
				'status'=>true,
				'categories_count'=>$categories_count,
				'category'=>$category,
				'subcategory'=>$result
			]);

		}

		// Store's Categories, Subcategories, SubSubCategories & Products

		public function storeCategoriesOffer(Request $request){

			$cat_id = $request->cat_id;
			$sid = $request->sid;

			$categories_count = Products::select(
				'category.cat_id',
				'category.cat_name',
				DB::raw('count(product.product_category_id) as category_count')
			)->where('product.product_status',1)
			->where('product.seller_id','=',$sid)
			->where('product_quantity.offer','!=',0)
			->leftjoin('category','category.cat_id','=','product.product_category_id')
			->leftjoin('product_quantity','product_quantity.product_id','=','product.product_id')
			->groupBy('product.product_category_id')
			->get();

			$categories = Products::select('category.cat_id','category.cat_name')->where('product.product_status',1)->where('product.seller_id','=',$sid)->where('product.product_category_id',$cat_id)->where('product_quantity.offer','!=',0)->leftjoin('product_quantity','product_quantity.product_id','=','product.product_id')->leftjoin('category','category.cat_id','=','product.product_category_id')->groupBy('product.product_category_id')->get();

			$result1 = [];

			foreach ($categories as $key => $category) {

				$subcategories = Products::select(
					'category.cat_id',
					'category.cat_name',
					'category.cat_image'
				)
				->leftjoin('category','category.cat_id','=','product.sub_category_id')
				->leftjoin('product_quantity','product_quantity.product_id','=','product.product_id')
				->where('product.product_status',1)
				->where('product.seller_id','=',$sid)
				->where('category.cat_is_parent_id',$cat_id)
				->where('product_quantity.offer','!=',0)
				->groupBy('product.sub_category_id')
				->get();

				$result = [];
				foreach ($subcategories as $data) {
					$subsubcategories = Products::select(
							   			'sub_sub_categories.id',
							   			'sub_sub_categories.name',
							   			'sub_sub_categories.image'
							   		)
			   						->leftjoin('sub_sub_categories','sub_sub_categories.id','product.sub_sub_category_id')
			   						->leftjoin('product_quantity','product_quantity.product_id','=','product.product_id')
			   						->where('sub_sub_categories.sub_category_id',$data->cat_id)
			   						->where('product.seller_id','=',$sid)
			   						->where('product.product_status',1)
			   						->where('product.sub_sub_category_id','!=', NULL)
			   						->where('product_quantity.offer','!=',0)
			   						->groupBy('sub_sub_categories.id')
			   						->get();

			   		foreach ($subsubcategories as $value) {

			   			$products = Products::select(
							'product.product_id',
							'product.product_name',
							'product.main_image',
							'product.product_tax'
						)
						->leftjoin('product_quantity','product_quantity.product_id','=','product.product_id')
						->where('product.product_status',1)
						->where('product.seller_id','=',$sid)
						->where('product.sub_sub_category_id', $value->id)
						->where('product_quantity.offer','!=',0)
						->get();

						$new_product = [];
						foreach ($products as $key => $product) {
							$product_quantity = ProductQuantity::where('product_id',$product->product_id)->where('product_quantity.offer','!=',0)->first();

							$new_product[] = [
								'product_id' => $product['product_id'],
								'product_name' => $product['product_name'],
								'main_image' => $product['main_image'],
								'product_tax' => $product['product_tax'],
								'product_price' => $product_quantity['price'],
								'product_offer' => $product_quantity['offer'],
								'product_sales_price' => $product_quantity['sales_price'],
							];
						}

						$subsubcategory[] = [
							'id' => $value->id,
							'name' => $value->name,
							'image' => $value->image,
							'products' => $new_product
						];
			   		}

			   		$subcategory = [
			   			'cat_id' => $data->cat_id,
			   			'cat_name' => $data->cat_name,
			   			'cat_image' => $data->cat_image,
			   			// 'subsubcategories' => $subsubcategory
			   		];

			   		$result[] = $subcategory;
				}

				$category_data = [
					'category_id' => $category->cat_id,
					'category_name' => $category->cat_name,
					'subcategory' => $result
				];

				$result1[] = $category_data;

				$data = [
					'cat_id' => NULL,
			   		'cat_name' => NULL,
				];

			}

			return response()->json([
				'status'=>true,
				'categories_count'=>$categories_count,
				'category'=> $data,
				'subcategory'=>$result,
			]);

		}

		// Store's Subcategories, SubSubCategories & Products

		public function storeSubCategoriesOffer(Request $request){

			$sub_id = $request->sub_id;
			$sid = $request->sid;

			$categories_count = Products::select(
				'category.cat_id',
				'category.cat_name',
				DB::raw('count(product.product_category_id) as category_count')
			)->where('product.product_status',1)
			->where('product.seller_id','=',$sid)
			->where('product_quantity.offer','!=',0)
			->leftjoin('category','category.cat_id','=','product.product_category_id')
			->leftjoin('product_quantity','product_quantity.product_id','=','product.product_id')
			->groupBy('product.product_category_id')
			->get();

			$subcategories = Products::select(
				'category.cat_id',
				'category.cat_name',
				'category.cat_image',
			)
			->leftjoin('category','category.cat_id','=','product.sub_category_id')
			->leftjoin('product_quantity','product_quantity.product_id','=','product.product_id')
			->where('product.product_status',1)
			->where('product.seller_id','=',$sid)
			->where('category.cat_is_parent_id','!=', NULL)
			->where('category.cat_id', $sub_id)
			->where('product_quantity.offer','!=',0)
			->groupBy('product.sub_category_id')
			->get();

			$result = [];
			foreach ($subcategories as $data) {
				$subsubcategories = Products::select(
						   			'sub_sub_categories.id',
						   			'sub_sub_categories.name',
						   			'sub_sub_categories.image'
						   		)
		   						->leftjoin('sub_sub_categories','sub_sub_categories.id','product.sub_sub_category_id')
		   						->leftjoin('product_quantity','product_quantity.product_id','=','product.product_id')
		   						->where('sub_sub_categories.sub_category_id',$data->cat_id)
		   						->where('product.seller_id','=',$sid)
		   						->where('product.product_status',1)
		   						->where('product.sub_sub_category_id','!=', NULL)
		   						->where('product_quantity.offer','!=',0)
		   						->groupBy('sub_sub_categories.id')
		   						->get();

		   		foreach ($subsubcategories as $value) {

		   			$products = Products::select(
						'product.product_id',
						'product.product_name',
						'product.main_image',
						'product.product_tax'
					)
					->leftjoin('product_quantity','product_quantity.product_id','=','product.product_id')
					->where('product.product_status',1)
					->where('product.seller_id','=',$sid)
					->where('product.sub_sub_category_id', $value->id)
					->where('product_quantity.offer','!=',0)
					->get();

					$new_product = [];
					foreach ($products as $key => $product) {
						$product_quantity = ProductQuantity::where('product_id',$product->product_id)->where('product_quantity.offer','!=',0)->first();

						$new_product[] = [
							'product_id' => $product['product_id'],
							'product_name' => $product['product_name'],
							'main_image' => $product['main_image'],
							'product_tax' => $product['product_tax'],
							'product_price' => $product_quantity['price'],
							'product_offer' => $product_quantity['offer'],
							'product_sales_price' => $product_quantity['sales_price'],
						];
					}

					$subsubcategory[] = [
						'id' => $value->id,
						'name' => $value->name,
						'image' => $value->image,
						'products' => $new_product
					];
		   		}

		   		$subcategory = [
		   			'cat_id' => $data->cat_id,
		   			'cat_name' => $data->cat_name,
		   			'cat_image' => $data->cat_image,
		   			'subsubcategories' => $subsubcategory
		   		];

		   		$result[] = $subcategory;

		   		$data = [
					'cat_id' => NULL,
			   		'cat_name' => NULL,
				];

			}

			return response()->json([
				'status'=>true,
				'categories_count'=>$categories_count,
				// 'category'=>$data,
				'sub_category'=>$result
			]);

		}


		// Store's SubSubCategories & Products

		public function storeSubSubCategoriesOffer(Request $request){

			$sub_sub_id = $request->sub_sub_id;
			$sid = $request->sid;


			$categories_count = Products::select(
				'category.cat_id',
				'category.cat_name',
				DB::raw('count(product.product_category_id) as category_count')
			)->where('product.product_status',1)
			->where('product.seller_id','=',$sid)
			->where('product_quantity.offer','!=',0)
			->leftjoin('category','category.cat_id','=','product.product_category_id')
			->leftjoin('product_quantity','product_quantity.product_id','=','product.product_id')
			->groupBy('product.product_category_id')
			->get();

			$subsubcategories = Products::select(
					   			'sub_sub_categories.id',
					   			'sub_sub_categories.name',
					   			'sub_sub_categories.image'
					   		)
	   						->leftjoin('sub_sub_categories','sub_sub_categories.id','product.sub_sub_category_id')
	   						->leftjoin('product_quantity','product_quantity.product_id','=','product.product_id')
	   						->where('sub_sub_categories.id',$sub_sub_id)
	   						->where('product.seller_id','=',$sid)
	   						->where('product.product_status',1)
	   						->where('product.sub_sub_category_id','!=', NULL)
	   						->where('product_quantity.offer','!=',0)
	   						->groupBy('sub_sub_categories.id')
	   						->get();

	   		$result = [];

	   		foreach ($subsubcategories as $value) {

	   			$products = Products::select(
					'product.product_id',
					'product.product_name',
					'product.main_image',
					'product.product_tax'
				)
				->leftjoin('product_quantity','product_quantity.product_id','=','product.product_id')
				->where('product.product_status',1)
				->where('product.seller_id','=',$sid)
				->where('product.sub_sub_category_id', $value->id)
				->where('product_quantity.offer','!=',0)
				->get();

				$new_product = [];
				foreach ($products as $key => $product) {
					$product_quantity = ProductQuantity::where('product_id',$product->product_id)->where('product_quantity.offer','!=',0)->first();

					$new_product[] = [
						'product_id' => $product['product_id'],
						'product_name' => $product['product_name'],
						'main_image' => $product['main_image'],
						'product_tax' => $product['product_tax'],
						'product_price' => $product_quantity['price'],
						'product_offer' => $product_quantity['offer'],
						'product_sales_price' => $product_quantity['sales_price'],
					];
				}

				$subsubcategory = [
					'id' => $value->id,
					'name' => $value->name,
					'image' => $value->image,
					'products' => $new_product
				];

				$subcategory = [
		   			'cat_id' => null,
		   			'cat_name' => null,
		   			'cat_image' => null,
		   			'subsubcategories' => $subsubcategory
		   		];

				$result[] = $subcategory;

				$data = [
					'cat_id' => NULL,
			   		'cat_name' => NULL,
				];

			}

			return response()->json([
				'status'=>true,
				'categories_count'=>$categories_count,
				// 'category'=>$data,
				'sub_category'=>$result
			]);
		}


		public function allProductsOffer(Request $request){

			$sid = $request->sid;
			$cat_id = $request->cat_id;
			$sub_id = $request->sub_id;
			$sub_sub_id = $request->sub_sub_id;

			if($cat_id == '' && $sub_id == '' && $sub_sub_id == ''){

				$products = Products::select(
					'product.product_id',
					'product.product_name',
					'product.main_image',
					'product.product_tax'
				)
				->leftjoin('product_quantity','product_quantity.product_id','=','product.product_id')
				->where('product.product_status',1)
				->where('product.seller_id',$sid)
				->where('product_quantity.offer','!=',0)
				->get();

				$new_product = [];
				foreach ($products as $key => $product) {
					$product_quantity = ProductQuantity::where('product_id',$product->product_id)->where('product_quantity.offer','!=',0)->first();

					$new_product[] = [
						'product_id' => $product['product_id'],
						'product_name' => $product['product_name'],
						'main_image' => $product['main_image'],
						'product_tax' => $product['product_tax'],
						'product_price' => $product_quantity['price'],
						'product_offer' => $product_quantity['offer'],
						'product_sales_price' => $product_quantity['sales_price'],
						'measurement' => $product_quantity['measurement'],
						'product_quantity_id' => $product_quantity['id'],
					];
				}
			}

			if($cat_id != ''){

				$products = Products::select(
					'product.product_id',
					'product.product_name',
					'product.main_image',
					'product.product_tax'
				)
				->leftjoin('product_quantity','product_quantity.product_id','=','product.product_id')
				->where('product.product_status',1)
				->where('product.seller_id',$sid)
				->where('product.product_category_id',$cat_id)
				->where('product_quantity.offer','!=',0)
				->get();

				$new_product = [];
				foreach ($products as $key => $product) {
					$product_quantity = ProductQuantity::where('product_id',$product->product_id)->where('product_quantity.offer','!=',0)->first();

					$new_product[] = [
						'product_id' => $product['product_id'],
						'product_name' => $product['product_name'],
						'main_image' => $product['main_image'],
						'product_tax' => $product['product_tax'],
						'product_price' => $product_quantity['price'],
						'product_offer' => $product_quantity['offer'],
						'product_sales_price' => $product_quantity['sales_price'],
						'measurement' => $product_quantity['measurement'],
						'product_quantity_id' => $product_quantity['id'],
					];
				}
			}

			if($sub_id != ''){

				$products = Products::select(
					'product.product_id',
					'product.product_name',
					'product.main_image',
					'product.product_tax'
				)
				->leftjoin('product_quantity','product_quantity.product_id','=','product.product_id')
				->where('product.product_status',1)
				->where('product.seller_id',$sid)
				->where('product.sub_category_id',$sub_id)
				->where('product_quantity.offer','!=',0)
				->get();

				$new_product = [];
				foreach ($products as $key => $product) {
					$product_quantity = ProductQuantity::where('product_id',$product->product_id)->where('product_quantity.offer','!=',0)->first();

					$new_product[] = [
						'product_id' => $product['product_id'],
						'product_name' => $product['product_name'],
						'main_image' => $product['main_image'],
						'product_tax' => $product['product_tax'],
						'product_price' => $product_quantity['price'],
						'product_offer' => $product_quantity['offer'],
						'product_sales_price' => $product_quantity['sales_price'],
						'measurement' => $product_quantity['measurement'],
						'product_quantity_id' => $product_quantity['id'],
					];
				}
			}

			if($sub_sub_id != ''){

				$products = Products::select(
					'product.product_id',
					'product.product_name',
					'product.main_image',
					'product.product_tax'
				)
				->leftjoin('product_quantity','product_quantity.product_id','=','product.product_id')
				->where('product.product_status',1)
				->where('product.seller_id',$sid)
				->where('product.sub_sub_category_id',$sub_sub_id)
				->where('product_quantity.offer','!=',0)
				->get();

				$new_product = [];
				foreach ($products as $key => $product) {
					$product_quantity = ProductQuantity::where('product_id',$product->product_id)->where('product_quantity.offer','!=',0)->first();

					$new_product[] = [
						'product_id' => $product['product_id'],
						'product_name' => $product['product_name'],
						'main_image' => $product['main_image'],
						'product_tax' => $product['product_tax'],
						'product_price' => $product_quantity['price'],
						'product_offer' => $product_quantity['offer'],
						'product_sales_price' => $product_quantity['sales_price'],
						'measurement' => $product_quantity['measurement'],
						'product_quantity_id' => $product_quantity['id'],
					];
				}
			}

			return response()->json([
				'status'=>true,
				'products'=>$new_product
			]);
		}


		public function totalItem(Request $request){

			$total_item = $request->total;
			$price = $request->price;
			$total = $total_item + $price;
			$total_item = $total;

			return response()->json([
				'status' => true,
				'total' => $total_item,
			]);

		}

		public function storeProductsFilter(Request $request){

			$main_id= $request->main_id;
		   	$seller_id = $request->sd_usid;

		   	$seller = Seller::where('main_category',$main_id)->get();

	   		$count = Seller::where('main_category',$main_id)->where('sd_usid',$seller_id)->count();

	   		if($count == 0){
	   			return response()->json([
			  		'status' => false,
					'message' => 'No Stores Found'
			    ]);
	   		}else{
	   			$store = Seller::where('main_category',$main_id)->where('sd_usid',$seller_id)->first();
		   		$products = Products::where('seller_id',$store->sd_usid)->take(2)->get();
		   		$new_product = [];
		   		foreach ($products as $key => $data) {

		   			$product_quantity = ProductQuantity::where('product_id',$data->product_id)->first();
		   			$new_product[] = [
						'product_id' => $data['product_id'],
						'product_name' => $data['product_name'],
						'main_image' => $data['main_image'],
						'product_tax' => $data['product_tax'],
						'measurement' => $product_quantity['measurement'],
						'product_price' => $product_quantity['price'],
						'product_offer' => $product_quantity['offer'],
						'product_sales_price' => $product_quantity['sales_price'],
						'product_quantity_id' => $product_quantity['id'],
					];
		   		}

		   		$seller1 = [
		   			"sd_id" => $store->sd_id,
	                "sd_usid" => $store->sd_usid,
	                "sd_sname" => $store->sd_sname,
	                "main_category" => $store->main_category,
	                "sd_snumber" => $store->sd_snumber,
	                "sd_sadminshare" => $store->sd_sadminshare,
	                "sd_scityid" => $store->sd_scityid,
	                "sd_sdeliverykm" => $store->sd_sdeliverykm,
	                "sd_spincode" => $store->sd_spincode,
	                "sd_address" => $store->sd_address,
	                "store_image" => $store->store_image,
	                "store_logo" => $store->store_logo,
	                "products" => $new_product
		   		];

		   		$result[] = $seller1;

			   	return response()->json([
			  		'status' => true,
					'stores' => $seller,
			   		'data' => $result
			    ]);
	   		}

		}


		public function globalsearch(Request $request){
          if($request->type){
			if($request->type == 1){
				$finalstore_array=array();
				$storedetails=Seller::where('main_category',$request->categoryId)->where('sd_sname', 'like', '%' . $request->search . '%')->where('sd_status',1)->get();
				if(count($storedetails) > 0){
					foreach($storedetails as $storedetail){
						$store_array=array(
							'store_id'=>$storedetail->sd_id,
							'store_user_id'=>$storedetail->sd_usid,
							'store_name'=>$storedetail->sd_sname,
							'store_number'=>$storedetail->sd_snumber,
							'store_share'=>$storedetail->sd_sadminshare,
							'store_cityid'=>$storedetail->sd_scityid,
							'store_delivery'=>$storedetail->sd_sdeliverykm,
							'store_pincode'=>$storedetail->sd_spincode,
							'store_address'=>$storedetail->sd_address,
							'store_status'=>$storedetail->sd_status,
							'store_tag'=>$storedetail->tag,
							'store_image'=>$storedetail->store_image
						);
						array_push($finalstore_array,$store_array);
					}
					return response()->json([
						'status' => true,
						'type'=> $request->type,
						'store_details' => $finalstore_array
					]);
				}else{
					return response()->json([
						'status' => false,
						'type'=> $request->type,
						'store_details' => []
					]);
				}
			}else{
				$finalproduct_array=array();
				$storedetails=Seller::where('main_category',$request->categoryId)->where('sd_status',1)->get();
				if(count($storedetails) > 0){
					foreach($storedetails as $storedetail){
						$productdetails=Products::select('product.*','product_quantity.*')
						->where('seller_id',$storedetail->sd_id)
						->where('product_name', 'like', '%' . $request->search . '%')
						->where('product_status',1)
						->leftjoin('product_quantity','product_quantity.product_id ','product.product_id')
						->get();
						foreach($productdetails as $productdetail){
							$product_array=array(
								'product_id'=>$productdetail->product_id,
								'product_name'=>$productdetail->product_name,
								'product_category_id'=>$productdetail->product_category_id,
								'measurement_id'=>$productdetail->measurement_id,
								'brand_id'=>$productdetail->brand_id,
								'seller_id'=>$productdetail->seller_id,
								'sub_category_id'=>$productdetail->sub_category_id,
								'product_short_description'=>$productdetail->product_short_description,
								'product_long_description'=>$productdetail->product_long_description,
								'product_tax'=>$productdetail->product_tax,
								'product_status'=>$productdetail->product_status,
								'main_image'=>$productdetail->main_image,
								'measurement' => $productdetail->measurement,
								'price' => $productdetail->price,

							);
							array_push($finalproduct_array,$product_array);
						}
					}
					return response()->json([
						'status' => true,
						'type'=> $request->type,
						'product_details' => $finalproduct_array
					]);

				}else{
					return response()->json([
						'status' => false,
						'type'=> $request->type,
						'product_details' => []
					]);
				}
			}
		  }else{
			$finalstore_array=array();
			$storedetails=Seller::where('sd_sname', 'like', '%' . $request->search . '%')->where('sd_status',1)->get();
			$is_store=0;
			if(count($storedetails) > 0){
				$is_store=1;
				foreach($storedetails as $storedetail){
					$store_array=array(
						'store_id'=>$storedetail->sd_id,
						'store_user_id'=>$storedetail->sd_usid,
						'store_name'=>$storedetail->sd_sname,
						'store_number'=>$storedetail->sd_snumber,
						'store_share'=>$storedetail->sd_sadminshare,
						'store_cityid'=>$storedetail->sd_scityid,
						'store_delivery'=>$storedetail->sd_sdeliverykm,
						'store_pincode'=>$storedetail->sd_spincode,
						'store_address'=>$storedetail->sd_address,
						'store_status'=>$storedetail->sd_status,
						'store_tag'=>$storedetail->tag,
						'store_image'=>$storedetail->store_image
					);
					array_push($finalstore_array,$store_array);
				}

			}
			$finalproduct_array=array();
			$productdetails=Products::where('product_name', 'like', '%' . $request->search . '%')
			->select('product.*','product_quantity.*')
			->leftjoin('product_quantity','product_quantity.product_id','product.product_id')
			->where('product_status',1)
			->get();
			$is_product=0;
			if(count($productdetails) > 0){
				foreach($productdetails as $productdetail){
					$is_product=1;
					$product_array=array(
						'product_id'=>$productdetail->product_id,
						'product_name'=>$productdetail->product_name,
						'product_category_id'=>$productdetail->product_category_id,
						'measurement_id'=>$productdetail->measurement_id,
						'brand_id'=>$productdetail->brand_id,
						'seller_id'=>$productdetail->seller_id,
						'sub_category_id'=>$productdetail->sub_category_id,
						'product_short_description'=>$productdetail->product_short_description,
						'product_long_description'=>$productdetail->product_long_description,
						'product_tax'=>$productdetail->product_tax,
						'product_status'=>$productdetail->product_status,
						'main_image'=>$productdetail->main_image,
						'measurement' => $productdetail->measurement,
						'price' => $productdetail->price,

					);
					array_push($finalproduct_array,$product_array);
				}
			}
			if(($is_store == 1) && ($is_product == 1)){
				return response()->json([
					'status' => true,
					'is_store'=> 1,
					'is_product'=>1,
					'store_details' => $finalstore_array,
					'product_details'=> $finalproduct_array
				]);
			}elseif(($is_store == 1) && ($is_product == 0)){
				return response()->json([
					'status' => true,
					'is_store'=> 1,
					'is_product'=>0,
					'store_details' => $finalstore_array,
					'product_details'=> []
				]);
			}elseif(($is_store == 0) && ($is_product == 1)){
				return response()->json([
					'status' => true,
					'is_store'=> 0,
					'is_product'=>1,
					'store_details' => [],
					'product_details'=> $finalproduct_array
				]);
			}else{
				return response()->json([
					'status' => false,
					'is_store'=> 0,
					'is_product'=>0,
					'store_details' => [],
					'product_details'=> []
				]);
			}

		  }
		}

				public function storetimings(Request $request){
            $cartid=$request->cartid;
			if($cartid){
				$addtocart=Addtocart::where('id',$cartid)->where('status',1)->first();
				if($addtocart){
					$store = Seller::where('sd_usid',$addtocart->store_id)->where('sd_status',1)->first();
					if($store){
						$result=array(
							'store_id'=>$store->sd_sname,
							'sd_us_id'=>$store->sd_usid,
							'sunday_check'=>$store->sunday_check ? $store->sunday_check : '',
							'sunday_opening_time'=>$store->sunday_opening_time ? $store->sunday_opening_time : '',
							'sunday_closing_time'=>$store->sunday_closing_time ? $store->sunday_closing_time : '',
							'monday_check'=>$store->monday_check ? $store->monday_check : '',
							'monday_opening_time'=>$store->monday_opening_time ? $store->monday_opening_time : '',
							'monday_closing_time'=>$store->monday_closing_time ? $store->monday_closing_time : '' ,
							'tuesday_check'=>$store->tuesday_check ? $store->tuesday_check : '',
							'tuesday_opening_time'=>$store->tuesday_opening_time ? $store->tuesday_opening_time : '',
							'tuesday_closing_time'=>$store->tuesday_closing_time ? $store->tuesday_closing_time : '',
							'wednesday_check'=>$store->wednesday_check ? $store->wednesday_check : '',
							'wednesday_opening_time'=>$store->wednesday_opening_time ? $store->wednesday_opening_time : '',
							'wednesday_closing_time'=>$store->wednesday_closing_time ? $store->wednesday_closing_time : '',
							'thursday_check'=>$store->thursday_check ? $store->thursday_check : '',
							'thursday_opening_time'=>$store->thursday_opening_time ? $store->thursday_opening_time : '',
							'thursday_closing_time'=>$store->thursday_closing_time ? $store->thursday_closing_time : '' ,
							'friday_check'=>$store->friday_check ? $store->friday_check : '',
							'friday_opening_time'=>$store->friday_opening_time ? $store->friday_opening_time : '',
							'friday_closing_time'=>$store->friday_closing_time ? $store->friday_closing_time : '',
							'saturday_check'=>$store->saturday_check ? $store->saturday_check : '',
							'saturday_opening_time'=>$store->saturday_opening_time ? $store->saturday_opening_time : '',
							'saturday_closing_time'=>$store->saturday_closing_time ? $store->saturday_closing_time : '',
						);
						return response()->json([
							 'status' => true,
							 'data' => $result
					  ]);
					}else{
						return response()->json([
							'status' => false,
							'data' => []
					 ]);
					}
				}else{
					return response()->json([
						'status' => false,
						'data' => []
				 ]);
				}

			}else{
				return response()->json([
					'status' => false,
					'data' => []
			 ]);
			}
		}

	}
