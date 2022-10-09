<?php	
		
	namespace App\Http\Controllers\Admin;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\Common;
	use App\Models\User;
    use App\Models\Settings;
    use App\Models\Seller;	
	use App\Models\City;
	use App\Models\Offer;
	use App\Models\Maincategory;
	use App\Models\ActivityLog;
	use Auth;
	use App\Http\Requests\Offer\Addform;
		
	class AdminOffer extends Controller	
	{		
        protected $data = array();
        protected $page_details =array(
            'page_name'=> 'Offer',
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

            $this->data['senddata'] = Offer::paginate();
            $this->data['message'] = 'No Offer Added';
            $this->data['add'] = 'offer.create';
			$this->data['edit'] = url('admin/offer'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');
            return view('admin.offer.manage', $this->data);  
		}		


		public function filter(Request $request){

           $this->data['senddata'] = Offer::where('status',$request->status)->get();
            $this->data['message'] = 'No Offer Added';
            $this->data['add'] = 'offer.create';
			$this->data['edit'] = url('admin/offer'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');
            return view('admin.offer.manage_ajax', $this->data);  

		}	
				
		/**			
			* Show the form for creating a new resource.			
			*			
			* @return \Illuminate\Http\Response			
		*/		
		public function create()		
		{			
			$this->data['senddata'] = new Offer;
			$this->data['main_categories'] = Maincategory::where('mc_status',1)->get();
			$this->data['code'] = "1";
			
			$this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('offer.store');
			$this->data['method'] = 'POST';
			return view('admin.offer.addedit', $this->data); 		
		}		
				
		/**			
			* Store a newly created resource in storage.			
			*			
			* @param  \Illuminate\Http\Request  $request			
			* @return \Illuminate\Http\Response			
		*/		
		public function store(Addform $request)		
		{			

			
            $insert_array = $request->except(['_token']);

			$insert_array['created_by']=auth()->guard('admin')->user()->id;
			$insert_array['updated_by']=auth()->guard('admin')->user()->id;
			try{
				$create_array = new Offer;
				$create_array = $create_array->fill($insert_array);
				$create_array->created_at = now();
				$create_array->updated_at = NULL;
				$create_array->save();

				$activity = new ActivityLog;
				$activity->user_id = Auth::guard('admin')->user()->id;
				$activity->user_type = 'Admin';
				$activity->module = 'Offer';
				$activity->activity = 'Offer Added';
				$activity->created_at = now();
		        $activity->updated_at = now();
				$activity->save();

				return redirect('admin/offer')->with('success', 'Offer Added Successfully');
				
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
			$this->data['senddata'] =  Offer::find($id);
			$this->data['main_categories'] = Maincategory::where('mc_status',1)->get();
			$this->data['code'] = "2";			
			$this->data['message'] = 'Update Offer';        
            $this->data['method'] = 'PUT';
			$this->data['route'] = array('offer.update',$id);
			$this->data['page_details'] = $this->page_details;
			return view('admin.offer.addedit',$this->data);
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
				'name'=>'required',
                'amount'=>'required',
                'offer_condition'=>'required',
                'code'=>'required',
                'status'=>'required',
			);
			$messages = array(
				'name.required' => 'Enter Name',
				'amount.required' => 'Enter Amount',        
				'offer_condition.required' => 'Enter Offer Condition',        
				'code.required' => 'Enter Code', 
				'status.required' => 'Choose Status', 
			);

            $user_data = $request->except('_token','_method');

			try{
				$_update_record = Offer::find($id);
				$_update_record->fill($user_data);
				$_update_record->updated_at = now();
                $_update_record->save();


                $activity = new ActivityLog;
				$activity->user_id = Auth::guard('admin')->user()->id;
				$activity->user_type = 'Admin';
				$activity->module = 'Offer';
				$activity->activity = 'Offer Updated';
				$activity->created_at = now();
		        $activity->updated_at = now();
				$activity->save();

				return redirect('admin/offer')->with('success', 'Offer Updated Successfully');
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
		public function deleteOffer(Request $request)		
		{			
			$user = Offer::find($request->delete_id);
			$user->delete();

			$activity = new ActivityLog;
			$activity->user_id = Auth::guard('admin')->user()->id;
			$activity->user_type = 'Admin';
			$activity->module = 'Offer';
			$activity->activity = 'Offer Deleted';
			$activity->created_at = now();
		    $activity->updated_at = now();
			$activity->save();

			return redirect()->back()->with('success','Offer Deleted Successfully');	
		}		
	}	
