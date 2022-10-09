<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use DB;

class TopProductsOrder implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {

    	$top_products_orders =  Order::select('product.product_name',DB::raw('count(product.product_name) as product_count'))
            ->leftjoin('product','product.product_id','orders.product_id')
            ->groupby('orders.product_id')
            ->orderBy('product_count', 'desc')
            ->get();

    	foreach ($top_products_orders as $key => $top_products_order) {
    		$excel_values[] = [
                $key+1,
				$top_products_order['product_name'],
				$top_products_order['product_count'],
			];
    	}
        return collect($excel_values);
    }

    public function headings(): array
    {
        return [
            'S.No',
            'product_name',
        	'product_count name',
        ];
    }

}
