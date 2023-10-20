<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleFormRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RoleController extends Controller
{
    public function role(){
        return Inertia::render('role');
    }

    public function createOrUpdate(RoleFormRequest $request){
        if($request->id){
            $role = Role::find($request->id);
            $role->update($request->requestedField());
        } else {
            Role::create($request->requestedField());
        }
        return response()->json([
            'success' => $request->display_name.' Is '.($request->id ? 'Updated' : 'Added')]);
    } 

    public function destroy(Role $role){
        $role->delete();
        return response()->json(['delete' => 'Record '.$role->display_name.' Is Deleted.']);
    }

    public function getAllRole(){
        return response()->json(['role_data' => Role::all()]);
    }
}
