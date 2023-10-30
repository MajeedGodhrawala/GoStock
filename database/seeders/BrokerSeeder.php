<?php

namespace Database\Seeders;

use App\Models\Broker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BrokerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [];
        for($i=0; $i < 30; $i++){
            array_push($datas,[
               'user_id' => 2,
                'broker_name' => 'b'.$i,
                'broker_email' => 'b'.$i.'@gmail.com',
                'broker_phone_number' => 123456700+$i, 
            ]);
        }

        foreach($datas as $data){
             Broker::create($data);
        }
    }
}