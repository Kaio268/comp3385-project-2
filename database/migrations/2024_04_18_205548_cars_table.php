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
        Schema::create('cars', function (Blueprint $table){
            $table->id();
            $table->string('description');
            $table->string('make');
            $table->string('model');
            $table->string('colour');
            $table->string('year');
            $table->string('transmission');
            $table->string('car_type');
            $table->decimal('price',8, 2);
            $table->string('photo');
            $table->foreignId('user_id')->constrained();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
