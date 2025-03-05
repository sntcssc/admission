<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\OtpVerification;

class CleanupExpiredOtps extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cleanup-expired-otps';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    // protected $signature = 'otp:cleanup';
    // protected $description = 'Remove expired OTP entries';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $deleted = OtpVerification::where('expires_at', '<', now())->delete();
        $this->info("Cleaned up {$deleted} expired OTP entries");
        return 0;
    }
}
