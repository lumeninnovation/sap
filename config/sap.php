<?php

// config for Lumen/SAP
return [
    'connections' => [
        'prod' => [
            'ashost' => env('SAP_PROD_ASHOST'),
            'sysnr' => env('SAP_PROD_SYSNR'),
            'lang' => env('SAP_PROD_LANG'),
            'client' => env('SAP_PROD_CLIENT')
        ]
    ],

    'default' => 'prod'
];
