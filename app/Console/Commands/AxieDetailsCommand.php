<?php

namespace App\Console\Commands;

use App\ETL\Axie\Jobs\AxieDetailsJob;
use Illuminate\Console\Command;

class AxieDetailsCommand extends Command
{
    protected $signature = 'axie:details';
    const QUEUE = 'axie';

    public function handle()
    {
        AxieDetailsJob::dispatch()->onQueue(self::QUEUE);
    }
}
