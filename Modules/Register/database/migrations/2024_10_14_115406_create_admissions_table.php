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
        Schema::create('admissions', function (Blueprint $table) {
            $table->id();
            $table->date('admission_date');
            $table->date('discharge_date')->nullable();
            $table->string('discharge_reason')->nullable();
            $table->foreignId('patient_id')->constrained('patients','id');
            $table->foreignId('doctor_id')->nullable()->constrained('doctors','id');
            $table->string('patient_complaint');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admissions');
    }
};
