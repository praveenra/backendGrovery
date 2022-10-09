<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\ProductSize;
use Illuminate\Http\Request;

class ProductSizeController extends Controller
{
    public function index()
    {
        $productSize =   ProductSize::all();

        return view('superadmin.productSize.index', compact('productSize'));
    }

    public function create(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validate($request, [
            'sizeName' => ['required'],
            'status' => ['required']
        ]);

        $create =  ProductSize::create(['sizeName' => $request->sizeName, 'status' => (int) $request->status ]);

        if($create){
            return response()->json([
                'status' => 1,
                'message' => 'Product Size Is Created successfully'
            ]);
        }else{
            return response()->json([
                'status' => 0,
                'message' => 'Product Size Is unSuccessful try Again'
            ]);
        }

    }

    public function delete(Request $request): \Illuminate\Http\RedirectResponse
    {
        $id = $request->delete_id;
        ProductSize::find($id)->delete();
        return redirect()->back();
    }

    public function edit(Request $request): \Illuminate\Http\JsonResponse
    {

        $getProductSize =   ProductSize::findOrFail($request->id);

        return response()->json([
            'status' => 1,
            'getSize' => $getProductSize
        ]);
    }

    public function update(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validate($request, [
            'sizeName' => ['required'],
            'status' => ['required']
        ]);

        $UpdateProductSize =   ProductSize::findOrFail($request->id)->update($request->all());

        return response()->json([
            'status' => 1,
            'getColor' => $UpdateProductSize
        ]);
    }
}
