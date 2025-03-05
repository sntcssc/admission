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
        Schema::create('advertisement_programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('advertisement_id')->constrained();
            $table->foreignId('batch_program_id')->constrained();
            $table->integer('available_seats');
            $table->timestamps();
            
            $table->unique(['advertisement_id', 'batch_program_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisement_programs');
    }
};
