<?php

namespace App\Service;

class PromoCodeGenerator
{
    /**
     * @param bool $alphanumeric
     * @param int $length
     * @param int $amount
     * @return array
     */
    public function generateRandomCodes(bool $alphanumeric = true, int $length = 10, int $amount = 1): array
    {
        $codes = [];
        for ($i1 = 0; $i1 < $amount; $i1++) {
            $characters = $alphanumeric ? '0123456789ABCDEFGHILKMNOPQRSTUVWXYZ' : '0123456789';
            $charactersMaxIndex = strlen($characters) - 1;
            $randomString = '';
            for ($i2 = 0; $i2 < $length; $i2++) {
                $randomString .= $characters[mt_rand(0, $charactersMaxIndex)];
            }
            $codes[] = $randomString;
        }
        return $codes;
    }
}