<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateDocumentsTable
 */
class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents-keys', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('document_file_id');
            $table->string('title');
            $table->string('key');
            $table->timestamps();
            $table->foreign('document_file_id')->references('id')->on('documents_files');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents-keys');
    }
}
