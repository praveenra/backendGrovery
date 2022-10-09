<?php
	
namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Session;
use Auth;
use App\Models\Role;
use App\Models\Permission;
use DB;

class SuperadminRole extends Controller{

	public function list(){

		$this->data['roles'] = Role::get();
		$this->data['message'] = 'No Roles Found';

		return view('superadmin/roles/list',$this->data);
	}

	public function form($id = NULL){

		if($id){
			$this->data['role'] = $role = Role::where('id',$id)->first();
			$this->data['action'] = 'Edit';
		}else{
			$this->data['role'] = new Role;
			$this->data['action'] = 'Add';
		}

		$this->data['permissions'] = Permission::orderBy('name','asc')->get();

		return view('superadmin/roles/form',$this->data);

	}

	public function save(Request $request){

		if($request->id){
			$role = Role::where('id',$request->id)->first();
			$role->updated_at = now();
			DB::table('permission_role')->where('role_id',$request->id)->delete();
		}else{
			$role = new Role;
			$role->created_at = now();
			$role->updated_at = NULL;
		}

		$role->name = $request->name;
		$role->save();

		$role->permissions()->attach($request->permissions);

		return redirect('superadmin/role_list');

	}

}