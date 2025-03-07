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
        Schema::create('application_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained()->cascadeOnDelete();
            $table->string('type')->comment('present, permanent');
            $table->string('state');
            $table->string('district');
            $table->string('subdistrict')->nullable();
            $table->text('address_line1');
            $table->text('address_line2')->nullable();
            $table->string('post_office');
            $table->string('police_station');
            $table->string('pin_code', 10);
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_addresses');
    }
};
