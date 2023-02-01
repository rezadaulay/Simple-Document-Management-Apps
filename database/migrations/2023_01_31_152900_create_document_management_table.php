<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_management', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('signing_type', 10);
            $table->string('signing_image')->nullable();
            $table->text('signing_manual')->nullable();
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
        Schema::dropIfExists('document_management');
    }
}
