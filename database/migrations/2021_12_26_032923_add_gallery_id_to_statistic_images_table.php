<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGalleryIdToStatisticImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('statistic_images', function (Blueprint $table) {
            $table->unsignedBigInteger('gallery_id')->after('session_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('statistic_images', function (Blueprint $table) {
            $table->dropColumn('gallery_id');
        });
    }
}
