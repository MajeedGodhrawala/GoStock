<?php

namespace App\Http\Controllers;

use App\Models\Broker;
use App\Http\Requests\BrokerFormRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BrokerController extends Controller
{
    public function broker(){
        return Inertia::render('broker',['user' => Auth::user()]);
    }

    public function create(BrokerFormRequest $request){
        Broker::create($request->requestedField());
        return response()->json([
            'success' => 'Record '.$request->broker_name.' Is Added.'
        ]);
    } 

    public function update(BrokerFormRequest $request){
        $broker = Broker::find($request->id);
        $broker->update($request->requestedField());
        return response()->json(['updated' => 'Record '.$request->first_name.' '.$request->last_name.' Is Updated']);
    }

    public function destroy(Broker $Broker){
        $Broker->delete();
        return response()->json(['delete' => 'Record '.$Broker->broker_name.' Is Deleted.']);
    }

    public function getAllBroker(){
        return response()->json(['broker_data' => Broker::all()]);
    }
}
