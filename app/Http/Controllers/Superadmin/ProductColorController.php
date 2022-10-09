<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\ProductColor;
use Illuminate\Http\Request;

class ProductColorController extends Controller
{
    public function index()
    {
       $productColor =   ProductColor::all();

        return view('superadmin.productColor.index', compact('productColor'));
    }

    public function create(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validate($request, [
            'colorName' => ['required'],
            'status' => ['required']
        ]);

        $create =  ProductColor::create(['colorName' => $request->colorName, 'status' => (int) $request->status ]);

        if($create){
            return response()->json([
                'status' => 1,
                'message' => 'Product Color Is Created successfully'
            ]);
        }else{
            return response()->json([
                'status' => 0,
                'message' => 'Product Color Is unSuccessful try Again'
            ]);
        }

    }

    public function delete(Request $request): \Illuminate\Http\RedirectResponse
    {
        $id = $request->delete_id;
         ProductColor::find($id)->delete();
         return redirect()->back();
    }

    public function edit(Request $request): \Illuminate\Http\JsonResponse
    {

        $getProductColor =   ProductColor::findOrFail($request->id);

        return response()->json([
             'status' => 1,
             'getColor' => $getProductColor
        ]);
    }

    public function update(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validate($request, [
            'colorName' => ['required'],
            'status' => ['required']
        ]);

        $UpdateProductColor =   ProductColor::findOrFail($request->id)->update($request->all());

        return response()->json([
            'status' => 1,
            'getColor' => $UpdateProductColor
        ]);
    }
}
