<?php

namespace App\Providers;

use App\Services\ToastService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\ServiceProvider;

class ToastServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->instance(ToastService::class, new ToastService());

        RedirectResponse::macro('toast', function () {
            $toast = resolve(ToastService::class);

            $args = func_get_args();

            $type = $args[0];

            array_shift($args);

            $toast->{$type}(...$args);

            return $this;
        });
    }
}
