<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Repositories\ApplicationRepositoryInterface::class,
            \App\Repositories\ApplicationRepository::class
        );
        
        $this->app->bind(
            \App\Services\PaymentServiceInterface::class,
            \App\Services\RazorpayPaymentService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Prevent lazy loading
        Model::preventLazyLoading(!app()->isProduction());
    
        // Force HTTPS in production
        if(config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    
        // Custom validation rules
        Validator::extend('strong_password', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $value);
        }, 'Password must contain at least 8 characters, including uppercase, lowercase, number and special character');

        
        // Secure headers middleware
        $this->app['router']->middlewareGroup('secure-headers', [
            \App\Http\Middleware\SecureHeaders::class,
        ]);

        // Query protection
        Builder::macro('safeWhere', function ($column, $value) {
            if (!in_array($column, $this->model->getFillable())) {
                throw new \InvalidArgumentException("Column $column is not allowed");
            }
            return $this->where($column, $value);
        });
    }
}
