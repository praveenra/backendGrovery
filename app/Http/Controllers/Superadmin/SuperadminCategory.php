<?php	
		
	namespace App\Http\Controllers\Superadmin;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\Common;
	use App\Models\User;
    use App\Models\Settings;
    use App\Models\Area;	
    use App\Models\AreaBanner;
    use App\Models\Category;
    use App\Models\SubSubCategory;
    use App\Models\Products;
    use App\Models\Banner;	
	use App\Http\Requests\Category\Addform;
		
	class SuperadminCategory extends Controller	
	{		
        protected $data = array();
        protected $page_details =array(
            'page_name'=> 'Category',
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
				
		public function index(Request $request){			

            $this->data['sliders'] = Category::where('cat_is_parent_id','=',null)->get();

            $this->data['message'] = 'No Category Added';
            $this->data['add'] = 'category.create';
			$this->data['edit'] = url('superadmin/category'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');
            return view('superadmin.category.manage', $this->data);  
		}		

		public function filter(Request $request){

           $this->data['sliders'] = Category::where('cat_is_parent_id','=',null)->where('cat_status',$request->status)->get();

            $this->data['message'] = 'No Category Added';
            $this->data['add'] = 'category.create';
			$this->data['edit'] = url('superadmin/category'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');

            return view('superadmin.category.manage_ajax', $this->data);  
			
		}		
				
		/**			
			* Show the form for creating a new resource.			
			*			
			* @return \Illuminate\Http\Response			
		*/		
		public function create()		
		{			
            $this->data['slider'] = new Category;
           // $this->data['areas'] = Area::allareas();
			$this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('category.store');
			$this->data['method'] = 'POST';
			return view('superadmin.category.addedit', $this->data); 		
		}		
				
		/**			
			* Store a newly created resource in storage.			
			*			
			* @param  \Illuminate\Http\Request  $request			
			* @return \Illuminate\Http\Response			
		*/		
		public function store(Addform $request)		
		{	

			$slider = new Category;			
            $slider->cat_name = $request->cat_name;			
			$image_name = '';			
						
			if($request->hasFile('cat_image')){				
				$_image_upload = new Common;				
				$_file_name =  $_image_upload->ImageUpload($request->file('cat_image'), 'category-');				
				$image_name = $_file_name;				
			}			
						
			$slider->cat_image = $image_name;			
			$slider->created_by = auth()->guard('superadmin')->user()->id;			
			$slider->updated_by = auth()->guard('superadmin')->user()->id;			
			$slider->cat_status = $request->cat_status;			
			$slider->save();			
			return redirect()->route('category.index')->with('success', 'Category Created Successfully...!');	
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
            $this->data['slider'] =  Category::find($id);	
           // $this->data['areas'] = Area::allareas();
			$this->data['message'] = 'Update Category';        
            $this->data['method'] = 'PUT';	
			$this->data['route'] = array('category.update',$id);
			$this->data['page_details'] = $this->page_details;
			return view('superadmin.category.addedit',$this->data);
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
			$slider = Category::find($id);			
         //   $slider->ab_area_id = $request->ab_area_id;
            $slider->cat_name = $request->cat_name;			
		//	$slider->link = ($request->link) ? $request->link : '';			
			$image_name = $slider->cat_image;			
						
			if($request->hasFile('cat_image')){				
				$_image_upload = new Common;				
				$_file_name =  $_image_upload->ImageUpload($request->file('cat_image'), 'Category-');				
				$image_name = $_file_name;				
			}			
						
			$slider->created_by = auth()->guard('superadmin')->user()->id;			
			$slider->updated_by = auth()->guard('superadmin')->user()->id;			
			$slider->cat_image = $image_name;			
			//$slider->content = ($request->content) ? $request->content : '';			
			$slider->cat_status = $request->cat_status;			
			$slider->save();
            return redirect()->route('category.index')->with('success', 'Category Updated Successfully...!');
		}		
				
		/**			
			* Remove the specified resource from storage.			
			*			
			* @param  int  $id			
			* @return \Illuminate\Http\Response			
		*/		
		public function deleteCategory(Request $request)		
		{			
			$user = Category::find($request->delete_id);
			$user->delete();
			return redirect()->back()->with('success','Category Deleted Successfully');	
		}

		public function inactiveData(Request $request){

			$change_status = Category::where('cat_id',$request->id)->first();
			$change_status->cat_status = 0;
			$change_status->save();

			$subcategory = Category::where('cat_is_parent_id',$request->id)->update(['cat_status' => 0]);
			$subsubcategory = SubSubCategory::where('category_id',$request->id)->update(['status' => 0]);
			$products = Products::where('product_category_id',$request->id)->update(['product_status' => 0]);
		}

		public function activeData(Request $request){
			
			$change_status = Category::where('cat_id',$request->id)->first();
			$change_status->cat_status = 1;
			$change_status->save();

			$subcategory = Category::where('cat_is_parent_id',$request->id)->update(['cat_status' => 1]);
			$subsubcategory = SubSubCategory::where('category_id',$request->id)->update(['status' => 1]);
			$products = Products::where('product_category_id',$request->id)->update(['product_status' => 1]);
		}
	}	
