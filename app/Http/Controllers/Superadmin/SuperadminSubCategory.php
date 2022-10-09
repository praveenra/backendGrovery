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
    use App\Models\Banner;
    use App\Models\SubSubCategory;
    use App\Models\Products;
	use App\Http\Requests\Subcategory\Addform;
		
	class SuperadminSubCategory extends Controller	
	{		
        protected $data = array();
        protected $page_details =array(
            'page_name'=> 'SubCategory',
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

            $this->data['sliders'] = Category::where('cat_is_parent_id','!=',null)->with('subcategory')->get();
            $this->data['category'] = Category::where('cat_is_parent_id',null)->get();
            $this->data['message'] = 'No SubCategory Added';
            $this->data['add'] = 'subcategory.create';
			$this->data['edit'] = url('superadmin/subcategory'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');
            return view('superadmin.subcategory.manage', $this->data);  
		}	

		public function filter(Request $request){

			if($request->category == '' && $request->status == ''){
					$this->data['sliders'] = Category::where('cat_is_parent_id','!=',null)->with('subcategory')->get();
			}else if($request->category != '' && $request->status == ''){
					$this->data['sliders'] = Category::where('cat_is_parent_id','!=',null)->where('cat_is_parent_id',$request->category)->with('subcategory')->get();
			}else if($request->category == '' && $request->status != ''){
					$this->data['sliders'] = Category::where('cat_is_parent_id','!=',null)->with('subcategory')->where('cat_status',$request->status)->get();
			}else if($request->category != '' && $request->status != ''){
					$this->data['sliders'] = Category::where('cat_is_parent_id','!=',null)->with('subcategory')->where('cat_status',$request->status)->where('cat_is_parent_id',$request->category)->get();
			}
            $this->data['message'] = 'No SubCategory Added';
            $this->data['add'] = 'subcategory.create';
			$this->data['edit'] = url('superadmin/subcategory'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');

            return view('superadmin.subcategory.manage_ajax', $this->data);  
			
		}		
				
		/**			
			* Show the form for creating a new resource.			
			*			
			* @return \Illuminate\Http\Response			
		*/		
		public function create()		
		{			
            $this->data['slider'] = new Category;
            $this->data['category'] = Category::allcategory();
			$this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('subcategory.store');
			$this->data['method'] = 'POST';
			return view('superadmin.subcategory.addedit', $this->data); 		
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
            $slider->cat_is_parent_id = $request->cat_is_parent_id;			
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
			return redirect()->route('subcategory.index')->with('success', 'Sub Category Created Successfully...!');	
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
            $this->data['category'] = Category::allcategory();
			$this->data['message'] = 'Update Category';        
            $this->data['method'] = 'PUT';	
			$this->data['route'] = array('subcategory.update',$id);
			$this->data['page_details'] = $this->page_details;
			return view('superadmin.subcategory.addedit',$this->data);
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
            $slider->cat_is_parent_id = $request->cat_is_parent_id;
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
            return redirect()->route('subcategory.index')->with('success', 'Sub Category Updated Successfully...!');
		}		
				
		/**			
			* Remove the specified resource from storage.			
			*			
			* @param  int  $id			
			* @return \Illuminate\Http\Response			
		*/		
		public function deleteSubCategory(Request $request)		
		{			
			$user = Category::find($request->delete_id);
			$user->delete();
			return redirect()->back()->with('success','Sub Category Deleted Successfully');	
		}

		public function inactiveData(Request $request){

			$change_status = Category::where('cat_id',$request->id)->first();
			$change_status->cat_status = 0;
			$change_status->save();

			$subsubcategory = SubSubCategory::where('sub_category_id',$request->id)->update(['status' => 0]);
			$products = Products::where('sub_category_id',$request->id)->update(['product_status' => 0]);
		}

		public function activeData(Request $request){
			
			$change_status = Category::where('cat_id',$request->id)->first();
			$change_status->cat_status = 1;
			$change_status->save();

			$subsubcategory = SubSubCategory::where('sub_category_id',$request->id)->update(['status' => 1]);
			$products = Products::where('sub_category_id',$request->id)->update(['product_status' => 1]);
		}

	}	
