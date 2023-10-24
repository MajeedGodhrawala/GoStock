<?php

namespace App\Http\Controllers;

use App\Models\Broker;
use App\Http\Requests\BrokerFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BrokerController extends Controller
{
    public function broker(){
        return Inertia::render('broker',['user' => Auth::user()]);
    }

    public function createOrUpdate(BrokerFormRequest $request){
        if($request->id){
            $role = Broker::find($request->id);
            $role->update($request->requestedField());
        } else {
            Broker::create($request->requestedField());
        }
        return response()->json([
            'success' => $request->broker_name.' Is '.($request->id ? 'Updated' : 'Added')]);
    } 

    public function destroy(Broker $Broker){
        $Broker->delete();
        return response()->json(['delete' => 'Record '.$Broker->broker_name.' Is Deleted.']);
    }

    public function getAllBroker(Request $request){
        $pages = (count(Broker::where('user_id', '=', Auth::user()->id)->get())) / $request->per_page;
        $broker = Broker::where('user_id', '=', Auth::user()->id)->offset($request->per_page * ($request->page - 1))->limit($request->per_page)->get();
        return response()->json(['broker_data' => $broker,'pages' => ceil($pages)]);
    }
}