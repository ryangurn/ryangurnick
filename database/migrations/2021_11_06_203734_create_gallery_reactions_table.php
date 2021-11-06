<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleryReactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery_reactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gallery_image_id');
            $table->unsignedBigInteger('reaction_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('session_id');
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
        Schema::dropIfExists('gallery_reactions');
    }
}
