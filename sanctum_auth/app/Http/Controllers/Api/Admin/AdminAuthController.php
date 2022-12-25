<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLoginRequest;
use App\Http\Resources\Admin\AdminAuthResource;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminAuthController extends Controller
{
        // user login===============
        public function Login(AdminLoginRequest $request){

            $admin = Admin::where('phone', $request->phone)->first();
     
        if (! $admin || ! Hash::check($request->password, $admin->password)) {
            throw ValidationException::withMessages([
                'phone' => ['The provided credentials are incorrect.'],
            ]);
        }
     
        return $this->makeToken($admin);
    
        }
    
        // token generate================
    public function makeToken($admin){
        $token =  $admin->createToken('admin-token')->plainTextToken;
        return (new AdminAuthResource($admin))
                    ->additional(['meta' => [
                        'token' => $token,
                        'token_type' => 'Bearer',
                    ]]);
    }
    public function Logout(Request $request){
        // Revoke all tokens...
        $request->user()->tokens()->delete();
        return send_ms('Admin Logout',true,200);
    }


    public function User(Request $request){
        return AdminAuthResource::make($request->user());
    }
}
