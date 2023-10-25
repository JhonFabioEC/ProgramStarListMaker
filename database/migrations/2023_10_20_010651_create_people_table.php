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
        Schema::create('people', function (Blueprint $table) {
            // $table->unsignedBigInteger('id');
            $table->id();
            $table->string('first_name', 60);
            $table->string('last_name', 60);
            $table->date('birth_date');
            $table->char('sex', 1);
            $table->string('document_number', 20);
            $table->string('phone_number', 20);
            $table->string('zone_type');
            $table->string('address', 60);
            // $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
