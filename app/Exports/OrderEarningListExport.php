<?php

namespace App\Exports;

use App\Models\Products;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Models\Order;


class OrderEarningListExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {

        $orderdetails=Order::select('orders.id as ord_id','orders.*','customer.*','seller_details.*','product.*','delivery_info.*','main_category.*','orders.total as total_amount','customer.name as cust_name')
            ->leftjoin('seller_details','seller_details.sd_id','orders.store_id')
            ->leftjoin('customer','customer.id','orders.customer_id')
            ->leftjoin('product','product.product_id','orders.product_id')
            ->leftjoin('delivery_info','delivery_info.id','orders.delivery')
            ->leftjoin('main_category', 'main_category.mc_id', '=', 'seller_details.main_category')
            ->get();

        foreach($orderdetails as $admin_earning){
        $totalamount1=$admin_earning->total;
        // $profitvalue1=$admin_earning->profit_value;
        $admincommission1=$admin_earning->mc_commision;

        $admin_earning['admin_amount']= $totalamount1  * ($admincommission1 / 100);

        }

        foreach($orderdetails as $delivery_man){
            $totalamount2=$delivery_man->total;
            $profitvalue2=$delivery_man->profit_value;
            $admincommision2=$delivery_man->mc_commision;

            $delivery_man['delivery_man_amount']= $totalamount2  * ($profitvalue2 / 100);
        }

        foreach($orderdetails as $store_earning){
            $totalamount3=$store_earning->total;
            $profitvalue3=$store_earning->profit_value;
            $admincommision3=$store_earning->mc_commision;

            $store_earning['percentage1']= $totalamount3  * ($admincommision3 / 100);
            $store_earning['percentage2']= $totalamount3  * ($profitvalue3 / 100);
            $store_earning['store_amount']= $totalamount3 - $store_earning['percentage1'] - $store_earning['percentage2'] ;

        }

        $this->data['complete_count'] =Order::where('order_status','=', 4)->count();

        $this->data['return_count'] =Order::where('order_status','=', 6)->count();

        $this->data['order_completed_count'] =$this->data['complete_count'] + $this->data['return_count'] ;

        $this->data['cancel_count'] =Order::where('order_status','=', 5)->count();

        $this->data['total_amount'] =Order::sum('total');

        $this->data['orders_payment'] = $orderdetails;

        $this->data['message'] = 'No Orders Available';



        foreach ($this->data['orders_payment'] as $key => $product) {
            $excel_values[] = [
                $key+1,
                $product['created_at'],
                $product['cust_name'],
                $product['sd_sname'],
                $product['total_amount'],
                $product['admin_amount'],
                $product['delivery_man_amount'],
                $product['store_amount'],

            ];
        }
        return collect($excel_values);
    }

    public function headings(): array
    {
        return [
            'S.No',
            'Completed Date',
            'Customer Name',
            'Seller Name',
            'Total ',
            'Earning',
            'Delivery Man Earning',
            'Store Earning',
        ];
    }

}
