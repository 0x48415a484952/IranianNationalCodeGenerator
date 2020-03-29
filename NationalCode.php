<?php

declare(strict_types=1);

class NationalCode
{
    private array $invalidCodes = [
        '1111111111',
        '2222222222',
        '3333333333',
        '4444444444',
        '5555555555',
        '6666666666',
        '7777777777',
        '8888888888',
        '9999999999',
        '0000000000'
    ];

    private function invalidCode(string $userCode): bool
    {
        foreach ($this->invalidCodes as $iValue) {
            if ($iValue === $userCode ) {
                return true;
            }
        }
        return false;
    }

    private function explodeAndReverse(string $number): array
    {
        $array = str_split($number);
        foreach ($array as $key => $value) {
            $array[$key] = (int)$value;
        }
        return array_reverse($array);
    }

    private function checkNumberOfArrayElements(array $array): bool
    {
        return count($array) === 10;
    }

    private function calculateSumOfArrayWithKeyValue(array $array): int
    {
        $sum = 0;
        foreach ($array as $key => $value) {
            if ($key > 0) {
                $sum += ++$key * $value;
            }
        }
        return $sum;
    }

    public function checkNationalCodeValidation(string $number): bool
    {
        $reversedArray = $this->explodeAndReverse($number);
        if ($this->invalidCode($number)) {
            return false;
        }

        if ($this->checkNumberOfArrayElements($reversedArray)) {
            $sum = $this->calculateSumOfArrayWithKeyValue($reversedArray);
            $controlNum = $reversedArray[0];
            $recurrent = $sum % 11;
            if (($recurrent > 1) && ($controlNum === (11 - $recurrent))) {
                return true;
            }

            if ($recurrent === 0 && $controlNum === 0) {
                return true;
            }

            if ($recurrent === 1 && $controlNum === 1) {
                return true;
            }

            return false;
        }

        return false;
    }


    private function randomNumber(int $length = 9): string
    {
        $result = '';
        for($i = 0; $i < $length; $i++) {
            try {
                $result .= random_int(0, 9);
            } catch (Exception $e) {
            }
        }
        return $result;
    }

    private function GenerateRandomCode(string $randomCode): ?string
    {
        $reversedArray = $this->explodeAndReverse($randomCode);
        $sum = $this->calculateSumOfArrayWithKeyValue($reversedArray);
        $recurrent = $sum % 11;
        if ($recurrent > 1) {
            $controlNum = 11 - $recurrent;
            $randomCode .= $controlNum;
            return $randomCode;
        }

        if ($recurrent === 0) {
            $controlNum = 0;
            $randomCode .= $controlNum;
            return $randomCode;
        }

        if ($recurrent === 1) {
            $controlNum = 1;
            $randomCode .= $controlNum;
            return $randomCode;
        }

        return null;
    }

    public function generateNationalCode(): string
    {
        do {
            $randomCode = $this->randomNumber();
            $code = $this->GenerateRandomCode($randomCode);
        } while (!$this->checkNationalCodeValidation($code));
        return $code;
    }

}