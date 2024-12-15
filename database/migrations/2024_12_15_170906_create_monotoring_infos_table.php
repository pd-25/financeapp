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
        Schema::create('monotoring_infos', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->unsignedBigInteger('report_source_id');
            $table->unsignedBigInteger('client_id');
            $table->string('username');
            $table->string('password');
            $table->string('security_word');
            $table->timestamps();
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('report_source_id')->references('id')->on('report_sources');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monotoring_infos');
    }
};
