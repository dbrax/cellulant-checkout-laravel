<?php

namespace Epmnzava\CellulantLaravel;

use Epmnzava\CellulantLaravel\Enums\EndpointsEnum;

class CellulantLaravel
{

    public $token;
    public function __construct()
    {
    }


    public function createToken()
    {
        $endpoint = config('baseurl') . "" . EndpointsEnum::GET_TOKEN;

        $data_req = ["grant_type" => "client_credentials", "client_id" => config('key'), "client_secret" => config('secret')];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data_req,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);


        $this->token = json_decode($response)->access_token;


        return $this->token;
    }

    public function createOrder()
    {
        $token = $this->createToken();
    }
}
