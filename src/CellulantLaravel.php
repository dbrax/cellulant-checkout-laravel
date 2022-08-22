<?php

namespace Epmnzava\CellulantLaravel;

use App\Cellulant\Encryption;
use Epmnzava\CellulantLaravel\Enums\EndpointsEnum;

class CellulantLaravel
{

    public $baseurl, $express_ivkey, $express_SecretKey, $currencycode, $service_code, $countrycode, $paymentWebhookUrl, $successRedirectUrl, $failedRedirectUrl;
    public function __construct($baseurl, $express_ivkey, $express_SecretKey, $currencycode, $service_code, $countrycode, $paymentWebhookUrl, $successRedirectUrl, $failedRedirectUrl)
    {
        $this->baseurl = $baseurl;
        $this->express_ivkey = $express_ivkey;
        $this->express_SecretKey = $express_SecretKey;
        $this->currencycode = $currencycode;
        $this->service_code = $service_code;
        $this->countrycode = $countrycode;
        $this->paymentWebhookUrl = $paymentWebhookUrl;
        $this->successRedirectUrl = $successRedirectUrl;
        $this->failedRedirectUrl = $failedRedirectUrl;
    }


    public function proccessEncryption($payload)
    {

        $CheckoutEncryption = new Encryption;
        return $CheckoutEncryption->encrypt($this->express_ivkey, $this->express_SecretKey, $payload);
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
        //$token = $this->createToken();

        $endpoint =  $this->baseurl . "" . EndpointsEnum::CREATE_ORDER;
        $data_req = [
            "merchantTransactionID" => $transactionid,
            "requestAmount" => $amount,
            "currencyCode" => $this->currencycode,
            "accountNumber" => $accountnumber,
            "serviceCode" => $this->service_code,
            "dueDate" => $due_date,
            "requestDescription" => $description,
            "countryCode" => $this->countrycode,
            "customerFirstName" => $customer_first_name,
            "customerLastName" => $customer_last_name,
            "MSISDN" => $msisdn,
            "customerEmail" => $customer_mail,
            "paymentWebhookUrl" => $this->paymentWebhookUrl,
            "successRedirectUrl" => $this->successRedirectUrl,
            "failRedirectUrl" => $this->failedRedirectUrl

        ];

        $encrypted_payload = $this->proccessEncryption($data_req);

        $url = $this->baseurl . "/v2/express/?accessKey=" . $this->express_ivkey . "&params=" . $encrypted_payload . "&countryCode=" . $this->countrycode;

        return $url;
    }
}
