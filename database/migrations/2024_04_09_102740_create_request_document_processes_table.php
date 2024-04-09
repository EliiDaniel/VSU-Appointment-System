<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('request_document_processes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('document_process_id');
            $table->unsignedBigInteger('request_document_id');
            $table->timestamps();

            $table->foreign('document_process_id')->references('id')->on('document_processes')->onDelete('cascade');
            $table->foreign('request_document_id')->references('id')->on('request_documents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_document_processes');
    }
};
