<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
        View::composer('*', function ($view) {
            $businessName = 'Shree Aurum Jewellers';
            $tagline = 'Trusted Gold & Diamond Showroom';

            if (Schema::hasTable('settings')) {
                try {
                    $businessName = Setting::get('business_name', 'Shree Aurum Jewellers') ?: 'Shree Aurum Jewellers';
                    $tagline = Setting::get('tagline', 'Trusted Gold & Diamond Showroom') ?: 'Trusted Gold & Diamond Showroom';
                } catch (\Throwable) {
                    // fallback
                }
            }

            $view->with('businessName', $businessName);
            $view->with('businessTagline', $tagline);
        });
    }
}
