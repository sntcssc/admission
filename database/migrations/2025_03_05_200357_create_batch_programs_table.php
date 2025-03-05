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
        Schema::create('batch_programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('batch_id')->constrained();
            $table->foreignId('program_id')->constrained();
            $table->decimal('fee', 10, 2);
            $table->integer('available_seats');
            $table->integer('max_applications')->nullable();
            $table->enum('status', ['open', 'closed'])->default('open');
            $table->timestamps();
        
            $table->unique(['batch_id', 'program_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batch_programs');
    }
};
