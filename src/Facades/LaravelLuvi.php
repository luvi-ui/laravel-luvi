<?php

namespace LuviUI\LaravelLuvi\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \LuviUI\LaravelLuvi\LaravelLuvi
 */
class LaravelLuvi extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \LuviUI\LaravelLuvi\LaravelLuvi::class;
    }
}
