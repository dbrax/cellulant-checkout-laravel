<?php

namespace Epmnzava\CellulantLaravel;

class Encryption
{

    public function __construct()
    {
    }
    /**
     * Encrypt the string containing customer details with the IV and secret 
     * key provided in the developer portal
     *
     * @return $encryptedPayload
     */
    public function encrypt($ivKey, $secretKey, $payload = [])
    {
        //The encryption method to be used
        $encrypt_method = "AES-256-CBC";

        // Hash the secret key
        $key = hash('sha256', $secretKey);

        // Hash the iv - encrypt method AES-256-CBC expects 16 bytes
        $iv = substr(hash('sha256', $ivKey), 0, 16);
        $encrypted = openssl_encrypt(
            json_encode($payload, true),
            $encrypt_method,
            $key,
            0,
            $iv
        );

        //Base 64 Encode the encrypted payload
        $encryptedPayload = base64_encode($encrypted);

        return $encryptedPayload;
    }
}
