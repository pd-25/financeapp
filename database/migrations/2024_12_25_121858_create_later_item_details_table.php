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
        Schema::create('later_item_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_detail_id');
            $table->foreign('item_detail_id')->references('id')->on('item_details');
            $table->unsignedBigInteger('later_id');
            $table->foreign('later_id')->references('id')->on('laters');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('later_item_details');
    }
};
