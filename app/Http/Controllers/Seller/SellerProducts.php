<?php	
		
	namespace App\Http\Controllers\Seller;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\Common;
	use App\Models\Measurement;
	use App\Models\User;
    use App\Models\Settings;
	use App\Models\Products;
	use App\Models\sellers;
	use App\Models\Category;
	use App\Models\Brand;
	use App\Models\Upload;	
    use App\Models\City;
    use App\Models\ProductQuantity;
    use App\Models\ActivityLog;
    use Auth;
    use DB;
	use App\Imports\ProductsImport;

	use App\Imports\BulkImport;
	use Excel;


	use App\Http\Requests\Products\Addform;
		
	class SellerProducts extends Controller	
	{		
	
        protected $data = array();
        protected $page_details =array(
            'page_name'=> 'Product',
            'page_auth'=> 'seller',
        );		
		/**  			
			* Contructor to aunthendicate user			
		*/		
		public function __construct(){			
			$this->middleware('seller');			
		}		
				
		/**			
			* Display a listing of the resource.			
			*			
			* @return \Illuminate\Http\Response			
		*/		
				
		public function index(Request $request){			

			$sellerid=auth()->guard('seller')->user()->id;
			$this->data['senddata'] = Products::where('seller_id','=',$sellerid)->with('product_category')->paginate();
            $this->data['category'] = Category::where('cat_is_parent_id',null)->get();
            $this->data['message'] = 'No Products Added';
            $this->data['add'] = 'products.create';
			$this->data['edit'] = url('seller/product'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');
            return view('seller.product.manage', $this->data);  
		}	

		public function filter(Request $request){

			$sellerid=auth()->guard('seller')->user()->id;

			if($request->category == '' && $request->status == ''){
           		$this->data['senddata'] = Products::where('seller_id','=',$sellerid)->with('product_category')->get();
			}else if($request->category != '' && $request->status == ''){
           		$this->data['senddata'] = Products::where('seller_id','=',$sellerid)->where('product_category_id',$request->category)->with('product_category')->get();
			}else if($request->category == '' && $request->status != ''){
           		$this->data['senddata'] = Products::where('seller_id','=',$sellerid)->where('product_status',$request->status)->with('product_category')->get();
			}else if($request->category != '' && $request->status != ''){
           		$this->data['senddata'] = Products::where('seller_id','=',$sellerid)->where('product_status',$request->status)->where('product_category_id',$request->category)->with('product_category')->get();
			}
			$this->data['category'] = Category::where('cat_is_parent_id',null)->get();
            $this->data['message'] = 'No Products Added';
            $this->data['add'] = 'products.create';
			$this->data['edit'] = url('seller/product'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');

            return view('seller.product.manage_ajax', $this->data);  
		}	
				
		/**			
			* Show the form for creating a new resource.			
			*			
			* @return \Illuminate\Http\Response			
		*/		
		public function create()		
		{			
			
			$this->data['senddata'] = new Products;
			$this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('product.store');
            $this->data['category'] = Category::allcategory();
            $this->data['subcategory'] = Category::allsubcategory();
            $this->data['measurement'] = Measurement::allmeasurement();
			 $this->data['brand'] = Brand::allbrand();
            $this->data['seller'] = sellers::allseller();
			$this->data['method'] = 'POST';
			$this->data['action'] = 'Add';
			$this->data['quantity_count'] = 0;
			return view('seller.product.addedit', $this->data); 		
		}		
				
		/**			
			* Store a newly created resource in storage.			
			*			
			* @param  \Illuminate\Http\Request  $request			
			* @return \Illuminate\Http\Response			
		*/		
		public function store(Addform $request)		
		{			
			
			$data = $request->form_data;

			$file_name="";
			$image = $request->file('main_image');
		  if($image!="")
		  {
		   $destinationPath = public_path('admin/images/products');
              $file_name = time() . "." . $image->getClientOriginalExtension();
			 
              $image->move(public_path('admin/images/products'), $file_name);
		  }
		  
            $insert_array = $request->except(['_token']);
            $insert_array_store = $request->storedetails;
			//$user_details=User::where('user_status','1')->where('user_type','2')->where('deleted_at','=',null)->orderBy('id','desc')->first();

			$insert_array['created_by']=auth()->guard('seller')->user()->id;
			$insert_array['updated_by']=auth()->guard('seller')->user()->id;
			$insert_array['main_image']=$file_name;

				$create_array = new Products;
				$create_array = $create_array->fill($insert_array);
				$create_array->save();
				$product_id=$create_array->product_id;
				
				$files = $request->file('images');					
					if(!empty($files)) {  
						foreach($files as $file){
						$upload=new Upload;
						$upload->image_name= time().$file->getClientOriginalName();
						$upload->product_id= $product_id;
						$upload->created_at=date("Y-m-d H:i:s",time());
						$upload->save();
						
						$file->move('admin/images/products',$upload["image_name"]);
						//$file_id=$Hostel->saveFile($upload);
						//$hostel_img[]=$file_id;
						}
					}

					foreach ($data as $value) {
					$value['product_id'] = $product_id;
	                $product_quantity = ProductQuantity::insert($value);
	            }

	            $activity = new ActivityLog;
				$activity->user_id = Auth::guard('seller')->user()->id;
				$activity->user_type = 'Seller';
				$activity->module = 'Product';
				$activity->activity = 'Product Added';
				$activity->created_at = now();
	            $activity->updated_at = now();
				$activity->save();

				return redirect('seller/product')->with('success', 'Products Added Successfully');
		}		
				
		/**			
			* Display the specified resource.			
			*			
			* @param  int  $id			
			* @return \Illuminate\Http\Response			
		*/		
		public function show($id)		
		{			
			//			
		}		
				
		/**			
			* Show the form for editing the specified resource.			
			*			
			* @param  int  $id			
			* @return \Illuminate\Http\Response			
		*/		
		public function edit($id)		
		{			
			$upload = Upload::where('product_id','=',$id)->get();
			$product_category_id=Products::where('product_id','=',$id)->select('product_category_id')->first()->toArray();			
			$cat_id=$product_category_id['product_category_id'];
			$subcategory=Category::where('cat_is_parent_id','!=',null)->where('cat_is_parent_id','=',$cat_id)->pluck('cat_name','cat_id')->all(); 
			$brand=Brand::where('cat_is_parent_id','=',$cat_id)->pluck('brand_name','id')->all(); 
			$this->data['senddata'] =  Products::find($id);				
			$this->data['upload'] = $upload;	
			$this->data['message'] = 'Update Products';        
            $this->data['method'] = 'PUT';	
            $this->data['category'] = Category::allcategory();
            $this->data['subcategory'] = $subcategory;
            $this->data['brand'] = $brand;
			$this->data['measurement'] = Measurement::allmeasurement();
			$this->data['seller'] = sellers::allseller();
			$this->data['route'] = array('product.update',$id);
			$this->data['page_details'] = $this->page_details;
			$this->data['action'] = 'Edit';
			$this->data['quantity_count'] = ProductQuantity::where('product_id',$id)->count();
			$this->data['product_quantity'] = ProductQuantity::where('product_id',$id)->get();
			return view('seller.product.addedit',$this->data);
		}		
				
		/**			
			* Update the specified resource in storage.			
			*			
			* @param  \Illuminate\Http\Request  $request			
			* @param  int  $id			
			* @return \Illuminate\Http\Response			
		*/		
		public function update(Request $request, $id)		
		{
			
			$product_quantity = ProductQuantity::where('product_id',$id)->delete();
			$data = $request->form_data;

			$image = $request->file('main_image');
			$file_name="";
			
			if($image!="")
			{
			$destinationPath = public_path('admin/images/products');
			$file_name = time() . "." . $image->getClientOriginalExtension();
			 $image->move(public_path('admin/images/products'), $file_name);
			}
			
			$rules=array(
				'product_name'=>'required',
                'product_short_description'=>'required',
                'product_long_description'=>'required',
               // 'product_stock'=>'required',
                'product_price'=>'required',
                'product_tax'=>'required',
                'product_sales_price'=>'required',
				'product_status'=>'required',
				'main_image'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048',
			);
			
			$messages = array(
				'product_name.required' => 'Enter Products Name',       
                'product_short_description.required' => 'Enter Product Short Description',    
                'product_long_description.required' => 'Enter Product Long Description', 
               // 'product_stock.digits' => 'Enter Product Stock', 
                'product_price.required' => 'Enter Product Price', 
                'product_tax.required' => 'Enter Product Tax', 
                'product_sales_price.required' => 'Enter Product Sales Price', 
                'product_status.required' => 'Choose Product Status', 
                'main_image.required|image|mimes:jpeg,png,jpg,gif|max:2048' => 'Choose Product Image', 
			);

            $user_data = $request->except('_token','_method');
			
			
			if($file_name!="")
			$user_data["main_image"]=$file_name;
			else if($request->findremove==1)
			$user_data["main_image"]="";

				$_update_record = Products::find($id);
				$_update_record->fill($user_data);
                $_update_record->save();
				
				
				$files = $request->file('images');					
				if(!empty($files)) {  
					foreach($files as $file){
					$upload=new Upload;
					$upload->image_name= time().$file->getClientOriginalName();
					$upload->product_id= $id;
					$upload->created_at=date("Y-m-d H:i:s",time());
					$upload->save();
					
					$file->move('admin/images/products',$upload["image_name"]);
					//$file_id=$Hostel->saveFile($upload);
					//$hostel_img[]=$file_id;
					}
				}

				foreach ($data as $value) {
					$value['product_id'] = $id;
	                $product_quantity = ProductQuantity::insert($value);
	            }
				  
				$activity = new ActivityLog;
				$activity->user_id = Auth::guard('seller')->user()->id;
				$activity->user_type = 'Seller';
				$activity->module = 'Product';
				$activity->activity = 'Product Updated';
				$acti->created_at = now();
	            $acti->updated_at = now();
				$activity->save();


				return redirect('seller/product')->with('success', 'Products Updated Successfully');

		}		
				
		/**			
			* Remove the specified resource from storage.			
			*			
			* @param  int  $id			
			* @return \Illuminate\Http\Response			
		*/		

		public function deleteProduct(Request $request)		
		{			
			$product = Products::find($request->delete_id);
			$product->delete();

			$activity = new ActivityLog;
			$activity->user_id = Auth::guard('seller')->user()->id;
			$activity->user_type = 'Seller';
			$activity->module = 'Product';
			$activity->activity = 'Product Deleted';
			$activity->created_at = now();
            $activity->updated_at = now();
			$activity->save();

			return redirect()->back()->with('success','Product Deleted Successfully');	
		}
		
		public function remove_images(Request $request)
		{
			$hostel = Upload::find($request->id)->delete();
			//return "hai";
		}
		
		public function uploadview()
		{
			$this->data['senddata']="";
			//$this->data['route'] = array('productsuploadexcel');
			return view('seller.product.uploads', $this->data); 	
		}
		public function uploadexcel(Request $request)
		{
			Excel::import(new ProductsImport, $request->file('file')->store('temp'));
        return back();

		}	
		
		function get_subcategory( Request $request)
		{
		$subcategory = DB::table("category")
        ->where("cat_is_parent_id",$request->cate_id)
        ->pluck("cat_name","cat_id"); 
        return response()->json($subcategory);
		}
		
		function get_brand( Request $request)
		{
		$brand = DB::table("brand")
        ->where("cat_is_parent_id",$request->cate_id)
        ->pluck("brand_name","id"); 
        return response()->json($brand);
		}
	}