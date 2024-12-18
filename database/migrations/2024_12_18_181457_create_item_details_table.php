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
        Schema::create('item_details', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->unsignedBigInteger('item_id');
            $table->string('bureau_name');
            $table->string('bureau_status');
            $table->string('item_name');
            $table->string('item_type');
            $table->string('account_no');
            $table->date('open_date');
            $table->boolean('status')->default(1);
            $table->unsignedBigInteger('instruction_id');
            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('instruction_id')->references('id')->on('instructions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_details');
    }
};
