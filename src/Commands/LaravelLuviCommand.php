<?php

namespace LuviUI\LaravelLuvi\Commands;

use Illuminate\Console\Command;

class LaravelLuviCommand extends Command
{
    public $signature = 'laravel-luvi';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
