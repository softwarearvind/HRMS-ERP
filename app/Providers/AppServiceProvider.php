<?php

namespace App\Providers;
use App\Models\Notification;
use Illuminate\Support\Facades\View;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
          View::composer('*', function ($view) {

        if (auth()->check()) {

            $view->with('notifCount',
                Notification::where('user_id', auth()->id())
                    ->where('is_read', 0)
                    ->count()
            );

            $view->with('notifList',
                Notification::where('user_id', auth()->id())
                    ->latest()
                    ->take(5)
                    ->get()
            );
        }

    });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
