<?php

namespace App\ETL\Axie\Services;

use App\Scholarsea\Hashes\Entities\Hash;
use Carbon\Carbon;

class HashDataTransformer
{
    public function run($data,$gameId) : array
    {
        $response = [];

        foreach ($data as $hash => $datum)
        {
            $slpInfo = $datum['slp'];
            $leaderBoardInfo = $datum['leaderboard'];
            $adventureInfo = $datum['adventure'];
            $lastClaimed = Carbon::createFromTimestamp($slpInfo['lastClaimedItemAt'])->format('Y-m-d');

            $userId = Hash::query()->where('hash',$hash)->first()->user_id;

            $response[] = [
                'total'=>$slpInfo['total'],
                'hash' => $hash,
                'game_id' => $gameId,
                'user_id' => $userId,
                'last_claimed'=>$lastClaimed,
                'claimable'=>$slpInfo['claimableTotal'],
                'today_so_far'=>$slpInfo['todaySoFar'],
                'yesterday'=>$slpInfo['yesterdaySLP'],
                'average'=>$slpInfo['average'],
                'elo'=>$leaderBoardInfo['elo'],
                'rank'=>$leaderBoardInfo['rank'],
                'alias'=>$leaderBoardInfo['name'],
                'gained_slp'=>$adventureInfo['gained_slp'],
                'max_slp'=>$adventureInfo['max_slp'],
            ];
        }
        return $response;
    }
}
