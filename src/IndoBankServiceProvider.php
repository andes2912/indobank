<?php

/*
 * This file is part of the IndoBank package.
 *
 * (c) Andri Desmana <andridesmana.pw | andridesmana29@gmail.com>
 *
 */

namespace Andes2912\IndoBank;

use Illuminate\Support\ServiceProvider;
use Andes2912\IndoBank\IndoBankPublishCommand;

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
        if ($this->app->runningInConsole()) {
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

    }
}