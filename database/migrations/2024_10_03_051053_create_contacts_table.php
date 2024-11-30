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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('destination');
            $table->string('email');
            $table->string('phone');
            $table->date('arrival_date'); // Arrival date
            $table->date('departure_date'); // Departure date
            $table->string('package_id');
            $table->string('no_of_adult');
            $table->string('no_of_child');
            $table->text('comment');
            $table->string('form_type');
            $table->enum('status', ['0', '1', '2','3','4','5'])->default('0')->comment('0: Pending, 1: success, 2: call again, 3: not intrested, 4: under process, 5:price issue', );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
