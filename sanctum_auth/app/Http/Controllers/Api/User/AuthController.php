<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Resources\User\AuthResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // user login===============
    public function Login(LoginRequest $request){

        $user = User::where('phone', $request->phone)->first();
 
    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'phone' => ['The provided credentials are incorrect.'],
        ]);
    }
 
    return $this->makeToken($user);

    }

    // user register===================
    public function Register(RegisterRequest $request){

        $user=new User();
        $user->name = $request->name;-
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->save();
 
    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'phone' => ['The provided credentials are incorrect.'],
        ]);
    }
    return $this->makeToken($user);
    }

    // token generate================
    public function makeToken($user){
        $token =  $user->createToken('user-token')->plainTextToken;
        // return AuthResource::make($user);
        return (new AuthResource($user))
                    ->additional(['meta' => [
                        'token' => $token,
                        'token_type' => 'Bearer',
                    ]]);
    }
    public function Logout(Request $request){
        // Revoke all tokens...
        $request->user()->tokens()->delete();
        return send_ms('User Logout',true,200);
    }


    public function User(Request $request){
        return AuthResource::make($request->user());
    }
}
