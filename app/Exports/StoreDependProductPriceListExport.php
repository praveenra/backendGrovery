<?php

namespace App\Exports;

use App\Models\Products;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;


class StoreDependProductPriceListExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {

        $store_depend_product_price_list = Products::select('product.*','brand.*','seller_details.*','product_quantity.*')
            ->leftjoin('brand','brand.id','product.brand_id')
            ->leftjoin('seller_details','seller_details.sd_usid','product.seller_id')
            ->leftjoin('product_quantity','product_quantity.product_id','product.product_id')
            ->get(); 

    	foreach ($store_depend_product_price_list as $key => $product) {
    		$excel_values[] = [
                $key+1,
				$product['product_name'],
				$product['brand_name'],
				$product['sd_sname'],
                $product['sales_price'],
                $product['sd_address'],
                $product['sd_spincode'],
                $product['sd_status'],

			];
    	}
        return collect($excel_values);
    }

    public function headings(): array
    {
        return [
            'S.No',
            'product_name',
        	'brand_name name',
        	'sd_sname',
        	'sales_price ',
            'sd_address',
            'sd_spincode',
            'sd_status',

        ];
    }

}
