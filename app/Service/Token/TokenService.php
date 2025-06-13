<?php

namespace App\Service\Token;

class TokenService
{
    public function generateSixDigitToken(): string
    {
        return (string) rand(100000, 999999);
    }

}
