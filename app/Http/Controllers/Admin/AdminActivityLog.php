<?php	
		
	namespace App\Http\Controllers\Admin;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\Common;
	use App\Models\ActivityLog;
	use App\Exports\LogExport;
	use DB;
	use Maatwebsite\Excel\Facades\Excel;

	class AdminActivityLog extends Controller	
	{		
        
		public function __construct(){			
			$this->middleware('admin');			
		}

		public function list(Request $request){			

            $this->data['activity_logs'] = ActivityLog::select('activity_logs.*','activity_logs.user_type as user_type_name','users.*',DB::raw('DATE_FORMAT(activity_logs.created_at,"%d/%m/%Y %h:%i %a") as created_at'))->leftjoin('users','users.id','activity_logs.user_id')->get();

            $this->data['message'] = 'No Logs Found';

            return view('admin.log_history.list', $this->data);
		}

		public function filter(Request $request){

			if($request->user_type != ''){
				$this->data['activity_logs'] = ActivityLog::select('activity_logs.*','activity_logs.user_type as user_type_name','users.*',DB::raw('DATE_FORMAT(activity_logs.created_at,"%d/%m/%Y %h:%i %a") as created_at'))->leftjoin('users','users.id','activity_logs.user_id')->where('activity_logs.user_type',$request->user_type)->get();
			}else{
				$this->data['activity_logs'] = ActivityLog::select('activity_logs.*','activity_logs.user_type as user_type_name','users.*',DB::raw('DATE_FORMAT(activity_logs.created_at,"%d/%m/%Y %h:%i %a") as created_at'))->leftjoin('users','users.id','activity_logs.user_id')->get();
			}
			
            $this->data['message'] = 'No Logs Found';

            return view('admin.log_history.filter_list', $this->data);
		}

		public function export(Request $request){

			$export_user_type = $request->export_user_type;

			return Excel::download(new LogExport($export_user_type), 'log_history.csv');

		}
	}	
