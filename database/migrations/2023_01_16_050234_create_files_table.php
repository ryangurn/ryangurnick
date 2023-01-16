<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->nullableMorphs('item');
            $table->uuid('hash');
            $table->string('original_name');
            $table->integer('size');
            $table->string('mime_type');
            $table->boolean('photo');
            $table->timestamps();
        });

        $binary = 'database.connections.mysql.database';
        $database = config($binary);
        DB::statement('ALTER TABLE '.$database.'.files ADD content LONGBLOB AFTER `original_name`;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
