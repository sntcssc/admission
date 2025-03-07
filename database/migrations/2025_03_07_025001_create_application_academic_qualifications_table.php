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
        Schema::create('application_academic_qualifications', function (Blueprint $table) {
            $table->id();$table->foreignId('application_id')->constrained()->cascadeOnDelete();
            $table->string('level')->comment('Secondary, Higher Secondary, Graduation, Post Graduation, Other');
            $table->string('institute');
            $table->string('board_university');
            $table->text('subjects')->nullable();
            $table->year('year_passed');
            $table->decimal('total_marks', 5, 2)->nullable();
            $table->decimal('marks_obtained', 5, 2)->nullable();
            $table->decimal('percentage', 5, 2)->nullable();
            $table->decimal('cgpa', 4, 2)->nullable();
            $table->string('division')->nullable();
            $table->boolean('is_completed')->default(false);
            $table->boolean('verification_status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_academic_qualifications');
    }
};
