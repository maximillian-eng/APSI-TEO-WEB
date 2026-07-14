<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (App::environment('production') && ! config('app.key')) {
            $key = 'base64:' . base64_encode(random_bytes(32));
            config(['app.key' => $key]);
            file_put_contents(
                app()->environmentPath() . DIRECTORY_SEPARATOR . '.env',
                'APP_KEY=' . $key . PHP_EOL,
                FILE_APPEND
            );
        }
    }
}
