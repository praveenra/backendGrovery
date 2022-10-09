<?php	
		
	namespace App\Http\Controllers\Superadmin;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\Common;
	use App\Models\User;
	use App\Models\Settings;
	use App\Models\Permission;
	use App\Http\Requests\Users\Addform;
	use DB;

	class SuperadminAdmin extends Controller	
	{		
        protected $data = array();
        protected $page_details =array(
            'page_name'=> 'Admin',
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

            $this->data['senddata'] = User::where('user_type',3)->paginate();
            $this->data['message'] = 'No Admin Added';
            $this->data['add'] = 'admindata.create';
			$this->data['edit'] = url('superadmin/admindata'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');
            return view('superadmin.admin.manage', $this->data);  
		}		
				
		/**			
			* Show the form for creating a new resource.			
			*			
			* @return \Illuminate\Http\Response			
		*/		
		public function create()		
		{			
			$this->data['senddata'] = new User;
			$this->data['page_details'] = $this->page_details;
			$this->data['route'] = array('admindata.store');
			$this->data['method'] = 'POST';
			$this->data['permissions'] = Permission::orderBy('name','asc')->get();
			return view('superadmin.admin.addedit', $this->data); 		
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
			$user_details=User::where('user_status','1')->where('user_type','3')->where('deleted_at','=',null)->orderBy('id','desc')->first();
			$insert_array['user_type']=3;
			// $insert_array['user_status']=1;
			$insert_array['password_user']=$insert_array['password'];
			$insert_array['password']=bcrypt($insert_array['password']);
			$insert_array['created_by']=auth()->guard('superadmin')->user()->id;
			$insert_array['updated_by']=auth()->guard('superadmin')->user()->id;
			try{
				$create_array = new User;
				$create_array = $create_array->fill($insert_array);
				$create_array->save();
				$user_pref_id=Settings::where('s_id',1)->where('s_status',1)->first();
				
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

				User::find($create_array->id)->update(array('user_id'=>$userid));

				$create_array->permissions()->attach($request->permissions);

				return redirect('superadmin/admindata')->with('success', 'Admin Added Successfully');
				
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
			$this->data['senddata'] =  User::find($id);	
			$this->data['message'] = 'Update Admin';        
			$this->data['method'] = 'PUT';	
			$this->data['route'] = array('admindata.update',$id);
			$this->data['page_details'] = $this->page_details;
			$this->data['permissions'] = Permission::orderBy('name','asc')->get();
			return view('superadmin.admin.addedit',$this->data);
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
			);
			$messages = array(
				'first_name.required' => 'Enter First Name',
				'mobile_number.unique' => 'Mobile Number Already Exists',        
				'mobile_number.required' => 'Enter Mobile Number',    
				'email.unique' => 'EmailId Already Exists',        
				'email.required' => 'Enter EmailId',     
			);

			DB::table('permission_user')->where('user_id',$id)->delete();

			$user_data = $request->except('_token');
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

				$_update_record->permissions()->attach($request->permissions);

				return redirect('superadmin/admindata')->with('success', 'Admin Updated Successfully');
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
		public function deleteAdmin(Request $request)		
		{			
			$user = User::where('id',$request->delete_id)->first();
			$user->delete();
			return redirect()->back()->with('success','Admin Deleted Successfully');	
		}	

		public function inactiveData(Request $request){
			$change_status = User::where('id',$request->id)->first();
			$change_status->user_status = 0;
			$change_status->save();
		}

		public function activeData(Request $request){
			$change_status = User::where('id',$request->id)->first();
			$change_status->user_status = 1;
			$change_status->save();
		}
	}	
