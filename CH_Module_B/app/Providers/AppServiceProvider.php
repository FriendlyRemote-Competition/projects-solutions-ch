<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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
        Auth::viaRequest('api-token', function (Request $request) {
            return User::where("is_active", 1)->where('token', (string) str_replace("Bearer ", "", $request->header("Authorization")))->first();
        });

        Gate::define('admin', function (User $user) {
            return $user->role === 'admin';
        });
    }
}
