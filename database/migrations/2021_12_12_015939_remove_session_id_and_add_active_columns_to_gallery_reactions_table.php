<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveSessionIdAndAddActiveColumnsToGalleryReactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gallery_reactions', function (Blueprint $table) {
            $table->dropColumn('session_id');
            $table->boolean('active')->default(1)->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gallery_reactions', function (Blueprint $table) {
            $table->unsignedBigInteger('session_id');
            $table->dropColumn('active');
        });
    }
}
