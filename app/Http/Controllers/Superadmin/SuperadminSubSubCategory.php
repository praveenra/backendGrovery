<?php	
		
	namespace App\Http\Controllers\Superadmin;	
		
	use Illuminate\Http\Request;	
	use App\Http\Controllers\Controller;	
    use App\Models\SubSubCategory;
    use App\Models\Category;
    use App\Models\Products;
    use DB;
	
		
	class SuperadminSubSubCategory extends Controller	
	{
				
		public function list(Request $request){			

            $this->data['subsubcategories'] = SubSubCategory::select('sub_sub_categories.*','category.*')->leftjoin('category','category.cat_id','sub_sub_categories.category_id')->get();
            $this->data['message'] = 'No Sub Sub Category Added';

            return view('superadmin.subsubcategory.manage', $this->data); 

		}

		public function filter(Request $request){

            $this->data['subsubcategories'] = SubSubCategory::where('status',$request->status)->get();
            $this->data['message'] = 'No SubSubCategory Added';

            return view('superadmin.subsubcategory.manage_ajax', $this->data);  
			
		}		

		public function form($id = NULL){

			if($id){

				$this->data['data'] = SubSubCategory::where('id',$id)->first();
				$this->data['action'] = 'Edit';

			}else{

				$this->data['data'] = new SubSubCategory;
				$this->data['action'] = 'Add';

			}	

            $this->data['categories'] = Category::where('cat_is_parent_id',null)->get();
            $this->data['subcategories'] = Category::where('cat_is_parent_id','!=',null)->get();

            return view('superadmin.subsubcategory.addedit', $this->data); 

		}

		public function getSubCategory(Request $request){

			$subcategories = DB::table("category")
				->where("cat_is_parent_id",$request->id)
				->pluck("cat_name","cat_id"); 

			return response()->json($subcategories);
		}

		public function save(Request $request){

			if($request->id){
				$subsubcategory = SubSubCategory::where('id',$request->id)->first();
				$subsubcategory->updated_at = now();
			}else{
				$subsubcategory = new SubSubCategory;
				$subsubcategory->created_at = now();
				$subsubcategory->updated_at = Null;
			}	

			$subsubcategory->name = $request->name;
			$subsubcategory->category_id = $request->category_id;
			$subsubcategory->sub_category_id = $request->sub_category_id;

			// if($request->image){
			// 	$image = time().$request->image->getCLientOriginalExtension();
			// 	$request->image->move('admin/images/subsubcategory',$image);
			// 	$subsubcategory->image = $image;
			// }

			$subsubcategory->status = $request->status;
			$subsubcategory->save();

            return redirect('superadmin/subsubcategory');

		}

		public function delete(Request $request){

			$delete = SubSubCategory::where('id',$request->delete_id)->delete();

			return redirect('superadmin/subsubcategory');

		}

		public function inactiveData(Request $request){

			$change_status = SubSubCategory::where('id',$request->id)->first();
			$change_status->status = 0;
			$change_status->save();

			$products = Products::where('sub_sub_category_id',$request->id)->update(['product_status' => 0]);
		}

		public function activeData(Request $request){
			
			$change_status = SubSubCategory::where('id',$request->id)->first();
			$change_status->status = 1;
			$change_status->save();

			$products = Products::where('sub_sub_category_id',$request->id)->update(['product_status' => 1]);
		}

	}	
