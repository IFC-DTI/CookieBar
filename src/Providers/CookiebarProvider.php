<?php

namespace IFC\Cookiebar\Providers;

use IFC\Cookiebar\Middleware\AppendFiles;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Http\Kernel;

class CookiebarProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/cookiebar-routes.php');
        $this->registerMiddleware(AppendFiles::class);

        $this->publishes([
            __DIR__.'/../assets/js/configuracoes_cookiebar_govbr.json' => public_path('js/configuracoes_cookiebar_govbr.json'),
        ], 'laravel-assets');
    }

    /**
     * Register the Cookiebar Middleware
     *
     * @param  string $middleware
     */
    protected function registerMiddleware($middleware)
    {
        $kernel = $this->app[Kernel::class];
        $kernel->pushMiddleware($middleware);

    }
}
