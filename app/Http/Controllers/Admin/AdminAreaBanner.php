<?php	
		
	namespace App\Http\Controllers\Admin;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\Common;
	use App\Models\User;
    use App\Models\Settings;
    use App\Models\Area;	
    use App\Models\AreaBanner;
    use App\Models\Banner;	
    use App\Models\Maincategory;
	use App\Models\ActivityLog;
	use Auth;
	use App\Http\Requests\AreaBanner\Addform;
		
	class AdminAreaBanner extends Controller	
	{		
        protected $data = array();
        protected $page_details =array(
            'page_name'=> 'Area Banner',
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
				
		public function index(Request $request){			

            $this->data['sliders'] = AreaBanner::with('areabanner')->paginate();

            $this->data['message'] = 'No AreaBanner Added';
            $this->data['add'] = 'areabanneradmin.create';
			$this->data['edit'] = url('admin/areabanneradmin'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');
            return view('admin.areabanner.manage', $this->data);  
		}		
		
		public function filter(Request $request){

            $this->data['sliders'] = AreaBanner::where('ab_status',$request->status)->with('areabanner')->get();

            $this->data['message'] = 'No AreaBanner Added';
            $this->data['add'] = 'areabanneradmin.create';
			$this->data['edit'] = url('admin/areabanneradmin'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');

            return view('admin.areabanner.manage_ajax', $this->data);  
			
		}			
		/**			
			* Show the form for creating a new resource.			
			*			
			* @return \Illuminate\Http\Response			
		*/		
		public function create()		
		{			
            $this->data['slider'] = new AreaBanner;
            $this->data['areas'] = Area::allareas();
			$this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('areabanneradmin.store');
			$this->data['method'] = 'POST';
			$this->data['main_categories'] = Maincategory::where('mc_status',1)->get();
			return view('admin.areabanner.addedit', $this->data); 		
		}		
				
		/**			
			* Store a newly created resource in storage.			
			*			
			* @param  \Illuminate\Http\Request  $request			
			* @return \Illuminate\Http\Response			
		*/		
		public function store(Addform $request)		
		{	

			$slider = new AreaBanner;			
            $slider->ab_name = $request->ab_name;	
            $slider->ab_area_id = $request->ab_area_id;		
            $slider->mc_id = $request->mc_id;
			$image_name = '';			
						
			if($request->hasFile('ab_image')){				
				$_image_upload = new Common;				
				$_file_name =  $_image_upload->ImageUpload($request->file('ab_image'), 'slider-');				
				$image_name = $_file_name;				
			}			
						
			$slider->ab_image = $image_name;			
			$slider->created_by = auth()->guard('admin')->user()->id;			
			$slider->updated_by = auth()->guard('admin')->user()->id;			
			$slider->ab_status = $request->ab_status;	
			$slider->start_date = $request->start_date;
			$slider->end_date = $request->end_date;		
			$slider->save();		

			$activity = new ActivityLog;
			$activity->user_id = Auth::guard('admin')->user()->id;
			$activity->user_type = 'Admin';
			$activity->module = 'Area Banner';
			$activity->activity = 'Area Banner Added';
			$activity->created_at = now();
	            $activity->updated_at = now();
			$activity->save();

			return redirect()->route('areabanneradmin.index')->with('success', 'AreaBanner Created Successfully...!');	
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
            $this->data['slider'] =  AreaBanner::find($id);	
            $this->data['areas'] = Area::allareas();
			$this->data['message'] = 'Update Banner';        
            $this->data['method'] = 'PUT';	
			$this->data['route'] = array('areabanneradmin.update',$id);
			$this->data['page_details'] = $this->page_details;
			$this->data['main_categories'] = Maincategory::where('mc_status',1)->get();
			return view('admin.areabanner.addedit',$this->data);
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
			$slider = AreaBanner::find($id);			
            $slider->ab_area_id = $request->ab_area_id;
            $slider->ab_name = $request->ab_name;
            $slider->mc_id = $request->mc_id;		
		//	$slider->link = ($request->link) ? $request->link : '';			
			$image_name = $slider->ab_image;			
						
			if($request->hasFile('ab_image')){				
				$_image_upload = new Common;				
				$_file_name =  $_image_upload->ImageUpload($request->file('ab_image'), 'slider-');				
				$image_name = $_file_name;				
			}			
						
			$slider->created_by = auth()->guard('admin')->user()->id;			
			$slider->updated_by = auth()->guard('admin')->user()->id;			
			$slider->ab_image = $image_name;			
			//$slider->content = ($request->content) ? $request->content : '';			
			$slider->ab_status = $request->ab_status;
			$slider->start_date = $request->start_date;
			$slider->end_date = $request->end_date;		
			$slider->save();

			$activity = new ActivityLog;
			$activity->user_id = Auth::guard('admin')->user()->id;
			$activity->user_type = 'Admin';
			$activity->module = 'Area';
			$activity->activity = 'User updated Area Banner';
			$activity->created_at = now();
	            $activity->updated_at = now();
			$activity->save();

            return redirect()->route('areabanneradmin.index')->with('success', 'Banner Updated Successfully...!');
		}		
				
		/**			
			* Remove the specified resource from storage.			
			*			
			* @param  int  $id			
			* @return \Illuminate\Http\Response			
		*/		
		public function deleteAreaBanner(Request $request)		
		{			
			$user = AreaBanner::find($request->delete_id);
			$user->delete();

			$activity = new ActivityLog;
			$activity->user_id = Auth::guard('admin')->user()->id;
			$activity->user_type = 'Admin';
			$activity->module = 'Area';
			$activity->activity = 'User deleted Area Banner';
			$activity->created_at = now();
	        $activity->updated_at = now();
			$activity->save();

			return redirect()->back()->with('success','AreaBanner Deleted Successfully');	
		}		
	}	
