<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	use Carbon\Carbon;
	use Session;
	use Auth;
	use App\Models\User;
	class HomeController extends Controller
	{
		
		protected $data = array();
		/**
			* Create a new controller instance.
			*
			* @return void
		*/
		public function __construct()
		{
			//$this->middleware('auth');
		}
		
		/**
			* Show the application dashboard.
			*
			* @return \Illuminate\Contracts\Support\Renderable
		*/
		public function index(){
			
		}
		
		public function SuperadminLogin(){
			return view('superadmin.Auth.login');
		}
		public function sellerlogin(){
			return view('seller.Auth.login');
		}
		public function adminLogin(){
			return view('admin.Auth.login');
		}
		public function getLogout(){
			Auth::logout();
			Session::flush();
			return redirect('/superadminlogin')->with('failure', 'Logged out successfully');
		}
		public function customerlogout(){
			Auth::logout();
			Session::flush();
			return redirect('/')->with('failure', 'Logged out successfully');
		}
		public function sellerlogout(){
			Auth::logout();
			Session::flush();
			return redirect('/sellerlogin')->with('failure', 'Logged out successfully');
		}
		public function adminlogout(){
			Auth::logout();
			Session::flush();
			return redirect('/adminlogin')->with('failure', 'Logged out successfully');
		}
		public function offerproduct(){

		}
		
		public function productview($id){

		}
		


		public function UserRegister(){
			return view('auth.register');
		}

		public function UserLogin(){
			return view('users.auth.login');
		}
		




	}


