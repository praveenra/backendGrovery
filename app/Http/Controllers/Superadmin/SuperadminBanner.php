<?php	
		
	namespace App\Http\Controllers\Superadmin;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\Common;
	use App\Models\User;
    use App\Models\Settings;
    use App\Models\Area;	
    use App\Models\City;
    use App\Models\Banner;	
	use App\Http\Requests\Banner\Addform;
		
	class SuperadminBanner extends Controller	
	{		
        protected $data = array();
        protected $page_details =array(
            'page_name'=> 'Banner',
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

            $this->data['sliders'] = Banner::all();
            $this->data['message'] = 'No Banner Added';
            $this->data['add'] = 'banner.create';
			$this->data['edit'] = url('superadmin/banner'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');
            return view('superadmin.banner.manage', $this->data);  
		}	

		public function filter(Request $request){

            $this->data['sliders'] = Banner::where('banner_status',$request->status)->get();
            $this->data['message'] = 'No Banner Added';
            $this->data['add'] = 'banner.create';
			$this->data['edit'] = url('superadmin/banner'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');

            return view('superadmin.banner.manage_ajax', $this->data);  
			
		}			
				
		/**			
			* Show the form for creating a new resource.			
			*			
			* @return \Illuminate\Http\Response			
		*/		
		public function create()		
		{			
			$this->data['slider'] = new Banner;
			$this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('banner.store');
			$this->data['method'] = 'POST';
			return view('superadmin.banner.addedit', $this->data); 		
		}		
				
		/**			
			* Store a newly created resource in storage.			
			*			
			* @param  \Illuminate\Http\Request  $request			
			* @return \Illuminate\Http\Response			
		*/		
		public function store(Addform $request)		
		{

			$slider = new Banner;			
			$slider->banner_name = $request->banner_name;		
			$image_name = '';
						
			if($request->hasFile('banner_image')){				
				$_image_upload = new Common;				
				$_file_name =  $_image_upload->ImageUpload($request->file('banner_image'), 'slider-');				
				$image_name = $_file_name;				
			}
				
			// $slider->default_image = $request->default_image;	
			if($request->default_image == "default"){
				$count = Banner::where('default_image','default')->count();
			
				if($count > 0){
					return redirect()->back()->with('error','Default Banner Already Exists');
				}else{
					$slider->default_image = $request->default_image;
				}
			}
			


			$slider->banner_image = $image_name;			
			$slider->created_by = auth()->guard('superadmin')->user()->id;			
			$slider->updated_by = auth()->guard('superadmin')->user()->id;			
			$slider->banner_status = $request->banner_status;			
			$slider->start_date = $request->start_date;
			$slider->end_date = $request->end_date;
			$slider->save();



			return redirect()->route('banner.index')->with('success', 'Banner Created Successfully...!');

		}		

		public function edit($id)		
		{			
			$this->data['slider'] =  Banner::find($id);	
			$this->data['message'] = 'Update Banner';        
            $this->data['method'] = 'PUT';	
			$this->data['route'] = array('banner.update',$id);
			$this->data['page_details'] = $this->page_details;
			return view('superadmin.banner.addedit',$this->data);
		}		
	
		public function update(Request $request, $id)		
		{

			$slider = Banner::find($id);			
			$slider->banner_name = $request->banner_name;			
		//	$slider->link = ($request->link) ? $request->link : '';			
			$image_name = $slider->banner_image;			
						
			if($request->hasFile('banner_image')){				
				$_image_upload = new Common;				
				$_file_name =  $_image_upload->ImageUpload($request->file('banner_image'), 'slider-');				
				$image_name = $_file_name;				
			}			
						
			$slider->created_by = auth()->guard('superadmin')->user()->id;			
			$slider->updated_by = auth()->guard('superadmin')->user()->id;			
			$slider->banner_image = $image_name;			
			//$slider->content = ($request->content) ? $request->content : '';			
			$slider->banner_status = $request->banner_status;
			$slider->start_date = $request->start_date;
			$slider->end_date = $request->end_date;		
			$slider->default_image = $request->default_image;		
			$slider->save();	
            return redirect()->route('banner.index')->with('success', 'Banner Updated Successfully...!');
		}		
				
		public function deleteBanner(Request $request)		
		{			
			$user = Banner::find($request->delete_id);
			$user->delete();
			return redirect()->back()->with('success','Banner Deleted Successfully');	
		}

		public function inactiveData(Request $request){

			$change_status = Banner::where('banner_id',$request->id)->first();
			$change_status->banner_status = 0;
			$change_status->save();
		}

		public function activeData(Request $request){
			
			$change_status = Banner::where('banner_id',$request->id)->first();
			$change_status->banner_status = 1;
			$change_status->save();
		}
	}	
