<?php

namespace App\ETL\Axie\Services;

use App\ETL\Axie\Queries\AxieDetailQuery;
use App\Scholarsea\Axies\Entities\Axie;

class ExtractAxieDetails
{
    const GAME = 'Axie Infinity';
    private AxieDetailQuery $axieQuery;

    public function __construct(AxieDetailQuery $axieQuery){
        $this->axieQuery = $axieQuery;
    }

    public function run(string $axie = null)
    {
        $axies = [$axie];
        $rawAxiedata = [];

        if(is_null($axie))
            $axies = array_values(Axie::all()->pluck('nft_id')->toArray());

        foreach ($axies as $axie)
        {
            $rawAxiedata[$axie] = json_decode($this->axieQuery->run($axie)->scalar,true);
        }

        return $rawAxiedata;
    }
}
