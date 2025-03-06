<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\Contracts\StudentServiceInterface;
use App\Services\StudentService;

use App\Repositories\Contracts\StudentRepositoryInterface;
use App\Repositories\StudentRepository;

use App\Services\Contracts\OtpServiceInterface;
use App\Services\OtpService;

use App\Repositories\Contracts\OtpRepositoryInterface;
use App\Repositories\OtpRepository;

use App\Services\ApplicationService;
use App\Services\Contracts\ApplicationServiceInterface;

use App\Repositories\Contracts\ApplicationRepositoryInterface;
use App\Repositories\ApplicationRepository;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        $this->app->bind(StudentServiceInterface::class, StudentService::class);
        $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);
        $this->app->bind(OtpServiceInterface::class, OtpService::class);
        $this->app->bind(OtpRepositoryInterface::class, OtpRepository::class);
        $this->app->bind(ApplicationServiceInterface::class, ApplicationService::class);
        $this->app->bind(
            ApplicationRepositoryInterface::class,
            ApplicationRepository::class
        );

    }
}
