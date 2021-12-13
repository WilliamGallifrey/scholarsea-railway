<?php

namespace App\ETL\Axie\Services;

use App\Scholarsea\Hashes\Entities\Hash;
use Carbon\Carbon;

class AxieDataTransformer
{
    public function run($data) : array
    {

        $response = ['axies'=>[],'parts'=>[]];

        foreach ($data as $hash => $axie)
        {
            $axies = $axie['data']['axies']['results'];
            $hashObject = Hash::where('hash',$hash)->first();

            foreach ($axies as $axie)
            {
                $response['axies'][$axie['id']] = [
                    'hash_id' =>  $hashObject->id,
                    'nft_id' => $axie['id'],
                    'name' => $axie['name'],
                    'stage' => $axie['stage'],
                    'class' => $axie['class'],
                    'breed_count' => $axie['breedCount'],
                    'image' => $axie['image'],
                    'banned' => $axie['battleInfo']['banned'],
                    'matching_parts' => 0
                ];

                foreach ($axie['parts'] as $part)
                {
                    $matchingParts = $part['class'] == $axie['class'];

                    if($matchingParts)
                        $response['axies'][$axie['id']]['matching_parts']++;

                    $response['parts'][] = [
                        'axie_id' => null,
                        'axie_game_id' => $axie['id'],
                        'part_axie_id' => $part['id'],
                        'name' => $part['name'],
                        'class' => $part['class'],
                        'type' => $part['type'],
                        'match' => $matchingParts
                    ];
                }
            }
        }

        return $response;
    }
}
