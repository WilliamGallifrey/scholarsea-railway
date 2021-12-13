<?php

namespace App\ETL\Axie\Services;

use App\ETL\Axie\Queries\AxieQuery;
use App\Scholarsea\Hashes\Entities\Hash;

class ExtractAxieData
{
    const GAME = 'Axie Infinity';
    private AxieQuery $axieQuery;

    public function __construct(AxieQuery $axieQuery){
        $this->axieQuery = $axieQuery;
    }

    public function run(string $hash = null)
    {
        $hashes = [$hash];
        $rawAxiedata = [];

        if(is_null($hash))
            $hashes = Hash::query()
                ->join('games','hashes.game_id','=','games.id')
                ->where('games.name',self::GAME)
                ->pluck('hash')
                ->toArray();

        foreach ($hashes as $hash)
        {
            $rawAxiedata[$hash] = json_decode($this->axieQuery->run($hash)->scalar,true);
        }

        return $rawAxiedata;
    }
}
