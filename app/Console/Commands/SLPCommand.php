<?php

namespace App\Console\Commands;

use App\ETL\Axie\Jobs\SLPJob;
use Illuminate\Console\Command;

class SLPCommand extends Command
{
    protected $signature = 'axie:slp';
    const QUEUE = 'axie';

    public function handle()
    {
        SLPJob::dispatch()->onQueue(self::QUEUE);
    }
}
