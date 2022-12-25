<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_models', function (Blueprint $table) {
            $table->id();
            $table->string('shop_name')->nullable();
            $table->string('shop_phone')->nullable();
            $table->string('shop_location')->nullable();
            $table->string('shop_img')->nullable();
            $table->string('address_latitude')->nullable();
            $table->string('address_longitude')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_models');
    }
}
