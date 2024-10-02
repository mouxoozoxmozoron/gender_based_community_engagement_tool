<?php

namespace App\Traits;

use App\Traits\PhoneNumberFormatterTrait;
use Exception;


trait SmsTrait
{
    use PhoneNumberFormatterTrait;

    public function sendSms($message = '', $phoneNumber = '')
    {
        //format Phone Number to 255652543553
        $reciever_phone = (string) $this->formatPhoneNumber($phoneNumber);

        $apiKey = "melian";
        $apiSecret = "1nImbHM5ECN0OqMpdH4o";
        $senderId = "MELIAN";
        $message = $message;
        $contacts = "$reciever_phone";
        $url = "https://messaging.kilakona.co.tz/api/v1/vendor/message/send";

        $headers = array(
            "api_key: $apiKey",
            "api_secret: $apiSecret",
            "Content-Type: application/json"
        );

        $data = array(
            "senderId" => $senderId,
            "messageType" => "text",
            "message" => $message,
            "contacts" => $contacts
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}
