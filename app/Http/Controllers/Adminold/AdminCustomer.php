<?php	
		
	namespace App\Http\Controllers\Admin;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\Common;
	use App\Models\Customer;
	use App\Exports\CustomersExport;
	use Maatwebsite\Excel\Facades\Excel;
	class AdminCustomer extends Controller	
	{		
        protected $data = array();
        protected $page_details =array(
            'page_name'=> 'Customer',
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
				
		public function list(Request $request){			

            $this->data['customers'] = Customer::paginate();
            $this->data['message'] = 'No Customer Added';
            $this->data['page_details'] = $this->page_details;

            return view('admin.customers.manage', $this->data);  
		}

		public function export(Request $request){

			return Excel::download(new CustomersExport(), 'customers.csv');

		}						
	}	
