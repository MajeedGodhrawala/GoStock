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
        $query = Broker::query();
        $query->where('user_id', '=', Auth::user()->id);

        if($request->search) {
            $query->where('broker_name', 'like', '%' .$request->search. '%')
            ->orWhere('broker_email', 'like', '%' .$request->search. '%')
            ->orWhere('broker_phone_number', 'like', '%' .$request->search. '%');
        }
        $total_records = count($query->get());
        $pages = $total_records / $request->per_page;
        
        $query->offset($request->per_page * ($request->page - 1))
                   ->limit($request->per_page);
        $records = $query->get();

        return response()->json(['broker_data' => $records,'pages' => ceil($pages),'total_records' => $total_records ]);
        
        // if($request->search){
        //     $pages = (count(Broker::where('user_id', '=', Auth::user()->id)
        //     ->where('broker_name', 'like', '%' .$request->search. '%')
        //     ->orWhere('broker_email', 'like', '%' .$request->search. '%')
        //     ->orWhere('broker_phone_number', 'like', '%' .$request->search. '%')
        //     ->get())) / $request->per_page;
            
        //     $broker = Broker::where('user_id', '=', Auth::user()->id)
        //     ->where('broker_name', 'like', '%' .$request->search. '%')
        //     ->orWhere('broker_email', 'like', '%' .$request->search. '%')
        //     ->orWhere('broker_phone_number', 'like', '%' .$request->search. '%')
        //     ->offset($request->per_page * ($request->page - 1))
        //     ->limit($request->per_page)
        //     ->get();
        // } else {
        //     $pages = (count(Broker::where('user_id', '=', Auth::user()->id)->get())) / $request->per_page;
        //     $broker = Broker::where('user_id', '=', Auth::user()->id)
        //     ->offset($request->per_page * ($request->page - 1))
        //     ->limit($request->per_page)->get();
        // }
        // return response()->json(['broker_data' => $broker,'pages' => ceil($pages)]);
    }
}