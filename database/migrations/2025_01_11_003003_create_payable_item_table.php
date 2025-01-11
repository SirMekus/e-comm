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
        Schema::create('payable_items', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('product_name');
            $table->integer('quantity')->default(1);
            $table->unsignedBigInteger('price');
            $table->string('currency')->default("NGN");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payable_items');
    }
};
