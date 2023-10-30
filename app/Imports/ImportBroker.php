<?php

namespace App\Imports;

use App\Models\Broker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Calculation\Information\Value;

class ImportBroker implements ToCollection, WithHeadingRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        $rules = [];

        foreach ($rows as $key=>$row) 
        {
            if($row['id']) {
                $rules[$key.".name"] =  "required|unique:brokers,broker_name,{$row['id']}"; 
                $rules[$key.".email"] =  "required|email|unique:brokers,broker_email,{$row['id']}";   
                $rules[$key.".phone_number"] =  "required|digits:10|unique:brokers,broker_phone_number,{$row['id']}";            
            } else {
                $rules[$key.".name"] =  'required|unique:brokers,broker_name';
                $rules[$key.".email"] =  'required|email|unique:brokers,broker_email';
                $rules[$key.".phone_number"] =  'required|digits:10|unique:brokers,broker_phone_number';
            }
        }

        $validator = Validator::make($rows->toArray(), $rules)->validate();
        // $validator = Validator::make($rows->toArray(), [
        //      '*.name' => "required|unique:brokers,broker_name",
        //      '*.email' =>'required|email|unique:brokers,broker_email',
        //      '*.phone_number' => 'required|digits:10|unique:brokers,broker_phone_number',
        //  ])->validate();
        // // dd(gettype($rows));
         
        foreach ($rows as $key=>$row) 
        {
            if($row['id']){
                $role = Broker::find($row['id']);
                $role->update([
                    'user_id' =>  $role->user_id ? $role->user_id : Auth::user()->id,
                    'broker_name' => $row['name'],
                    'broker_email' => $row['email'],
                    'broker_phone_number' => $row['phone_number'],
                ]);
            } else {
                Broker::create([
                    'user_id' => Auth::user()->id,
                    'broker_name' => $row['name'],
                    'broker_email' => $row['email'],
                    'broker_phone_number' => $row['phone_number'],
                ]);
            }
        }
    }
    
}