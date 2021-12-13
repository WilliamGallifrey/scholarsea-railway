<?php

return [
    'rapidapi' =>[
        'apikey' => env('RAPIDAPI_KEY'),
        'base' => 'https://axie-infinity.p.rapidapi.com',
        'info' => '/get-update/',
        'axies' => '/get-axies/'
    ],
    'graphql' => [
        'base' => 'https://graphql-gateway.axieinfinity.com/graphql'
    ]
];
