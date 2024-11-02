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
        Schema::create('surgeries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('anesthesia_type');
            $table->string('result')->nullable();
            $table->date('date');
            $table->time('hour');
            $table->time('end_hour')->nullable();
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
        Schema::dropIfExists('surgeries');
    }
};
