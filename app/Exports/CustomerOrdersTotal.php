<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use DB;


class CustomerOrdersTotal implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {


            $customer_order_total = Order::select('customer.*','orders.*','orders.customer_id',DB::raw('count(orders.customer_id) as customer_count'),DB::raw("SUM(total)"))
            ->leftjoin('customer','customer.id','orders.customer_id')
            ->groupby('customer.name')
            ->orderBy('customer_count', 'desc')
            ->get();

        foreach ($customer_order_total as $key => $order) {
            $excel_values[] = [
                $key+1,
                $order['name'],
                $order['total'],
                $order['customer_count'],
            ];
        }
        return collect($excel_values);
    }

    public function headings(): array
    {
        return [
            'S.No',
            'name',
            'Total',
            'Customer Count'
        ];
    }

}
