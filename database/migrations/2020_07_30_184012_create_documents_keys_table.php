<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateDocumentsKeysTable
 */
class CreateDocumentsKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents_keys', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('document_file_id');
            $table->string('title');
            $table->string('key');
            $table->timestamps();
            $table->foreign('document_file_id')->references('id')->on('documents_files')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents_keys');
    }
}
