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
        $endpoint = config('cellulant-laravel.baseurl') . "" . EndpointsEnum::GET_TOKEN;

        $data_req = ["grant_type" => "client_credentials", "client_id" => config('cellulant-laravel.key'), "client_secret" => config('cellulant-laravel.secret')];

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

    public function createOrder(
        $transactionid,
        $amount,
        $accountnumber,
        $due_date,
        $customer_first_name,
        $customer_last_name,
        $msisdn,
        $customer_mail,
        $description
    ) {
        $token = $this->createToken();

        $endpoint = config('cellulant-laravel.baseurl') . "" . EndpointsEnum::CREATE_ORDER;
        $data_req = [
            "merchantTransactionID" => $transactionid,
            "requestAmount" => $amount,
            "currencyCode" => config('cellulant-laravel.currencycode'),
            "accountNumber" => $accountnumber,
            "serviceCode" => config('cellulant-laravel.service_code'),
            "dueDate" => $due_date,
            "requestDescription" => $description,
            "countryCode" => config('cellulant-laravel.countrycode'),
            "customerFirstName" => $customer_first_name,
            "customerLastName" => $customer_last_name,
            "MSISDN" => $msisdn,
            "customerEmail" => $customer_mail,
            "paymentWebhookUrl" => config('cellulant-laravel.paymentWebhookUrl'),
            "successRedirectUrl" => config('cellulant-laravel.successRedirectUrl'),
            "failRedirectUrl" => config('cellulant-laravel.failedRedirectUrl')

        ];

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
                'Authorization: Bearer ' . $this->token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
}
