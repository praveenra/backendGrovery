<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	use Carbon\Carbon;
	use Session;
	use Auth;
	use App\Models\Customer;
	use App\Models\CustomerAddress;
	use App\Models\Seller;
	use App\Models\Category;
	use App\Models\Offer;
	use App\Models\Maincategory;
	use DB;
	use Redirect;

	use App\Models\Products;
	use App\Models\Addtocart;
	use App\Models\AddToList;
	use App\Http\Traits\cart;
	class WebController extends Controller
	{
		
		use cart;


		protected $data = array();
		/**
			* Create a new controller instance.
			*
			* @return void
		*/
		public function __construct()
		{
			//$this->middleware('auth');
		}
		
		/**
			* Show the application dashboard.
			*
			* @return \Illuminate\Contracts\Support\Renderable
		*/
		public function index(){
			
		}
		
		public function mainpage(){
			
			 $addtocart = $this->getcart();
			 $seller_list = $this->seller_list();
			 $cart_product = $this->cart_product();
			 $maincategorylist = $this->maincategorylist();
			 
			 $cartcount=$this->cartcount();
			
			$maincategory=Maincategory::where('mc_status','=','1')->get();
			return view('index',[
			'maincategory' => $maincategory,
			'addtocart' => $addtocart,
			'cartcount' => $cartcount,
			'seller_list' => $seller_list,
			'maincategorylist' => $maincategorylist,
			'cart_product' => $cart_product
			]);
		}
		
		public function storetype($type)
		{
			
			 $addtocart = $this->getcart();	
			 $seller_list = $this->seller_list();
			 $cart_product = $this->cart_product();
			 $cartcount=$this->cartcount();
			 
			 $maincategorylist = $this->maincategorylist();
			$storedetails=Seller::select('seller_details.*')->leftJoin("main_category", "main_category.mc_id", "=", "seller_details.main_category")
                        ->where('seller_details.main_category','=',$type)->get();
	
			return view('store',[
			'storedetails'=>$storedetails,
			'addtocart'=>$addtocart,
			'cartcount' => $cartcount,
			'seller_list' => $seller_list,
			'cart_product' => $cart_product,
			'maincategorylist' => $maincategorylist,
			'type' =>$type
			]);
		}
		
		public function getproduct($type,$sid)
		{
			
			 $addtocart = $this->getcart();	
			  $seller_list = $this->seller_list();
			 $cart_product = $this->cart_product();
			  $maincategorylist = $this->maincategorylist();
			  $cartcount=$this->cartcount();
			$seller=Seller::where('sd_usid','=',$sid)->select(array('sd_sname'))->first()->toArray();
			$maincategory=Maincategory::where('mc_id','=',$type)->select(array('mc_name','mc_id'))->first()->toArray();
			$category=Products::where('product.product_status',1)->where('product.seller_id','=',$sid)->leftjoin('category','category.cat_id','=','product.product_category_id')->groupBy('category.cat_id','category.cat_name')->get(array('category.cat_id','category.cat_name'));
			//$subcategory=Category::where('cat_is_parent_id','!=',null)->leftjoin('product','product.sub_category_id','=','category.cat_id')->where('product.seller_id','=',$sid)->groupBy('product.sub_category_id')->get();
			
			$subcategory=DB::select( DB::Raw("select category.cat_is_parent_id,category.cat_id,category.cat_image,category.cat_name from category left join product on product.sub_category_id = category.cat_id where `cat_is_parent_id` is not null and product.seller_id = '".$sid."' group by product.sub_category_id,category.cat_id,category.cat_is_parent_id,category.cat_name,category.cat_image"));
			return view('category-products',
			[
			'maincategory' =>$maincategory,
			'sid' =>$sid,
			'maincategorylist' =>$maincategorylist,
			'cartcount' => $cartcount,
			'seller' =>$seller,
			'category' => $category,
			'addtocart' => $addtocart,
			'cart_product' => $cart_product,
			'seller_list' => $seller_list,
			'subcategory' => $subcategory
			]);
		}
		
		public function getsubcategory($type,$sid,$catid,$subid)
		{
			
			$addtocart = $this->getcart();
			 $seller_list = $this->seller_list();
			 $cart_product = $this->cart_product();
			 $maincategorylist = $this->maincategorylist();
			 $cartcount=$this->cartcount();
			$maincategory=Maincategory::where('mc_id','=',$type)->select(array('mc_name','mc_id'))->first()->toArray();
			$seller=Seller::where('sd_usid','=',$sid)->select(array('sd_sname'))->first()->toArray();
			
			
			$category=Products::where('product.product_status',1)->where('product.seller_id','=',$sid)->leftjoin('category','category.cat_id','=','product.product_category_id')->groupBy('category.cat_id','category.cat_name')->get(array('category.cat_id','category.cat_name'));
			$productcategory=DB::select( DB::Raw("select category.cat_is_parent_id,category.cat_id,category.cat_image,category.cat_name from category left join product on product.sub_category_id = category.cat_id where `cat_is_parent_id` is not null and product.seller_id = '".$sid."' and product.product_category_id='".$catid."' group by product.sub_category_id,category.cat_id,category.cat_is_parent_id,category.cat_name,category.cat_image"));
			
			$subcategory=Category::where('cat_is_parent_id','!=',null)->where('product.sub_category_id','=',$subid)->where('product.seller_id','=',$sid)->rightjoin('product','product.sub_Category_id','=','category.cat_id')->get();
			
			$subcategoryname=Category::where('cat_is_parent_id','!=',null)->where('cat_id','=',$subid)->select(array('cat_name'))->first()->toArray();
			
			
			return view ('category-view',[
			'maincategory' =>$maincategory,
			'sid' =>$sid,
			'catid' =>$catid,
			'subid' =>$subid,
			'seller' =>$seller,
			'category' =>$category,
			'productcategory' =>$productcategory,
			'maincategorylist' =>$maincategorylist,
			'cartcount' => $cartcount,
			'addtocart' =>$addtocart,
			'cart_product' =>$cart_product,
			'seller_list' =>$seller_list,
			'subcategoryname' =>$subcategoryname,
			'subcategory' =>$subcategory,
			]);
		}
		
		
		
	public function pricesort($type,$sid,$catid,$subid,$sort)
	{
			
			if($sort=="low")
			{
			$subcategory=Category::where('cat_is_parent_id','!=',null)->where('product.sub_category_id','=',$subid)->where('product.seller_id','=',$sid)->rightjoin('product','product.sub_Category_id','=','category.cat_id')->orderBy('product.product_sales_price','asc')->get();
			}
			elseif($sort=="high")
			{
			$subcategory=Category::where('cat_is_parent_id','!=',null)->where('product.sub_category_id','=',$subid)->where('product.seller_id','=',$sid)->rightjoin('product','product.sub_Category_id','=','category.cat_id')->orderBy('product.product_sales_price','desc')->get();
			}
			elseif($sort=="alpha")
			{
			$subcategory=Category::where('cat_is_parent_id','!=',null)->where('product.sub_category_id','=',$subid)->where('product.seller_id','=',$sid)->rightjoin('product','product.sub_Category_id','=','category.cat_id')->orderBy('product.product_name','asc')->get();
			}
			
			return view ('ajax-category-view',[
			
			'subcategory' =>$subcategory,
			'sid' =>$sid
			]);
			
			
	}
		public function addtocart($sid,$proid)
		{
			
			if(Auth::id()!="")
			{
				$addtocart=new Addtocart;
				$addtocart->store_id=$sid;
				$addtocart->customer_id=Auth::id();
				$addtocart->product_id=$proid;
				$addtocart->save();
				return redirect::back();
				
			}
			else
			{
				return redirect("custlogin");	
			}
		}
		
		public function login()
		{
			$addtocart = $this->getcart();
			return view('login',[
			'addtocart' =>$addtocart
			]);
		}
		public function loginsubmit(Request $request)
		{
			
			
			$user = Customer::where('phone_no', $request->phone_no)->count();

		   if($user!=1) {
			   return redirect::back()->with('failure', 'Mobile Number does not exist');
		   }
		   else{
			   
			$generate_otp = mt_rand(1000,9999);
			
			$csutid=Customer::where('phone_no','=',$request->phone_no)->first();
			$customer=Customer::find($csutid->id);
			$customer->otp=$generate_otp;
			$customer->save();
			  
		
		
			//$user = Customer::where('phone_no', $request->get('phone_no'))->first();
			return view('siginotp',[
			'phone_no'=>$request->phone_no,
			'uploadError' =>''
			]);
		   }
		      
		}
		
		public function checksigninotp(Request $request)
		{
						
			$user = Customer::where('phone_no', $request->get('phone_no'))->first();
			$otp=$request->otp1.$request->otp2.$request->otp3.$request->otp4;

		   if($otp != $user->otp) {
            return view('siginotp',[
				'phone_no'=>$request->phone_no,
				'uploadError' =>'Invalid Otp'
				]);
        }        
		else
		{
			$cust=Customer::find($user->id);
			$cust->otp="";
			$cust->save();
			\Auth::login($user);
		return redirect()->intended('/');
		}
		
		}
		public function register()
		{
			$addtocart = $this->getcart();
			return view('register',[
			'addtocart' => $addtocart
			]);
		}
		public function submitregister(Request $request)
		{
			
			$generate_otp = mt_rand(1000,9999);
			
			$Customer= new Customer;
			$Customer->name=$request->name;
			$Customer->email=$request->email;
			$Customer->phone_no=$request->phone_no;
			$Customer->status=1;
			$Customer->otp=$generate_otp;
			$Customer->save();
			$id=$Customer->id;
			return view('otp',[
			'id' =>$id,
			'uploadError'=>''
			]);
		}
		
		public function checkotp(Request $request)
		{
			$otp=$request->otp1.$request->otp2.$request->otp3.$request->otp4;
			$getcount=Customer::where('otp','=',$otp)->where('id','=',$request->id)->count();


			if($getcount==1)
			{
				$customer=Customer::find($request->id);
				$customer->otp="";
				$customer->save();
				return redirect("/");
			}
			else
			{
				return view('otp',[
				'id'=>$request->id,
				'uploadError' =>'Invalid Otp'
				]);
			}
		}
		
		public function offer()
		{
			$addtocart = $this->getcart();
			 $seller_list = $this->seller_list();
			 $cart_product = $this->cart_product();
			 $maincategorylist = $this->maincategorylist();
			 
			 $cartcount=$this->cartcount();
			$offer_list=Offer::where('status','=',1)->get();
			return view('offer',[
			'offer_list'=>$offer_list,
			'addtocart' => $addtocart,
			'cartcount' => $cartcount,
			'seller_list' => $seller_list,
			'maincategorylist' => $maincategorylist
			]);
		}

		public function customerAddress(){

			if(Auth::user()){
				
				$customer_id = Auth::user()->id;
				$addtocart = $this->getcart();
				$seller_list = $this->seller_list();
				$cart_product = $this->cart_product();
				$maincategorylist = $this->maincategorylist();
				$cartcount=$this->cartcount();
	
				$maincategory=Maincategory::where('mc_status','=','1')->get();
	
				$cust_addresses = DB::table('customer_addresses')->where('customer_id',Auth::user()->id)->get();
	
				return view('customer-address',[
					'maincategory' => $maincategory,
					'addtocart' => $addtocart,
					'cartcount' => $cartcount,
					'seller_list' => $seller_list,
					'maincategorylist' => $maincategorylist,
					'cart_product' => $cart_product,
					'cust_addresses' => $cust_addresses,
					'customer_id' => $customer_id
				]);
			}else{
				return redirect("custlogin");
			}
		}

		public function setAddress(Request $request){

			$cust_addresses = DB::table('customer_addresses')->where('customer_id',Auth::user()->id)->update(['select' => 0]);

			$update_cust_addresses = DB::table('customer_addresses')->where('id',$request->id)->update(['select' => 1]);

		}

		public function editAddress($id = NULL){

			if($id){
				$customer_address = CustomerAddress::where('id',$id)->where('customer_id',Auth::user()->id)->first();
			}
	    	return response()->json(['data' => $customer_address]);
		}

		public function saveCustomerAddress(Request $request){

			if($request->id){
				$customer_address = CustomerAddress::where('id',$request->id)->where('customer_id',Auth::user()->id)->first();
			}else{
				$customer_address = new CustomerAddress;
			}
				$customer_address->customer_id = Auth::user()->id;
				$customer_address->address = $request->address;
				$customer_address->address_type = $request->address_type;
				$customer_address->landmark = $request->landmark;
				$customer_address->mobile_no = $request->mobile_no;
				$customer_address->save();

			return redirect('/customer_address');
		}

		public function deleteCustomerAddress(Request $request){

			$delete_address = CustomerAddress::where('id',$request->delete_id)->delete();

			return redirect('/customer_address');
		}

		public function addtolist($sid,$proid){

			$product_category_id = Products::where('product_id',$proid)->pluck('product_category_id')->first();
			
			if(Auth::user()){

				$addtolist = new AddToList;
				$addtolist->store_id = $sid;
				$addtolist->customer_id = Auth::id();
				$addtolist->product_id = $proid;
				$addtolist->category_id = $product_category_id;
				$addtolist->save();

				return redirect::back();
			}else{
				return redirect("custlogin");	
			}
		}

		public function addToListView(){

			$addtocart = $this->getcart();
			$seller_list = $this->seller_list();
			$cart_product = $this->cart_product();
			$maincategorylist = $this->maincategorylist();
			$cartcount=$this->cartcount();

			$maincategory=Maincategory::where('mc_status','=','1')->get();

			$add_list = AddToList::select(
				'add_to_list.*',
				'product.product_name as product',
				'product.main_image as img',
				'category.cat_name as category'
				)
				->leftjoin('product','product.product_id','add_to_list.product_id')
				->leftjoin('category','category.cat_id','add_to_list.category_id')
				->where('customer_id', Auth::user()->id)
				->get();
			 // dd($add_list);
			if(Auth::user()){
			 	return view('added-list',['maincategory' => $maincategory,'addtocart' => $addtocart,'cartcount' => $cartcount,'seller_list' => $seller_list,'maincategorylist' => $maincategorylist,'cart_product' => $cart_product,'add_list' => $add_list]);
			}else{
				return redirect("custlogin");	
			}
		}
	}


