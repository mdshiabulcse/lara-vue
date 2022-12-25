<?php

namespace Database\Seeders;

use App\Models\Seller;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SellerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Seller::create([
            'name' => 'seller',
            'email' => 'seller@gmail.com',
            'phone' => '01724521240',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
            'remember_token' => Str::random(10),
        ]);
    }
}
