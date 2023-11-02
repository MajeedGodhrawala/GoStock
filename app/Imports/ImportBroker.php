<?php

namespace App\Imports;

use App\Models\Broker;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Calculation\Information\Value;
use PhpOffice\PhpSpreadsheet\Calculation\Logical\Boolean;
use PhpParser\Node\Expr\Cast\Array_;

class ImportBroker implements ToCollection, WithHeadingRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public $summery = [
        'total_records'=> 0,
         'create' => 0,
         'update' => 0,
      ];

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
    
        $validator->validate();
        foreach ($rows as $key=>$row) 
        {  
            $check_broker = Broker::where('id', '=', $row['id'])
                ->orWhere('broker_name', '=', $row['name'])
                ->first();
            
            $broker = $check_broker ?? new Broker();
            $broker->fill([
                        'user_id' =>  $broker->user_id ? $broker->user_id : Auth::user()->id,
                        'broker_name' => $row['name'],
                        'broker_email' => $row['email'],
                        'broker_phone_number' => $row['phone_number'],
                    ])->save();
                    
            $this->summery['total_records'] = count($rows);
            $this->summery[$check_broker ? 'update' : 'create']++;
        }
    }
}