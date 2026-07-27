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
        $this->app->bind('path.public', function () {
            if (file_exists(base_path('public_html'))) {
                return base_path('public_html');
            }
            return base_path('public');
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Pagination\Paginator::useBootstrapFive();

        \Illuminate\Support\Facades\View::composer(['layouts.footer', 'pages.home', 'layouts.header'], function ($view) {
            $footerStates = \App\Models\State::active()->orderBy('name')->take(10)->get();
            $footerCities = \App\Models\City::active()->with(['content', 'state'])->orderBy('name')->take(10)->get();
            $view->with(compact('footerStates', 'footerCities'));
        });
    }
}
