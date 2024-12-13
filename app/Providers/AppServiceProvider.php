<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\NoCache;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

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
        $this->app['router']->aliasMiddleware('nocache', \App\Http\Middleware\NoCache::class);
        Inertia::share('auth.user', function () {
            if (Auth::check()) {
                $user = Auth::user();
                return [
                    'id' => $user->id,
                    'crew_id' => $user->crew_id,
                    'name' => $user->name,
                    'role' => $user->role,
                    'phone' => $user->phone,
                ];
            }
            return null;
        });
    }
}
