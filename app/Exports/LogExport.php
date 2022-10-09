<?php

namespace App\Exports;

use App\Models\ActivityLog;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use DB;

class LogExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function __construct($export_user_type)
    {
        $this->export_user_type = $export_user_type;
    }

    public function collection()
    {
        if($this->export_user_type == ''){

            $activity_log = ActivityLog::select(
                'activity_logs.*',
                'activity_logs.user_type as user_type_name',
                'users.*',
                DB::raw('DATE_FORMAT(activity_logs.created_at,"%d/%m/%Y %h:%i %a") as created_at')
            )
            ->leftjoin('users','users.id','activity_logs.user_id')
            ->get();

            foreach ($activity_log as $key => $data) {

                $excel_values[] = [
                    $key+1,
                    $data['first_name'],
                    $data['user_type_name'],
                    $data['module'],
                    $data['activity'],
                    $data['created_at'],
                ];
            }
        }else{

            $activity_log = ActivityLog::select(
                'activity_logs.*',
                'activity_logs.user_type as user_type_name',
                'users.*',
                DB::raw('DATE_FORMAT(activity_logs.created_at,"%d/%m/%Y %h:%i %a") as created_at')
            )
            ->leftjoin('users','users.id','activity_logs.user_id')
            ->where('activity_logs.user_type',$this->export_user_type)
            ->get();

            foreach ($activity_log as $key => $data) {

                $excel_values[] = [
                    $key+1,
                    $data['first_name'],
                    $data['user_type_name'],
                    $data['module'],
                    $data['activity'],
                    $data['created_at'],
                ];
            }
        }
        
        return collect($excel_values);
    }

    public function headings(): array
    {
        return [
            'S.No',
            'User',
        	'User Type',
        	'Module',
        	'Activity',
        	'Date & Time'
        ];
    }

}
