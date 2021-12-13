<?php

namespace App\ETL\Axie\Services;

use App\Scholarsea\Axies\Entities\Axie;

class AxieDetailsTransformer
{

    public function run($data)
    {
        $cards = [];
        $stats = [];
        $axieIds = Axie::all()->pluck('id','nft_id');

        foreach ($data as $axieId => $axieData){

            $axieData = $axieData['data']['axie'];

            $stats[$axieId] = [
                'hp' => $axieData['stats']['hp'],
                'skill' => $axieData['stats']['skill'],
                'speed' => $axieData['stats']['speed'],
                'morale' => $axieData['stats']['morale'],
            ];

            foreach ($axieData['parts'] as $part)
            {
                if(count($part['abilities'])){

                    foreach ($part['abilities'] as $card){

                        $cards[] = [
                            'axie_id' => $axieIds[$axieId],
                            'game_id' => $card['id'],
                            'name' => $card['name'],
                            'attack' => $card['attack'],
                            'defense' => $card['defense'],
                            'energy' => $card['energy'],
                            'description' => $card['description'],
                            'background_url' => $card['backgroundUrl'],
                            'effect_icon_url' => $card['effectIconUrl']
                        ];
                    }
                }
            }
        }

        return ['cards'=>$cards,'stats'=>$stats];
    }

}
