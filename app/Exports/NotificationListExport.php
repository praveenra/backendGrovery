<?php

namespace App\Exports;

use App\Models\Notification;
use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;


class NotificationListExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {

        $notifications = Notification::select('notifications.*','customer.name as customer')->leftjoin('customer','customer.id','notifications.customer_id')->orderBy('notifications.id','asc')->get();

    	foreach ($notifications as $key => $notify) {
    		$excel_values[] = [
                $key+1,
				$notify['title'],
				$notify['message'],
				$notify['customer'],
			];
    	}
        return collect($excel_values);
    }

    public function headings(): array
    {
        return [
            'S.No',
            'Title',
        	'Message',
        	'Customer',
        ];
    }

}
