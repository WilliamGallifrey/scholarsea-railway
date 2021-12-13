<?php

namespace App\ETL\Shared\Calls;

class ApiCurl
{
    public function run(string $url,string $method, array $headers) : object{

        $curl = curl_init();

        $curlOpts = [

            CURLOPT_URL => $url,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => $headers
        ];

        curl_setopt_array($curl, $curlOpts);
        $response = curl_exec($curl);
        curl_close($curl);

        return (object)$response;
    }
}
