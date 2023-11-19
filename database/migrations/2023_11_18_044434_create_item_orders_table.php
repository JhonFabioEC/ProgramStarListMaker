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
        Schema::create('item_orders', function (Blueprint $table) {
            $table->id();
            $table->string('name', 60);
            $table->float('price', 10, 2);
            $table->integer('quantity');
            $table->string('barcode', 13);
            $table->string('image', 250);
            $table->string('category', 60);
            $table->string('brand', 60);
            $table->string('establishment', 60);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_orders');
    }
};
