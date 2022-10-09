<?php	
		
	namespace App\Http\Controllers\Superadmin;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\Common;
	use App\Models\User;
    use App\Models\Settings;
    use App\Models\Seller;	
	use App\Models\City;
	use App\Models\Pages;
	use App\Http\Requests\Pages\Addform;
		
	class SuperadminPages extends Controller	
	{		
        protected $data = array();
        protected $page_details =array(
            'page_name'=> 'Pages',
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

            $this->data['senddata'] = Pages::paginate();
            $this->data['message'] = 'No Pages Added';
            $this->data['add'] = 'pages.create';
			$this->data['edit'] = url('superadmin/pages'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');
            return view('superadmin.pages.manage', $this->data);  
		}	

		public function filter(Request $request){

             $this->data['senddata'] = Pages::where('page_status',$request->status)->get();
            $this->data['message'] = 'No Pages Added';
            $this->data['add'] = 'pages.create';
			$this->data['edit'] = url('superadmin/pages'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');
            return view('superadmin.pages.manage_ajax', $this->data); 

		}		
				
		/**			
			* Show the form for creating a new resource.			
			*			
			* @return \Illuminate\Http\Response			
		*/		
		public function create()		
		{			
			$this->data['senddata'] = new pages;
			$this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('pages.store');
			$this->data['method'] = 'POST';
			return view('superadmin.pages.addedit', $this->data); 		
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

			$insert_array['created_by']=auth()->guard('superadmin')->user()->id;
			$insert_array['updated_by']=NULL;
			$insert_array['page_type']= $request->type;
			try{
				$create_array = new Pages;
				$create_array = $create_array->fill($insert_array);
				$create_array->save();

				return redirect('superadmin/pages')->with('success', 'Page Added Successfully');
				
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
			$this->data['senddata'] =  Pages::find($id);	
			$this->data['message'] = 'Update Page';        
            $this->data['method'] = 'PUT';
			$this->data['route'] = array('pages.update',$id);
			$this->data['page_details'] = $this->page_details;
			return view('superadmin.pages.addedit',$this->data);
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
				'page_name'=>'required',
                'page_status'=>'required',
			);
			$messages = array(
				'page_name.required' => 'Enter Page Name',
				'page_status.required' => 'Choose Status', 
			);

            $user_data = $request->except('_token','_method');
			$user_data['page_type']= $request->type;
			$insert_array['updated_by']=auth()->guard('superadmin')->user()->id;

			try{
				$_update_record = Pages::find($id);
				$_update_record->fill($user_data);
                $_update_record->save();

				return redirect('superadmin/pages')->with('success', 'Page Updated Successfully');
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
		public function deletePage(Request $request)		
		{			
			$user = Pages::find($request->delete_id);
			$user->delete();
			return redirect()->back()->with('success','Page Deleted Successfully');	
		}

		public function inactiveData(Request $request){

			$change_status = Pages::where('id',$request->id)->first();
			$change_status->page_status = 0;
			$change_status->save();
		}

		public function activeData(Request $request){
			
			$change_status = Pages::where('id',$request->id)->first();
			$change_status->page_status = 1;
			$change_status->save();
		}

	}	
