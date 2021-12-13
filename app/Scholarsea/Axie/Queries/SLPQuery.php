<?php

namespace App\ETL\Axie\Queries;

use App\ETL\Shared\Calls\ApiCurl;

class SLPQuery
{

    private ApiCurl $apiCurl;

    public function __construct(ApiCurl $apiCurl){
        $this->apiCurl = $apiCurl;
    }

    public function run($hash){

        $headers = array(
            "X-RapidAPI-Host: axie-infinity.p.rapidapi.com",
            "X-RapidAPI-Key: ".config('scholarsea.rapidapi.apikey'),
        );

        $url = config('scholarsea.rapidapi.base') . config('scholarsea.rapidapi.info') . $hash;

        return $this->apiCurl->run($url,'GET',$headers);
    }

}
