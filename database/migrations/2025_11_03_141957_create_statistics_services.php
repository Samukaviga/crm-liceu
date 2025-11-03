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
        Schema::create('statistics_services', function (Blueprint $table) {
            $table->id();

            $table->string('start_of_service')->nullable();
            $table->string('end_of_service')->nullable();
            $table->string('person_start_service')->nullable();
            $table->string('name_client')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('grade')->nullable();
            $table->string('comment')->nullable();
            $table->string('matter')->nullable();
            $table->string('resume')->nullable();
            $table->string('person_finished_service')->nullable();
            $table->string('total_service_time')->nullable();
            $table->string('total_after_person_start')->nullable();
            $table->string('total_time_queue')->nullable();
            $table->string('total_time_department')->nullable();
            $table->string('time_between_responses')->nullable();
            $table->string('during_working_hours')->nullable();
            $table->string('unique_sellflux')->unique();
            $table->string('school')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistics_services');
    }
};
