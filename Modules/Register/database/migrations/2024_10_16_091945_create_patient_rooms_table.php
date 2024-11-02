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
        Schema::create('patient_rooms', function (Blueprint $table) {
            $table->id();
            $table->date('entry_date');
            $table->date('exit_date')->nullable();
            $table->foreignId('admission_id')->constrained('admissions','id');
            $table->foreignId('room_id')->constrained('rooms','id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_rooms');
    }
};
