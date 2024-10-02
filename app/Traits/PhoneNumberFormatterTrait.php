<?php

namespace App\Traits;

trait PhoneNumberFormatterTrait
{
    public function formatPhoneNumber($phoneNumber)
    {
        // Remove all non-numeric characters
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

        // If the phone number starts with '255' and is 12 digits long, it's already correctly formatted
        if (substr($phoneNumber, 0, 3) === "255" && strlen($phoneNumber) == 12) {
            return $phoneNumber;
        }

        // If the phone number starts with '2550' and is 13 digits long, format it correctly
        if (strlen($phoneNumber) == 13 && substr($phoneNumber, 0, 4) === "2550") {
            $countryCode = substr($phoneNumber, 0, 3);
            $nextNine = substr($phoneNumber, 4, 9);
            $phoneNumber = $countryCode . $nextNine;
            return $phoneNumber;
        }

        // If the phone number is 10 digits long, assume it starts with '0' and needs '255' prefixed
        if (strlen($phoneNumber) == 10 && substr($phoneNumber, 0, 1) === '0') {
            $countryCode = "255";
            $nextNine = substr($phoneNumber, 1, 9);
            $phoneNumber = $countryCode . $nextNine;
            return $phoneNumber;
        }

        // If the phone number is 9 digits long, assume it's a local number and needs '255' prefixed
        if (strlen($phoneNumber) == 9) {
            $countryCode = "255";
            $phoneNumber = $countryCode . $phoneNumber;
            return $phoneNumber;
        }

        // If the phone number is 13 digits long and starts with '+255', strip the '+' and format it correctly
        if (strlen($phoneNumber) == 13 && substr($phoneNumber, 0, 4) === "255") {
            $countryCode = substr($phoneNumber, 0, 3);
            $nextNine = substr($phoneNumber, 3, 9);
            $phoneNumber = $countryCode . $nextNine;
            return $phoneNumber;
        }

        // If none of the conditions match, return the original phone number
        return $phoneNumber;
    }
}
