<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents_files', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('price');
            $table->unsignedInteger('situation_id');
            $table->timestamps();
            $table->foreign('situation_id')->references('id')->on('situations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents_files');
    }
}
