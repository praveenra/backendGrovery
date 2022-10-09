<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;


class AreaBasedCustomer implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {


            $area_based_customer = Customer::select('customer.*','customer_addresses.*')
            ->leftjoin('customer_addresses','customer_addresses.customer_id','customer.id')
            ->get();  

        foreach ($area_based_customer as $key => $customer) {
            $excel_values[] = [
                $key+1,
                $customer['name'],
                $customer['address'],
                $customer['landmark'],
                $customer['address_type'],
                $customer['mobile_no'],
            ];
        }
        return collect($excel_values);
    }

    public function headings(): array
    {
        return [
            'S.No',
            'name',
            'address name',
            'landmark',
            'address_type ',
            'mobile_no',
        ];
    }

}
