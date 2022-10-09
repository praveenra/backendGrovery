<?php	
		
	namespace App\Http\Controllers\Superadmin;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\Common;
	use App\Models\User;
    use App\Models\Settings;
    use App\Models\Brand;
    use App\Models\Area;	
    use App\Models\AreaBanner;
    use App\Models\Category;
    use App\Models\Banner;	
	use App\Http\Requests\Brand\Addform;
		
	class SuperadminBrand extends Controller	
	{		
        protected $data = array();
        protected $page_details =array(
            'page_name'=> 'Brand',
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

            $this->data['senddata'] = Brand::paginate();
            $category=Category::where('cat_is_parent_id','=',null)->paginate();
			$category_list=array();
			foreach($category as $key=>$value){
				$category_list[$value->cat_id]=$value->cat_name;	 
			}
			$this->data['category_list'] = $category_list;
            $this->data['category'] = Category::where('cat_is_parent_id',null)->get();
            $this->data['message'] = 'No Brand Added';
            $this->data['add'] = 'brand.create';
			$this->data['edit'] = url('superadmin/brand'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');
            return view('superadmin.brand.manage', $this->data);  
		}		

		public function filter(Request $request){

           $this->data['senddata'] = Brand::where('brand_status',$request->status)->get();

           	if($request->category == '' && $request->status == ''){
				$this->data['senddata'] = Brand::all();
			}else if($request->category != '' && $request->status == ''){
				$this->data['senddata'] = Brand::where('cat_is_parent_id',$request->category)->get();

			}else if($request->category == '' && $request->status != ''){
           		$this->data['senddata'] = Brand::where('brand_status',$request->status)->get();
			}else if($request->category != '' && $request->status != ''){
           		$this->data['senddata'] = Brand::where('brand_status',$request->status)->where('cat_is_parent_id',$request->category)->get();
			}

            $category=Category::where('cat_is_parent_id','=',null)->paginate();
			$category_list=array();
			foreach($category as $key=>$value){
				$category_list[$value->cat_id]=$value->cat_name;	 
			}
			$this->data['category_list'] = $category_list;
            $this->data['message'] = 'No Brand Added';
            $this->data['add'] = 'brand.create';
			$this->data['edit'] = url('superadmin/brand'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');
            
            return view('superadmin.brand.manage_ajax', $this->data);  
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
            $this->data['route'] = array('brand.store');
			$this->data['method'] = 'POST';
			return view('superadmin.brand.addedit', $this->data); 		
		}		
				
		/**			
			* Store a newly created resource in storage.			
			*			
			* @param  \Illuminate\Http\Request  $request			
			* @return \Illuminate\Http\Response			
		*/		
		public function store(Addform $request)		
		{	

			$slider = new Brand;			
            $slider->brand_name = $request->brand_name;
            $slider->cat_is_parent_id = $request->cat_is_parent_id;			
				
			$slider->created_by = auth()->guard('superadmin')->user()->id;			
			$slider->updated_by = auth()->guard('superadmin')->user()->id;			
			$slider->brand_status = $request->brand_status;			
			$slider->save();			
			return redirect()->route('brand.index')->with('success', 'Brand Created Successfully...!');	
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
            $this->data['slider'] =  Brand::find($id);	
            $this->data['category'] = Category::allcategory();
			$this->data['message'] = 'Update Brand';        
            $this->data['method'] = 'PUT';	
			$this->data['route'] = array('brand.update',$id);
			$this->data['page_details'] = $this->page_details;
			return view('superadmin.brand.addedit',$this->data);
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
			$slider = Brand::find($id);			
            $slider->cat_is_parent_id = $request->cat_is_parent_id;
            $slider->brand_name = $request->brand_name;			
			
			$slider->created_by = auth()->guard('superadmin')->user()->id;			
			$slider->updated_by = auth()->guard('superadmin')->user()->id;			
					
			$slider->brand_status = $request->brand_status;			
			$slider->save();
            return redirect()->route('brand.index')->with('success', 'Brand Updated Successfully...!');
		}		
				
		/**			
			* Remove the specified resource from storage.			
			*			
			* @param  int  $id			
			* @return \Illuminate\Http\Response			
		*/		
		public function deleteBrand(Request $request)		
		{			
			$user = Brand::find($request->delete_id);
			$user->delete();
			return redirect()->back()->with('success','Brand Deleted Successfully');	
		}

		public function inactiveData(Request $request){

			$change_status = Brand::where('id',$request->id)->first();
			$change_status->brand_status = 0;
			$change_status->save();
		}

		public function activeData(Request $request){
			
			$change_status = Brand::where('id',$request->id)->first();
			$change_status->brand_status = 1;
			$change_status->save();
		}		
	}	
