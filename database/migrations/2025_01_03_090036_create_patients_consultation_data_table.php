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
        // Schema::create('patients_consultation_data', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('patient_id');
        //     $table->string('doctor_name');
        //     $table->json('data');
        //     $table->timestamps();
        //     $table->foreign('patient_id')->references('id') ->on('patients')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients_consultation_data');
    }
};
