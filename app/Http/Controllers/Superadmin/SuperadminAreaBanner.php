<?php	
		
	namespace App\Http\Controllers\Superadmin;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\Common;
	use App\Models\User;
    use App\Models\Settings;
    use App\Models\Area;	
    use App\Models\AreaBanner;
    use App\Models\Banner;	
    use App\Models\Maincategory;	
	use App\Http\Requests\AreaBanner\Addform;
		
	class SuperadminAreaBanner extends Controller	
	{		
        protected $data = array();
        protected $page_details =array(
            'page_name'=> 'Area Banner',
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

            $this->data['sliders'] = AreaBanner::with('areabanner')->paginate();

            $this->data['message'] = 'No AreaBanner Added';
            $this->data['add'] = 'areabanner.create';
			$this->data['edit'] = url('superadmin/areabanner'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');
            return view('superadmin.areabanner.manage', $this->data);  
		}		
		
		public function filter(Request $request){

            $this->data['sliders'] = AreaBanner::where('ab_status',$request->status)->with('areabanner')->get();

            $this->data['message'] = 'No AreaBanner Added';
            $this->data['add'] = 'areabanner.create';
			$this->data['edit'] = url('superadmin/areabanner'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');

            return view('superadmin.areabanner.manage_ajax', $this->data);  
			
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
            $this->data['route'] = array('areabanner.store');
			$this->data['method'] = 'POST';
			$this->data['main_categories'] = Maincategory::where('mc_status',1)->get();
			return view('superadmin.areabanner.addedit', $this->data); 		
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
			$slider->created_by = auth()->guard('superadmin')->user()->id;			
			$slider->updated_by = auth()->guard('superadmin')->user()->id;			
			$slider->ab_status = $request->ab_status;	
			$slider->start_date = $request->start_date;
			$slider->end_date = $request->end_date;		
			$slider->save();			
			return redirect()->route('areabanner.index')->with('success', 'AreaBanner Created Successfully...!');	
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
			$this->data['route'] = array('areabanner.update',$id);
			$this->data['page_details'] = $this->page_details;
			$this->data['main_categories'] = Maincategory::where('mc_status',1)->get();
			return view('superadmin.areabanner.addedit',$this->data);
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
						
			$slider->created_by = auth()->guard('superadmin')->user()->id;			
			$slider->updated_by = auth()->guard('superadmin')->user()->id;			
			$slider->ab_image = $image_name;			
			//$slider->content = ($request->content) ? $request->content : '';			
			$slider->ab_status = $request->ab_status;
			$slider->start_date = $request->start_date;
			$slider->end_date = $request->end_date;		
			$slider->save();
            return redirect()->route('areabanner.index')->with('success', 'Banner Updated Successfully...!');
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
			return redirect()->back()->with('success','AreaBanner Deleted Successfully');	
		}

		public function inactiveData(Request $request){

			$change_status = AreaBanner::where('ab_id',$request->id)->first();
			$change_status->ab_status = 0;
			$change_status->save();
		}

		public function activeData(Request $request){
			
			$change_status = AreaBanner::where('ab_id',$request->id)->first();
			$change_status->ab_status = 1;
			$change_status->save();
		}
	}	
