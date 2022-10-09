<?php	
		
	namespace App\Http\Controllers\Admin;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\Common;
	use App\Models\User;
    use App\Models\Settings;
    use App\Models\Seller;	
	use App\Models\City;
	use App\Models\Faq;
	use App\Models\ActivityLog;
	use Auth;
	use App\Http\Requests\Pages\Addform;
		
	class AdminFaq extends Controller	
	{		
        protected $data = array();
        protected $page_details =array(
            'page_name'=> 'Faq',
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

            $this->data['senddata'] = Faq::paginate(100);
            $this->data['message'] = 'No Faq Added';
            $this->data['add'] = 'faqadmin.create';
			$this->data['edit'] = url('admin/faqadmin'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');
            return view('admin.faq.manage', $this->data);  
		}	

		public function filter(Request $request){

            $this->data['senddata'] = faq::where('status',$request->status)->get();
            $this->data['message'] = 'No Faq Added';
            $this->data['add'] = 'faqadmin.create';
			$this->data['edit'] = url('admin/faqadmin'); 
            $this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('page_details.index');
            return view('admin.faq.manage_ajax', $this->data); 

		}		
				
		/**			
			* Show the form for creating a new resource.			
			*			
			* @return \Illuminate\Http\Response			
		*/		
		public function create()		
		{			
			$this->data['senddata'] = new Faq;
			$this->data['page_details'] = $this->page_details;
            $this->data['route'] = array('faqadmin.store');
			$this->data['method'] = 'POST';
			return view('admin.faq.addedit', $this->data); 		
		}		
				
		/**			
			* Store a newly created resource in storage.			
			*			
			* @param  \Illuminate\Http\Request  $request			
			* @return \Illuminate\Http\Response			
		*/		
		public function store(Request $request)		
		{		
			$request->validate([
		       	'question'=>'required',
				'answer'=>'required',
                'status'=>'required',
	    	],
			[
				'question.required' => 'Question is required',
				'answer.required' => 'Answer is required', 
				'status.required' => 'Choose Status', 
			]);

				$faq = new Faq;
				$faq->type = $request->type;
				$faq->question = $request->question;
				$faq->answer = $request->answer;
				$faq->status = $request->status;
				$faq->created_at = now();
				$faq->updated_at = NULL;
				$faq->save();

				$activity = new ActivityLog;
				$activity->user_id = Auth::guard('admin')->user()->id;
				$activity->user_type = 'Admin';
				$activity->module = 'FAQ';
				$activity->activity = 'FAQ Added';
				$activity->created_at = now();
	        	$activity->updated_at = now();
				$activity->save();

				return redirect('admin/faqadmin')->with('success', 'Faq Added Successfully');
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
			$this->data['senddata'] =  Faq::find($id);	
			$this->data['message'] = 'Update Faq';        
            $this->data['method'] = 'PUT';
			$this->data['route'] = array('faqadmin.update',$id);
			$this->data['page_details'] = $this->page_details;
			return view('admin.faq.addedit',$this->data);
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
				$request->validate([
			       	'question'=>'required',
					'answer'=>'required',
	                'status'=>'required',
		    	],
				[
					'question.required' => 'Question is required',
					'answer.required' => 'Answer is required', 
					'status.required' => 'Choose Status', 
				]);
				$faq = Faq::find($id);
				$faq->type = $request->type;
				$faq->question = $request->question;
				$faq->answer = $request->answer;
				$faq->status = $request->status;
				$faq->updated_at = now();
				$faq->save();

				$activity = new ActivityLog;
				$activity->user_id = Auth::guard('admin')->user()->id;
				$activity->user_type = 'Admin';
				$activity->module = 'FAQ';
				$activity->activity = 'FAQ Updated';
				$activity->created_at = now();
	        	$activity->updated_at = now();
				$activity->save();

				return redirect('admin/faqadmin')->with('success', 'Faq Updated Successfully');
		}		
				
		/**			
			* Remove the specified resource from storage.			
			*			
			* @param  int  $id			
			* @return \Illuminate\Http\Response			
		*/		
		public function deleteFaq(Request $request)		
		{			
			$user = Faq::find($request->delete_id);
			$user->delete();

			$activity = new ActivityLog;
			$activity->user_id = Auth::guard('admin')->user()->id;
			$activity->user_type = 'Admin';
			$activity->module = 'FAQ';
			$activity->activity = 'FAQ Deleted';
			$activity->created_at = now();
	        $activity->updated_at = now();
			$activity->save();

			return redirect()->back()->with('success','Faq Deleted Successfully');	
		}		
	}	
