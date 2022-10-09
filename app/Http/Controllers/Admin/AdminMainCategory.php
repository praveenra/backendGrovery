<?php	
		
	namespace App\Http\Controllers\Admin;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\Common;
	use App\Models\User;
    use App\Models\Settings;
	use App\Models\Products;
	use App\Models\Category;
    use App\Models\Maincategory;
    use App\Models\Seller;	
    use App\Models\City;
	use App\Models\ActivityLog;
	use Auth;
	use App\Http\Requests\MainCategory\Addform;
		
	class AdminMainCategory extends Controller	
	{		
        protected $data = array();
        protected $page_details =array(
            'page_name'=> 'Maincategory',
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

            $this->data['senddata'] = Maincategory::with('category_seller')->paginate();
            $this->data['message'] = 'No Maincategory Added';
            $this->data['add'] = 'maincategoryadmin.create';
			$this->data['edit'] = url('admin/maincategoryadmin'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');
            return view('admin.maincategory.manage', $this->data);  
		}	

		public function filter(Request $request){

            $this->data['senddata'] = Maincategory::where('mc_status',$request->status)->with('category_seller')->paginate();
            $this->data['message'] = 'No Maincategory Added';
            $this->data['add'] = 'maincategoryadmin.create';
			$this->data['edit'] = url('admin/maincategoryadmin'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');

            return view('admin.maincategory.manage_ajax', $this->data);  
			
		}		
				
		/**			
			* Show the form for creating a new resource.			
			*			
			* @return \Illuminate\Http\Response			
		*/		
		public function create()		
		{			
			$this->data['senddata'] = new Maincategory;
			$this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('maincategoryadmin.store');
            $this->data['Seller'] = User::allseller();
			$this->data['method'] = 'POST';
			return view('admin.maincategory.addedit', $this->data); 		
		}		
				
		/**			
			* Store a newly created resource in storage.			
			*			
			* @param  \Illuminate\Http\Request  $request			
			* @return \Illuminate\Http\Response			
		*/		
		public function store(Addform $request)		
		{			

			$image = $request->file('image');
			
			$file_name="";
			
			if($image!="")
			{
			$destinationPath = public_path('admin/images/category');
			$file_name = time() . "." . $image->getClientOriginalExtension();
			 $image->move('admin/images/category', $file_name);
			}
		
            $insert_array = $request->except(['_token']);
            $insert_array_store = $request->storedetails;
			//$user_details=User::where('user_status','1')->where('user_type','2')->where('deleted_at','=',null)->orderBy('id','desc')->first();

			$insert_array['created_by']=auth()->guard('admin')->user()->id;
			$insert_array['updated_by']=auth()->guard('admin')->user()->id;
			if($image!="")
			{
			$insert_array['image']=$file_name;
			}
			try{
				$create_array = new Maincategory;
				$create_array = $create_array->fill($insert_array);
				$create_array->save();

				$activity = new ActivityLog;
				$activity->user_id = Auth::guard('admin')->user()->id;
				$activity->user_type = 'Admin';
				$activity->module = 'Main Category';
				$activity->activity = 'Main Category Added';
				$activity->created_at = now();
	        	$activity->updated_at = now();
				$activity->save();

				return redirect('admin/maincategoryadmin')->with('success', 'Maincategory Added Successfully');
				
			}
			catch(\Illuminate\Database\QueryException $e){ 
				return redirect()->back()->withInput()->with('failure', $e->getMessage());
			}
			catch (Exception $e){
				report($e);
				return redirect()->back()->withInput()->with('failure', $e->getMessage());
			}
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
			$this->data['senddata'] =  Maincategory::find($id);	
			$this->data['message'] = 'Update Products';        
            $this->data['method'] = 'PUT';	
            $this->data['Seller'] = User::allseller();
			$this->data['route'] = array('maincategoryadmin.update',$id);
			$this->data['page_details'] = $this->page_details;
			return view('admin.maincategory.addedit',$this->data);
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
			$rules=array(
				'mc_name'=>'required',
                'mc_seller_id'=>'required',
                'mc_commision'=>'required',
                'mc_status'=>'required',
			);
			
			$messages = array(
				'mc_name.required' => 'Enter Maincategory Name',       
                'mc_seller_id.required' => 'Choose Maincategory Seller',    
                'mc_commision.required' => 'Enter Maincategory Commission', 
                'mc_status.digits' => 'Choose Maincategory Status', 
			);
			
			
			$image = $request->file('image');
		$file_name="";
		
		if($image!="")
		{
		$destinationPath = public_path('admin/images/category');
        $file_name = time() . "." . $image->getClientOriginalExtension();
		 $image->move('admin/images/category', $file_name);
		}

            $user_data = $request->except('_token','_method');
			
			if($file_name!="")
				$user_data['image']=$file_name;
			else if($request->findremove==1)
				$user_data['image']="";

			try{
				$_update_record = Maincategory::find($id);
				$_update_record->fill($user_data);
                $_update_record->save();

                $activity = new ActivityLog;
				$activity->user_id = Auth::guard('admin')->user()->id;
				$activity->user_type = 'Admin';
				$activity->module = 'Main Category';
				$activity->activity = 'Main Category Updated';
				$activity->created_at = now();
	        	$activity->updated_at = now();
				$activity->save();


				return redirect('admin/maincategoryadmin')->with('success', 'Maincategory Updated Successfully');
			}
			catch(\Illuminate\Database\QueryException $e){ 
				return redirect()->back()->withInput()->with('failure', $e->getMessage());
			}
			catch (Exception $e){
				report($e);
				return redirect()->back()->withInput()->with('failure', $e->getMessage());
			}

		}		
				
		/**			
			* Remove the specified resource from storage.			
			*			
			* @param  int  $id			
			* @return \Illuminate\Http\Response			
		*/		
		public function deleteMainCategory(Request $request)		
		{			
			$user = Maincategory::find($request->delete_id);
			$user->delete();

			$activity = new ActivityLog;
			$activity->user_id = Auth::guard('admin')->user()->id;
			$activity->user_type = 'Admin';
			$activity->module = 'Main Category';
			$activity->activity = 'Main Category Deleted';
			$activity->created_at = now();
	        $activity->updated_at = now();
			$activity->save();

			return redirect()->back()->with('success','Main Category Deleted Successfully');	
		}		
	}	
