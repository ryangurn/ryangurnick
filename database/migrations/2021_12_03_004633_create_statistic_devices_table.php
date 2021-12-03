<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistic_devices', function (Blueprint $table) {
            $table->id();
            $table->string('session_id', 255);
            $table->string('browser');
            $table->string('browser_version');
            $table->string('platform');
            $table->string('platform_version');
            $table->string('device');
            $table->boolean('desktop');
            $table->boolean('mobile');
            $table->boolean('mobile_bot');
            $table->boolean('tablet');
            $table->boolean('bot');
            $table->boolean('robot');
            $table->string('robot_name');
            $table->string('languages');
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
        Schema::dropIfExists('statistic_devices');
    }
}
