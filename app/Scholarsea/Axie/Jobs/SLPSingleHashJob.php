<?php

namespace App\ETL\Axie\Jobs;

use App\ETL\Axie\Services\ExtractSLPData;
use App\ETL\Axie\Services\HashDataTransformer;
use App\Scholarsea\Hashes\Entities\Hash;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class SLPSingleHashJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $timeout = 300;
    private string $hash;

    public function __construct(string $hash)
    {
        $this->hash = $hash;
    }

    const QUEUE = 'axie';

    public function handle(ExtractSLPData $extractSLPData, HashDataTransformer $hashDataTransformer){
        $slpData = $hashDataTransformer->run($extractSLPData->run($this->hash));
        Hash::query()->insert($slpData);
    }
}
