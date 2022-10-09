<?php

namespace App\Imports;

use App\Models\Products;
use App\Models\Seller;
use App\Models\Brand;
use App\Models\Measurement;
use App\Models\Category;
use App\Models\SubSubCategory;
use App\Models\ProductQuantity;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;


class ProductsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {


        // echo "<pre>";
        // print_r($row);
        // exit;

        // $product_data = products::select('product.*','sub_sub_categories.*','sub_sub_categories.name as category_name')
        // ->leftjoin('sub_sub_categories','sub_sub_categories.id','product.sub_sub_category_id')
        // ->first(); 

        $subcategorydetails=SubSubCategory::where('name',$row['sub_sub_category_name'])->first();
        $measurementdetails=Measurement::where('name',$row['measurement_name'])->first();
        $sellerdetails=Seller::where('sd_sname',$row['store_name'])->first();
        $branddetails=Brand::where('brand_name',$row['brand_name'])->first(); 
    //   echo"<pre> subcategorydetails=>";
    //     print_r($subcategorydetails);
    //     echo count($subcategorydetails);
    //   echo"<pre> measurementdetails=>";
    //     print_r($measurementdetails);
    //   echo"<pre> sellerdetails=>";
    //     print_r($sellerdetails);
    //   echo"<pre> branddetails=>";
    //     print_r($branddetails);
    //     exit;

        if($subcategorydetails && $measurementdetails && $sellerdetails && $branddetails){
     /* echo"<pre>";
        print_r($subcategorydetails->category_id);
        exit;*/

     /*    $category = Category::select(['cat_id','cat_name'])
                                    // ->where('cat_name',$row['product_category_id'])
                                    ->get()
                                    ->toArray();

         $sub_sub_category = SubSubCategory::select(['id','name'])
                                    ->get()
                                    ->toArray();

         $seller_detail = Seller::select(['sd_id','sd_sname'])
                                    ->get()
                                    ->toArray();

         $brand = Brand::select(['id','brand_name'])
                                    ->get()
                                    ->toArray();

         $measurement = Measurement::select(['id','name'])
                                    ->get()
                                    ->toArray();*/

            // dd($this->data['category']);
                
            // print_r($this->data['category'][0]);
            // echo data['category']['cat_id'];
            // print_r($this->data['category']);
            // exit;

            // Table::select('name','surname')->where('id', 1)->get();
        
        // @foreach ($category as $cat1)
        // {{$cat1->cat_name}}
        // @endforeach

      /*  $category_id         = $category[0]['cat_id'];
        $measurement_id      = $measurement[0]['id'];
        $brand_id            = $brand[0]['id'];
        $seller_id           = $seller_detail[2]['sd_id'];
        $sub_sub_category_id = $sub_sub_category[0]['id'];*/
        
        // if($row[0]!='product_name')
        // {
        
        return new Products([

            'product_name'              => $row['product_name'],
            'product_category_id'       => $subcategorydetails->category_id,
            'measurement_id'            => $measurementdetails->id,
            'brand_id'                  => $branddetails->id,
            'seller_id'                 => $sellerdetails->sd_usid,
            'sub_category_id'           => $subcategorydetails->sub_category_id,
            'sub_sub_category_id'       => $subcategorydetails->id,
            'product_short_description' => $row['product_short_description'],
            'product_long_description'  => $row['product_long_description'],
            'product_tax'               => $row['product_tax'],
            'product_status'            => $row['product_status'],

        ]);

        return new ProductQuantity([
            'price'         => $row['price'],
            'sales_price'   => $row['sales_price'],
            'offer'         => $row['offer']
        ]);

        Products::insert($row); 
        ProductQuantity::insert($row); 

        // }
    }else{

    }

    }

}
