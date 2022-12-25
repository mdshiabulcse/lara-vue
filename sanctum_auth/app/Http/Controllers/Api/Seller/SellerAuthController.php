<?php

namespace App\Http\Controllers\Api\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\SellerLoginRequest;
use Illuminate\Http\Request;
use App\Http\Resources\Admin\AdminAuthResource;
use App\Http\Resources\Seller\SellerAuthResource;
use App\Models\Seller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class SellerAuthController extends Controller
{
      // user login===============
      public function Login(SellerLoginRequest $request){

        $seller = Seller::where('phone', $request->phone)->first();
 
    if (! $seller || ! Hash::check($request->password, $seller->password)) {
        throw ValidationException::withMessages([
            'phone' => ['The provided credentials are incorrect.'],
        ]);
    }
 
    return $this->makeToken($seller);

    }

    // token generate================
public function makeToken($seller){
    $token =  $seller->createToken('seller-token')->plainTextToken;
    return (new SellerAuthResource($seller))
                ->additional(['meta' => [
                    'token' => $token,
                    'token_type' => 'Bearer',
                ]]);
}
public function Logout(Request $request){
    // Revoke all tokens...
    $request->user()->tokens()->delete();
    return send_ms('Seller Logout',true,200);
}


public function User(Request $request){
    return SellerAuthResource::make($request->user());
}
}
