<?php	
		
	namespace App\Http\Controllers\Admin;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\Common;
	use App\Models\User;
    use App\Models\Settings;
    use App\Models\Seller;	
    use App\Models\City;
	use App\Http\Requests\Seller\Addform;
	use App\Models\Maincategory;
	use App\Exports\SellersExport;
	use App\Models\ActivityLog;
	use Auth;
	use Maatwebsite\Excel\Facades\Excel;
		
	class AdminSeller extends Controller	
	{		
        protected $data = array();
        protected $page_details =array(
            'page_name'=> 'Seller',
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

            $this->data['senddata'] = User::where('user_type',2)->with('storedetails')->paginate();
            $this->data['main_categories'] = Maincategory::where('mc_status',1)->get();
            $this->data['message'] = 'No Seller Added';
            $this->data['add'] = 'selleradmin.create';
			$this->data['edit'] = url('admin/selleradmin'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');
            return view('admin.seller.manage', $this->data);  
		}	

		public function filter(Request $request){

			if($request->status != '' && $request->mc == ''){
            	$this->data['senddata'] = User::where('user_type',2)->where('user_status',$request->status)->with('storedetails')->paginate();
			}

			if($request->status == '' && $request->mc != ''){
				$this->data['senddata'] = User::select('users.*','seller_details.*')->where('users.user_type',2)->where('seller_details.main_category',$request->mc)->with('storedetails')->leftjoin('seller_details','seller_details.sd_usid','users.id')->paginate();
			}

			if($request->status != '' && $request->mc != ''){
				$this->data['senddata'] = User::select('users.*','seller_details.*')->where('user_type',2)->where('user_status',$request->status)->where('seller_details.main_category',$request->mc)->leftjoin('seller_details','seller_details.sd_usid','users.id')->with('storedetails')->paginate();
			}

			if($request->status == '' && $request->mc == ''){
				$this->data['senddata'] = User::where('user_type',2)->with('storedetails')->paginate();
			}
			
            $this->data['edit'] = url('admin/selleradmin'); 

            return view('admin.seller.manage_ajax', $this->data);  
			
		}		
				
		/**			
			* Show the form for creating a new resource.			
			*			
			* @return \Illuminate\Http\Response			
		*/		
		public function create()		
		{			
			$this->data['senddata'] = new User;
			$this->data['main_category'] = Maincategory::allmaincategory();
			$this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('selleradmin.store');
            $this->data['cityvalue'] = City::allcities();
			$this->data['method'] = 'POST';
			return view('admin.seller.addedit', $this->data); 		
		}


				
		/**			
			* Store a newly created resource in storage.			
			*			
			* @param  \Illuminate\Http\Request  $request			
			* @return \Illuminate\Http\Response			
		*/		
		public function store(Addform $request)		
		{			

            $insert_array = $request->except(['_token','storedetails']);
            $insert_array_store = $request->storedetails;
			$user_details=User::where('user_status','1')->where('user_type','2')->where('deleted_at','=',null)->orderBy('id','desc')->first();
			$insert_array['user_type']=2;
			$insert_array['user_status']=1;
			$insert_array['password_user']=$insert_array['password'];
			$insert_array['password']=bcrypt($insert_array['password']);
			$insert_array['created_by']=auth()->guard('admin')->user()->id;
			$insert_array['updated_by']=auth()->guard('admin')->user()->id;
			try{
				$create_array = new User;
				$create_array = $create_array->fill($insert_array);
				$create_array->save();
				$user_pref_id=Settings::where('s_id',2)->where('s_status',1)->first();
				
				if($user_details){
					$last_user_code=$user_details->user_id;
					$code=substr($last_user_code,-4);
					$code= $code + 1;
					$custid = ($code < 10 ? '0'.$code : $code);
					$custid = str_pad($custid, 4, '0', STR_PAD_LEFT);
					$userid = $user_pref_id->s_content.$custid;
	
				}else{
					$userid = $user_pref_id->s_content ."0001";
				}

				$image = $request->file('store_image');
				
				if($image!=""){
					$destinationPath = public_path('admin/images/store_image');
					$file_name = time() . "." . $image->getClientOriginalExtension();
				 	$image->move('admin/images/store_image', $file_name);
				}

				$image1 = $request->file('store_logo');
				
				if($image1!=""){
					$destinationPath = public_path('admin/images/store_logo');
					$file_name1 = time() . "." . $image1->getClientOriginalExtension();
				 	$image1->move('admin/images/store_logo', $file_name1);
				}

                User::find($create_array->id)->update(array('user_id'=>$userid));
                if($insert_array_store){
                    $store_array=array(
                        'sd_usid'=>$create_array->id,
                        'sd_sname'=>$insert_array_store['sd_sname'],
                        'sd_snumber'=>$insert_array_store['sd_snumber'],
                        'sd_sadminshare'=>$insert_array_store['sd_sadminshare'],
                        'sd_scityid'=>$insert_array_store['sd_scityid'],
                        'sd_sdeliverykm'=>$insert_array_store['sd_sdeliverykm'],
                        'sd_spincode'=>$insert_array_store['sd_spincode'],
                        'sd_address'=>$insert_array_store['sd_address'],
                        'main_category'=>$insert_array_store['main_category'],
                        'sd_status'=>1,
                    );
                    $create_store = new Seller;
                    $create_store = $create_store->fill($store_array);
                    $create_store->store_image = $file_name;
                    $create_store->store_logo = $file_name1;
                    $create_store->save();
                }

                $activity = new ActivityLog;
				$activity->user_id = Auth::guard('admin')->user()->id;
				$activity->user_type = 'Admin';
				$activity->module = 'Seller';
				$activity->activity = 'Seller Added';
				$activity->created_at = now();
		        $activity->updated_at = now();
				$activity->save();


				return redirect('admin/selleradmin')->with('success', 'Seller Added Successfully');
				
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
			$this->data['senddata'] =  User::with('storedetails')->find($id);
			$this->data['seller'] =  Seller::where('sd_usid',$id)->first();
			$this->data['message'] = 'Update Seller';        
            $this->data['method'] = 'PUT';	
            $this->data['cityvalue'] = City::allcities();
            $this->data['main_category'] = Maincategory::allmaincategory();
			$this->data['route'] = array('selleradmin.update',$id);
			$this->data['page_details'] = $this->page_details;
			return view('admin.seller.addedit',$this->data);
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
				'first_name'=>'required',
                'mobile_number'=>'required|unique:users,mobile_number, '.$id.'|digits:10',
                'email'=>'required|email|unique:users,email, '.$id.'',
                'storedetails.sd_sname'=>'required',
                'storedetails.main_category'=>'required',
                'storedetails.sd_snumber'=>'required|digits:10',
                'storedetails.sd_sadminshare'=>'required',
                'storedetails.sd_scityid'=>'required',
                'storedetails.sd_sdeliverykm'=>'required',
                'storedetails.sd_address'=>'required',
                'storedetails.sd_spincode'=>'required|digits_between:6,7',
			);
			$messages = array(
				'first_name.required' => 'Enter First Name',
				'mobile_number.unique' => 'Mobile Number Already Exists',        
				'mobile_number.required' => 'Enter Mobile Number',    
				'email.unique' => 'EmailId Already Exists',        
                'email.required' => 'Enter EmailId',   
                'storedetails.sd_sname.required' => 'Enter store Name',    
                'storedetails.main_category.required' => 'Choose Main category',    
                'storedetails.sd_snumber.required' => 'Enter store Number', 
                'storedetails.sd_snumber.digits' => 'store Number Must Be 10 Digits', 
                'storedetails.sd_sadminshare.required' => 'Enter Admin Share', 
                'storedetails.sd_scityid.required' => 'Choose City', 
                'storedetails.sd_sdeliverykm.required' => 'Enter store delivery Km', 
                'storedetails.sd_address.required' => 'Enter store Address', 
                'storedetails.sd_spincode.required' => 'Enter store Pincode', 
                'storedetails.sd_spincode.digits_between' => 'Pincode must be between 6 and 7 Digits',  
			);

            $user_data = $request->except('_token','_method','storedetails');
            $store_data = $request->storedetails;
			$password_data=$request->password;
			if($password_data!=null){
				$user_data['password_user']=$password_data;
				$user_data['password']=bcrypt($password_data);
			}
			else{
                unset($user_data['password']);
				
			}
			try{
				$_update_record = User::find($id);
				$_update_record->fill($user_data);
                $_update_record->save();

                if($request->has('storedetails')){
                	

                    $seller_id=Seller::where('sd_usid',$id)->where('sd_status',1)->first();
                    $_update_record = Seller::where('sd_id',$seller_id->sd_id)->first();
                    $_update_record->fill($store_data);
                    $image = $request->file('store_image');
					
					if($image!=""){
						$destinationPath = public_path('admin/images/store_image');
						$file_name = time() . "." . $image->getClientOriginalExtension();
				 		$image->move('admin/images/store_image', $file_name);
                    	$_update_record->store_image = $file_name;
					}


					$image1 = $request->file('store_logo');
					
					if($image1 !=""){
						$destinationPath = public_path('admin/images/store_logo');
						$file_name1 = time() . "." . $image1->getClientOriginalExtension();
				 		$image1->move('admin/images/store_logo', $file_name1);
                    	$_update_record->store_logo = $file_name1;
					}
                    $_update_record->save();
                }

                $activity = new ActivityLog;
				$activity->user_id = Auth::guard('admin')->user()->id;
				$activity->user_type = 'Admin';
				$activity->module = 'Seller';
				$activity->activity = 'Seller Updated';
				$activity->created_at = now();
		        $activity->updated_at = now();
				$activity->save();
                
                

				return redirect('admin/selleradmin')->with('success', 'Seller Updated Successfully');
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
		public function deleteSeller(Request $request)		
		{			
			$user = User::where('id',$request->delete_id)->first();
			$user->delete();

			$activity = new ActivityLog;
			$activity->user_id = Auth::guard('admin')->user()->id;
			$activity->user_type = 'Admin';
			$activity->module = 'Seller';
			$activity->activity = 'Seller Deleted';
			$activity->created_at = now();
		    $activity->updated_at = now();
			$activity->save();

			return redirect()->back()->with('success','Seller Deleted Successfully');	
		}	

		public function export(Request $request){

			return Excel::download(new SellersExport(), 'sellers.csv');

		}		
	}	
