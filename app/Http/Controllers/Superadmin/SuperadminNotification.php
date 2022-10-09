<?php	
		
	namespace App\Http\Controllers\Superadmin;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\Common;
	use App\Models\Notification;
	use App\Models\Customer;
	use App\Models\User;
	use App\Models\MembershipUser;
	use Maatwebsite\Excel\Facades\Excel;
	use App\Exports\NotificationListExport;
		
	class SuperadminNotification extends Controller	
	{		
        protected $data = array();
        protected $page_details =array(
            'page_name'=> 'Notifications',
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
				
		public function list(Request $request){			

            $this->data['notifications'] = Notification::select('notifications.*','customer.name as customer','users.*','user_types.*')
	            ->leftjoin('customer','customer.id','notifications.customer_id')
	            ->leftjoin('users','users.id','notifications.customer_id')
	            ->leftjoin('user_types','user_types.user_type_id','users.user_type')
	            ->orderBy('notifications.id','asc')
	            ->groupby('title')
	            ->orderBy('message')
	            ->get();

            $this->data['members'] = Customer::where('status','=',1)->get();
            // $this->data['members1'] = User::where('user_status','=',1)->get();
            $this->data['members2'] = MembershipUser::select('membership_users.*','customer.*')
            ->leftjoin('customer','customer.id','membership_users.users_id')
            ->where('name','!=','NULL')
            ->get();

            // $this->data['members3'] = $this->data['members1']->concat($this->data['members2']);

			return view('superadmin/notification/manage',$this->data);

		}


		public function send(Request $request)
		{
			$members = $request->members;
			// echo "<pre> =>";
			// echo $request->image, "<pre> =>";
			// exit;

			// dd($member);
			$title = $request->title;
			// dd($title);
			$message = $request->message;
			// dd($message);
			$file = $request->file('image');
			
			if(!empty($file)){
				$name = $file->getClientOriginalName();
				$file->move('admin/images/notification',$name);
				$file_name = $name;
				$image_path = 'https://ibotix.tech/Grovery/admin/images/notification/'.$name;
			}else{
				$file_name = NULL;
				$image_path = Null;
			}
			$url = "https://fcm.googleapis.com/fcm/send";
			
			$serverKey = 'AAAAqlfNKJ4:APA91bE4JGAFBfQT0y8CbHE6A3VRJI8Sfy1-JQSeJU9tzauMbYDOygj1JKDioX90balbVSGuhyOZfZTp_4wMGja2qqcv5fwWP1WGr07WnEmBrH9U2yvhfMKeaoNw-9EpPMQMVLaz0DWU';
			
			$notification = array('title' =>$title , 'body' => $message, 'image' => $image_path, 'sound' => 'default', 'badge' => '1');

				if ($members == 'all') {
					$customers = Customer::where('fcm_id','!=', NULL)->where('status',1)->get();
				}
				elseif ($members =="membership_users") {
					$customers = MembershipUser::select('membership_users.*','customer.*')
					->where('fcm_id','!=', NULL)
		            ->leftjoin('customer','customer.id','membership_users.users_id')
		            ->get();
				}
				elseif ($members =="delivery_boy") {
					$customers = User::where('user_type','=',1)->where('user_status','=',1)->get();
				}

			foreach ($customers as $key => $value) {

				$token = $value->fcm_id;

				$arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
				$json = json_encode($arrayToSend);
				$headers = array();
				$headers[] = 'Content-Type: application/json';
				$headers[] = 'Authorization: key='. $serverKey;
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
				curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
				curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
				//Send the request
				$response = curl_exec($ch);
				//Close request
				if ($response === FALSE) {
				//die('FCM Send Error: ' . curl_error($ch));
				}
				curl_close($ch);
				
				$notification = new Notification;
				$notification->title = $title;
				$notification->message = $message;
				$notification->members = $members;
				$notification->customer_id = $value->id;
				$notification->image = $file_name;
				$notification->save();

			}
			
			return redirect('superadmin/notification')->with(['success' => 'Notification sent successfully']);

		}

		public function export_notification_list(Request $request){

            return Excel::download(new NotificationListExport(), 'notification_list.csv');

        } 

	}	
