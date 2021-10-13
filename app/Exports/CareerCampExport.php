<?php

namespace App\Exports;

use App\CareerCamp;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CareerCampExport implements FromQuery,WithHeadings
{

    public $data = array();
    public function __construct($data){
        $this->data = $data;
    }
    public function query()
    {
        return CareerCamp::query()->select('name','email','cell_phone','address','mark','seconds')->whereIn('id',$this->data)->orderBy('mark','desc')->orderBy('seconds','asc');
    }

    public function headings(): array
    {
        return [
        
            'Name',
            'Email',
            'Mobile',
            'Address',
            'Mark',
            'Seconds',
        ];
    }



}
