<?php
// app/Traits/TicketGeneratorTrait.php

namespace App\Traits;

use Exception;
trait TicketGeneratorTrait
{
    public function generateTicketToken($userName)
    {
        try {
            //code...
            $nameWithoutSpaces = str_replace(' ', '', strtolower($userName));

            // Generate a random number between 1000 and 9999
            $randomNumber = mt_rand(100000, 999999);

            // Concatenate the name and random number
            $ticket_token = $nameWithoutSpaces . $randomNumber;

            return $ticket_token;
        } catch (\Exception $e) {
            //throw $th;
            return response()->json(
                [
                    'message' => 'something went wrong in ticket generator trait',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
        // Remove spaces and convert the name to lowercase
    }
}
