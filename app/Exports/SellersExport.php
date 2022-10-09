<?php

namespace App\Exports;

use App\Models\Seller;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class SellersExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {

    	$sellers = Seller::select('seller_details.*','main_category.*','city.city_name as city')->leftjoin('main_category','main_category.mc_id','seller_details.main_category')->leftjoin('city','city.city_id','seller_details.sd_scityid')->get();
    	foreach ($sellers as $key => $seller) {
    		if($seller->sd_status == 1){
    			$seller->status = 'Active';
    		}else{
    			$seller->status = 'Inactive';
    		}
    		$excel_values[] = [
                $key+1,
				$seller['sd_sname'],
				$seller['mc_name'],
				$seller['sd_snumber'],
				$seller['sd_address'],
				$seller['city'],
				$seller['sd_spincode'],
				$seller->status,
			];
    	}
        return collect($excel_values);
    }

    public function headings(): array
    {
        return [
            'S.No',
            'Store Name',
        	'Main Category',
        	'Phone Number',
        	'Address',
        	'City',
        	'Pincode',
        	'Status'
        ];
    }

}
