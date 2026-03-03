<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Blade directive: @canDo('agenda', 'tambah') ... @endCanDo
        Blade::directive('canDo', function ($expression) {
            return "<?php if(\\App\\Helpers\\PermissionHelper::can({$expression})): ?>";
        });

        Blade::directive('endCanDo', function () {
            return "<?php endif; ?>";
        });
    }
}