<?php

namespace App\Providers;

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
        // Force HTTPS in production
        if (config('app.env') === 'production') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
        
        // Share social links with all views (or specific layouts)
        \Illuminate\Support\Facades\View::composer(['components.app-layout', 'home'], function ($view) {
             $view->with('socialLinks', \App\Models\SocialLink::orderBy('sort_order')->get());
             $view->with('contactInfos', \App\Models\ContactInfo::where('active', true)->orderBy('sort_order')->get());
             $view->with('techStacks', \App\Models\TechStack::where('active', true)->orderBy('sort_order')->get());
        });
    }
}
