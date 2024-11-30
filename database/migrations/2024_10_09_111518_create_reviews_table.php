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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255); 
            $table->string('mobile', 15);
            $table->string('email', 255); 
            $table->string('city', 255); 
            $table->float('rating'); 
            $table->text('message'); 
            $table->timestamp('review_date')->useCurrent(); 
            $table->string('image_url', 255)->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
