<?php

return [


    "key" => env('CELLULANT_CLIENT_KEY'),

    "secret" => env('CELLULANT_CLIENT_SECRET'),


    "service_code" => env('CELLULANT_SERVICE_CODE'),

    "client_code" => env('CELLULANT_CLIENT_CODE'),

    "baseurl" => " https://developer.tingg.africa",

    "countrycode" => env('CELLULANT_COUNTRYCODE'),


    "currencycode" => env('CELLULANT_CURRENCYCODE'),

    "paymentWebhookUrl" => env('CELLULANT_WEBHOOK'),


    "successRedirectUrl" => env('CELLULANT_SUCCESS_URL'),

    "failedRedirectUrl" => env('CELLULANT_FAILED_REDIRECT_URL')



];
