<?php

namespace App\Exports;

use App\Models\Broker;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportBroker implements FromCollection, WithHeadings
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Broker::where('user_id', '=', Auth::user()->id)->get();
    }
        
    public function headings(): array
    {
        return [
            'Id',
            'User Id',
            'Name',
            'Email',
            'Phone Number',
            'Created Date',
            'Updated Date',
        ];
    }
}