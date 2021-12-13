<?php

namespace App\ETL\Axie\Jobs;

use App\ETL\Axie\Services\AxieDataTransformer;
use App\ETL\Axie\Services\ExtractAxieData;
use App\Scholarsea\AxieParts\Entities\AxiePart;
use App\Scholarsea\Axies\Entities\Axie;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class AxieJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $timeout = 300;

    const QUEUE = 'axie';

    public function handle(ExtractAxieData $extractAxieData, AxieDataTransformer $axieDataTransformer){

        $transformedAxieData = $axieDataTransformer->run($extractAxieData->run());

        $axieIds = collect($transformedAxieData['axies'])->pluck('nft_id')->toArray();

        Axie::query()->upsert($transformedAxieData['axies'],['nft_id']);

        AxiePart::query()->upsert($transformedAxieData['parts'],['axie_id','type']);

        DB::statement('update axie_parts ap inner join axies a on a.nft_id = ap.axie_game_id set ap.axie_id = a.id where ap.axie_game_id in ('.implode(',',$axieIds).')');
    }

}
