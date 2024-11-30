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
        Schema::create('packages', function (Blueprint $table) {
            $table->id(); 
            $table->string('name'); // Package name
            $table->text('description'); // Description of the package
            $table->string('images'); // Multiple images stored as JSON array
            $table->date('arrival_date'); // Arrival date
            $table->date('departure_date'); // Departure date
            $table->decimal('amount', 10, 2); // Amount for the package
            $table->string('days'); // Number of days
            $table->string('nights'); // Number of nights
            $table->string('location'); // Location of the tour
            $table->string('about_tour'); // Additional details about the tour stored as JSON array
            $table->string('tour_description'); // Tour description stored as JSON array
            $table->string('package_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
