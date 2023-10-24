<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\UserFormRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Inertia\Inertia;

class GuestController extends Controller
{
    public function login(){
        if(Auth::user()) {
            $this->logout();
            // return Redirect("dashboard");
        }
        
        return view('Login_Register.Login');
    }

    public function register(){
        if(Auth::user()) {
            return Redirect("dashboard");
        } else {
        return view('Login_Register.Register');
        }
    }
    
    public function unauthenticatPage(){
        return Inertia::render('unauthenticatPage');
    }

    public function createUser(UserFormRequest $request){
        User::create($request->requestedField());
        // $user = new User();
        // $user->fill($request->requestedField())->save();
        return response()->json([
            'success' => 'Record '.$request->first_name.' '.$request->last_name.' Is Added In Data'
        ]);
    }

    public function loginUser(LoginFormRequest $request){
        $credentials = [];
        if(Str::contains($request->email_phonenumber,'@')){
            $credentials = $request->requestedFieldEmail();
        } else if(Str::contains($request->email_phonenumber,['0','1','2','3','4','5','6','7','8','9'])) {
            $credentials = $request->requestedFieldPhoneNumber();
        } else {
            return response()->json([
                'login_error' => $request->email_phonenumber.' Not Found !!'
            ]);
        }

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if($user){
                $user->load('role.permissions');
                $user_permissions = $user->role->permissions->pluck('name')->all();
                return response()->json([
                    'success' => $user->first_name.' '.$user->last_name,
                    'user_permissions' => $user_permissions,
                ]);
            }
        } else {
            return response()->json([
                'login_error' => 'Email Or Password Is Not Found !!'
            ]);
        }
    }

    public function logout() {
        Auth::logout();
        return redirect('login');
      }
}