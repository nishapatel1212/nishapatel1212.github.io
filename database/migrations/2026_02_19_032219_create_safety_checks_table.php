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
        Schema::create('safety_checks', function (Blueprint $table) {
            $table->id();
            $table->string('customer');
            $table->string('contact')->nullable();
            $table->text('property_address');
            $table->string('job_number');
            $table->string('previous_inspection')->nullable();
            $table->date('inspection_date')->nullable();
            $table->date('next_inspection_due')->nullable();
            $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('safety_checks');
    }
};
