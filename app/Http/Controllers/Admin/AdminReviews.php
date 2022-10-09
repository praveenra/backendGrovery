<?php	
		
	namespace App\Http\Controllers\Admin;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\Common;
	use App\Models\Review;
	use App\Models\ProductReview;
	use DB;
	class AdminReviews extends Controller	
	{		
        protected $data = array();
        protected $page_details =array(
            'page_name'=> 'Reviews',
            'page_auth'=> 'admin',
        );		
		/**  			
			* Contructor to aunthendicate user			
		*/		
		public function __construct(){			
			$this->middleware('admin');			
		}		
				
		/**			
			* Display a listing of the resource.			
			*			
			* @return \Illuminate\Http\Response			
		*/		
				
		public function store_reviews(Request $request){			

            $this->data['reviews'] = Review::select('customer.name as customer','reviews.*','seller_details.sd_sname')->leftjoin('customer','customer.id','reviews.customer_id')->leftjoin('seller_details','seller_details.sd_usid','reviews.store_id')->paginate();
            $this->data['message'] = 'No Review Added';
            $this->data['page_details'] = $this->page_details;

            return view('admin.reviews.store_reviews', $this->data);  
		}		

		public function change_review_status(Request $request){

			$review = Review::where('id',$request->id)->first();
			$review->status = $request->status;
			$review->save();
		}

		public function change_all_review_status(Request $request){

			$review = DB::table('reviews')->update(['status' => 1]);
			
		}

		public function product_reviews(Request $request){			

            $this->data['reviews'] = ProductReview::select('customer.name as customer','product_reviews.*','product.product_name','seller_details.sd_sname')->leftjoin('customer','customer.id','product_reviews.customer_id')->leftjoin('product','product.product_id','product_reviews.product_id')->leftjoin('seller_details','seller_details.sd_usid','product.seller_id')->paginate();
            $this->data['message'] = 'No Review Added';
            $this->data['page_details'] = $this->page_details;

            return view('admin.reviews.product_reviews', $this->data);  
		}		

		public function change_product_review_status(Request $request){

			$review = ProductReview::where('id',$request->id)->first();
			$review->status = $request->status;
			$review->save();
		}
		
		public function change_all_product_review_status(Request $request){

			$review = DB::table('product_reviews')->update(['status' => 1]);
			// $review = ProductReview::update(['status' => 1]);
		}		
	}	
