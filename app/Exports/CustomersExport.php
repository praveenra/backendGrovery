<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class CustomersExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {

    	$customers = Customer::get();
    	foreach ($customers as $key => $customer) {
    		if($customer->status == 1){
    			$customer->status = 'Active';
    		}else{
    			$customer->status = 'Inactive';
    		}
    		$excel_values[] = [
                $key+1,
				$customer['name'],
				$customer['email'],
				$customer['phone_no'],
				$customer['dob'],
				$customer->status,
			];
    	}
        return collect($excel_values);
    }

    public function headings(): array
    {
        return [
            'S.No',
            'Name',
        	'Email',
        	'Phone Number',
        	'Date Of Birth',
        	'Status'
        ];
    }

}
