<?php

namespace LuviUI\LaravelLuvi\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use LuviUI\LaravelLuvi\LaravelLuviServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'LuviUI\\LaravelLuvi\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelLuviServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_laravel-luvi_table.php.stub';
        $migration->up();
        */
    }
}
