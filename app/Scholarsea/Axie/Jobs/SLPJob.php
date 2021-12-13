<?php

namespace App\ETL\Axie\Jobs;

use App\ETL\Axie\Services\ExtractSLPData;
use App\ETL\Axie\Services\HashDataTransformer;
use App\Scholarsea\Games\Entities\Game;
use App\Scholarsea\Hashes\Entities\Hash;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class SLPJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    const GAME = 'Axie Infinity';

    public int $timeout = 300;

    const QUEUE = 'axie';

    public function handle(ExtractSLPData $extractSLPData, HashDataTransformer $hashDataTransformer){

        $gameId = Game::query()->where('name',self::GAME)->first()->id;

        $transformedSlpData = $hashDataTransformer->run($extractSLPData->run(),$gameId);

        Hash::query()->upsert($transformedSlpData,['hash']);
    }
}
