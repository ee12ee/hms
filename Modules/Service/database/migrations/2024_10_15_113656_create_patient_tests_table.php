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
        Schema::create('patient_tests', function (Blueprint $table) {
            $table->id();
            $table->string('result')->nullable();
            $table->text('description')->nullable();
            $table->date('date');
            $table->foreignId('test_id')->constrained('tests','id');
            $table->foreignId('admission_id')->constrained('admissions','id');
            $table->foreignId('doctor_id')->constrained('doctors','id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_tests');
    }
};