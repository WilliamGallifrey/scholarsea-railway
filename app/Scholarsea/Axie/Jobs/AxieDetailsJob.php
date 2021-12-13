<?php

namespace App\ETL\Axie\Jobs;

use App\ETL\Axie\Services\AxieDetailsTransformer;
use App\ETL\Axie\Services\ExtractAxieDetails;
use App\Scholarsea\AxieCards\Entities\AxieCard;
use App\Scholarsea\Axies\Entities\Axie;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AxieDetailsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(ExtractAxieDetails $extractAxieDetails, AxieDetailsTransformer $axieDetailsTransformer)
    {
        $transformedAxieData = $axieDetailsTransformer->run($extractAxieDetails->run());

        foreach ($transformedAxieData['stats'] as $key => $stat) {
            Axie::query()->where('nft_id',$key)->update($stat);
        }

        AxieCard::query()->delete();

        AxieCard::query()->upsert($transformedAxieData['cards'],['axie_id','game_id']);
    }
}
