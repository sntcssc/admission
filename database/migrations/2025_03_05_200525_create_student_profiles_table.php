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
        Schema::create('student_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('dob');
            $table->string('gender')->comment('Male, Female, Others');
            $table->string('category')->nullable()->comment('UR, SC, ST, OBC A, OBC B');
            $table->boolean('is_pwbd')->default(false);
            $table->string('occupation')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->string('mobile')->nullable();
            $table->string('alternate_mobile')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email');
            $table->string('alternate_email')->nullable();
            $table->decimal('family_income', 10, 2)->nullable();
            $table->string('school_language')->nullable();
            $table->string('secondary_roll')->nullable();
            $table->string('upsc_community')->nullable()->comment('UR, SC, ST, OBC');
            $table->json('activities')->nullable();
            $table->json('hobbies')->nullable();
            $table->decimal('distance', 5, 2)->nullable();
            $table->date('valid_from')->nullable();
            $table->date('valid_until')->nullable();
            $table->boolean('is_current')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_profiles');
    }
};
