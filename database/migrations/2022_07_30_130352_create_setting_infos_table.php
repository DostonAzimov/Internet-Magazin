<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_infos', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('phoneNumber');
            $table->string('phoneNumber2');
            $table->string('address');
            $table->string('map');
            $table->string('facebook');
            $table->string('instagram');
            $table->string('youtube');
            $table->string('telegram');
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
        Schema::dropIfExists('setting_infos');
    }
};
