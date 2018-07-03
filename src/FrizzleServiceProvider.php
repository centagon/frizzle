<?php

namespace Centagon\Frizzle;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class FrizzleServiceProvider extends ServiceProvider
{
    use ServiceBindings;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerRoutes();
    }

    /**
     * Register the Frizzle routes.
     *
     * @return void
     */
    protected function registerRoutes(): void
    {
        Route::prefix(config('frizzle.uri', 'frizzle'))
            ->namespace('Centagon\Frizzle\Http\Controllers')
            ->group(__DIR__.'/../routes/api.php');
    }

    /**
     * Register any application services.
     *
     * @return void
     * @throws \Exception
     */
    public function register(): void
    {
        $this->configure();
        $this->offerPublishing();
        $this->registerServices();
    }

    /**
     * Setup the configuration for Frizzle.
     *
     * @return void
     * @throws \Exception
     */
    protected function configure()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/frizzle.php', 'frizzle');

        Frizzle::use(config('frizzle.use'));
    }

    /**
     * Setup the resource publishing groups for Frizzle.
     *
     * @return void
     */
    protected function offerPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/frizzle.php' => config_path('frizzle.php'),
            ], 'frizzle-config');
        }
    }

    /**
     * Register the Frizzle's services in the container.
     *
     * @return void
     */
    protected function registerServices(): void
    {
        foreach ($this->serviceBindings as $key => $value) {
            is_numeric($key)
                ? $this->app->singleton($value)
                : $this->app->singleton($key, $value);
        }
    }
}
