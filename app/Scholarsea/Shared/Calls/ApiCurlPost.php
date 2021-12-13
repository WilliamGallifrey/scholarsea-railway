<?php

namespace App\ETL\Shared\Calls;

class ApiCurlPost
{
    public function run(string $url,string $method, array $headers, array $body = null) : object{

        $curl = curl_init();

        //dd(str_replace('\\\n','',json_encode($body)));

        $curlOpts = [

            CURLOPT_URL => $url,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POSTFIELDS => str_replace('\\\n','',json_encode($body)),
            CURLOPT_POST => 1
        ];

        curl_setopt_array($curl, $curlOpts);
        $response = curl_exec($curl);
        curl_close($curl);

        return (object)$response;
    }
}
