<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class OrdersExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {

    	$orders = Order::select('orders.*','customer.*','customer_addresses.*','product.*','product_quantity.*','seller_details.*','customer.name as customer','seller_details.sd_sname as store_name',)
        ->leftjoin('customer','customer.id','orders.customer_id')
        ->leftjoin('customer_addresses','customer_addresses.id','orders.address_id')
        ->leftjoin('product','product.product_id','orders.product_id')
        ->leftjoin('product_quantity','product_quantity.id','orders.product_quantity_id')
        ->leftjoin('seller_details','seller_details.sd_id','orders.store_id')
        ->get();
    	foreach ($orders as $key => $order) {
    		$excel_values[] = [
                $key+1,
				$order['order_id'],
				$order['customer'],
				$order['address'],
                $order['landmark'],
                $order['address_type'],
                $order['mobile_no'],
                $order['product_name'],
                $order['measurement'],
                $order['store_name'],
                $order['quantity'],
                $order['total'],
                $order['payment_type'],
				
				
			];
    	}
        return collect($excel_values);
    }

    public function headings(): array
    {
        return [
            'S.No',
            'order_id',
        	'customer name',
        	'address',
        	'landmark ',
            'address_type',
            'mobile_no',
            'product_name',
            'measurement',
            'store_name',
            'quantity',
            'total',
            'payment_type',
        	
        ];
    }

}
