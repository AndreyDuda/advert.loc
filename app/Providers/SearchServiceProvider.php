<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;

class searchServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(Client::class, function (Application $app) {
            $config = $app->make('config')->get('elasticsearch');
            return ClientBuilder::create()
                ->setHosts($config['hosts'])
                ->setRetries($config['retries'])
                ->build();
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
