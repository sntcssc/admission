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
        Schema::table('otp_verifications', function (Blueprint $table) {
            $table->unsignedSmallInteger('resend_count')->default(0);
            $table->timestamp('last_resend_at')->nullable();
            $table->timestamp('verified_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('otp_verifications', function (Blueprint $table) {
            //
            $table->dropColumn(['resend_count', 'last_resend_at', 'verified_at']);
        });
    }
};
