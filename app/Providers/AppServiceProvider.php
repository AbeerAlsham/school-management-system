<?php

namespace App\Providers;

use App\Models\Attendance;
use App\Models\BookDelivery;
use App\Observers\AttendanceObserver;
use App\Observers\BookDeliveryObserver;
use Illuminate\Support\ServiceProvider;

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
        Attendance::observe(AttendanceObserver::class);
        BookDelivery::observe(BookDeliveryObserver::class);
    }
}
