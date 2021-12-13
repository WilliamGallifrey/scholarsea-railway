<?php

namespace App\ETL\Axie\Services;

use App\ETL\Axie\Queries\SLPQuery;
use App\Scholarsea\Hashes\Entities\Hash;

class ExtractSLPData
{
    const GAME = 'Axie Infinity';
    private SLPQuery $slpQuery;

    public function __construct(SLPQuery $slpQuery){
        $this->slpQuery = $slpQuery;
    }

    public function run(string $hash = null)
    {
        $hashes = [$hash];

        if(is_null($hash))
            $hashes = Hash::query()
                ->join('games','hashes.game_id','=','games.id')
                ->where('games.name',self::GAME)
                ->pluck('hash')
                ->toArray();

        foreach ($hashes as $hash)
        {
            $rawSLPdata[$hash] = json_decode($this->slpQuery->run($hash)->scalar,true);
        }

        return $rawSLPdata;

    }
}
