<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class AddDateToGalleryImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gallery_images', function (Blueprint $table) {
            $table->dateTime('date')->after('caption')->default('current_timestamp()');
            $table->string('people')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gallery_images', function (Blueprint $table) {
            $table->dropColumn('date');
            $table->string('people')->change();
        });
    }
}
