<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Gate::define('manage-products', function (User $user) {
            return $user->email === 'admin@gmail.com';
        });

        Gate::define('delete-product', function (User $user) {
            return in_array($user->email, [
                'admin@gmail.com',
            ]);
        });
    }
}
