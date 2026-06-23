<?php

/*
 * This file is part of the IndoBank package.
 *
 * (c) Andri Desmana <andridesmana.pw | andridesmana29@gmail.com>
 *
 */

namespace Andes2912\IndoBank;

use Illuminate\Support\ServiceProvider;

/**
 * IndoBank Service Provider
 */
class IndoBankServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/database/migrations' => $this->app->databasePath('migrations'),
            ], 'indobank-migrations');

            $this->publishes([
                __DIR__.'/database/seeders' => $this->app->databasePath('seeders'),
            ], 'indobank-seeders');

            $this->publishes([
                __DIR__.'/database/models' => $this->app->path('Models'),
            ], 'indobank-models');

            $this->publishes([
                __DIR__.'/database/migrations' => $this->app->databasePath('migrations'),
                __DIR__.'/database/seeders'    => $this->app->databasePath('seeders'),
                __DIR__.'/database/models'     => $this->app->path('Models'),
            ], 'indobank');

            $this->commands([
                IndoBankPublishCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(IndoBank::class, function () {
            return new IndoBank();
        });

        $this->app->alias(IndoBank::class, 'indobank');
    }
}
