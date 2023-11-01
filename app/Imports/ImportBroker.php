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
        $customMessages = [
            'required' => 'The field is required.',
            'unique' => 'The field is allready exists.' ,
            'digits' => 'The number field must be 10 digits.',
            'email' => 'The field must be a valid email address.'
        ];
        
        $validator = Validator::make($rows->toArray(), [
             '*.name' => "required",
             '*.email' =>'required|email',
             '*.phone_number' => 'required|digits:10',
        ],$customMessages);
            
        foreach($rows as $key=>$row){
                $validator->addRules([
                $key.'.name' => 'unique:brokers,broker_name,'.$row['id'],
                $key.'.email' => 'unique:brokers,broker_email,'.$row['id'],
                $key.'.phone_number' => 'unique:brokers,broker_phone_number,'.$row['id'],
            ]);
        }

        $validator->validate();
    
        foreach ($rows as $key=>$row) 
        {
            $check = Broker::where('id', "=", $row['id'])
            ->orWhere('broker_name', '=', $row['name'])
            ->orWhere('broker_email', '=', $row['email'])
            ->orWhere('broker_phone_number', '=', $row['phone_number'])->exists();
            
            if(!$check){
                if($row['id']){
                    $role = Broker::find($row['id']);
                    $role->update([
                        'user_id' =>  $role->user_id ? $role->user_id : Auth::user()->id,
                        'broker_name' => $row['name'],
                        'broker_email' => $row['email'],
                        'broker_phone_number' => $row['phone_number'],
                    ]);
                } 
                else {
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
    
}