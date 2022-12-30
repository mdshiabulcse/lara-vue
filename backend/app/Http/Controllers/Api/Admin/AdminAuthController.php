<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLoginRequest;
use App\Http\Requests\Admin\AdminRegisterRequest;
use App\Http\Resources\User\AuthResource;
use App\Models\Auth\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminAuthController extends Controller
{
    public function login(AdminLoginRequest $request){
        $admin = Admin::where('phone', $request->phone)->first();

        if (! $admin || ! Hash::check($request->password, $admin->password)) {
            throw ValidationException::withMessages([
                'phone' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $this->makeToken($admin);
    }
    public function register(AdminRegisterRequest $request){
        $admin=Admin::create([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'phone'=>$request->input('phone'),
            'password'=>bcrypt($request->input('password')),
        ]);

        return $this->makeToken($admin);
    }
    public  function makeToken($admin){
        $token= $admin->createToken('admin-token')->plainTextToken;
        return (new AuthResource($admin))
            ->additional(['meta' => [
                'token' => $token,
                'token_type' => 'Bearer',
            ]]);
    }
//    public function logout(Request $request){
//        $request->user()->tokens()->delete();
//        return send_ms('User Logout',true,200);
//
//    }
//    public function user(Request $request){
//        return AuthResource::make($request->user());
//
//    }
}
