<?php

namespace App\Console\Commands;

use App\ETL\Axie\Jobs\AxieJob;
use Illuminate\Console\Command;

class AxieCommand extends Command
{
    protected $signature = 'axie:axies';
    const QUEUE = 'axie';

    public function handle()
    {
        AxieJob::dispatch()->onQueue(self::QUEUE);
    }
}
