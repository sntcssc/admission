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
        Schema::create('upsc_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained();
            $table->foreignId('application_id')->constrained();
            $table->year('exam_year');
            $table->string('roll_number');
            $table->boolean('prelims_cleared')->default(false);
            $table->boolean('mains_cleared')->default(false);
            $table->unsignedTinyInteger('attempt_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upsc_attempts');
    }
};
