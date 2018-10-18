<?php

class NationalCode
{
    public $nationalCode;
    public $temp;
    
    private $invalidCodes = array(
        1111111111,
        2222222222,
        3333333333,
        4444444444,
        5555555555,
        6666666666,
        7777777777,
        8888888888,
        9999999999,
        0000000000
    );
    
    private function invalidCode($userCode) {
        for ($i = 0; $i < count($this->invalidCodes); $i++) {
            if ($this->invalidCodes[$i] == $userCode ) {
                return true;
            }
        }
    }
    
    private function explodeAndReverse($number) {
        $array = str_split($number);
        $reversedArray = array_reverse($array);
        return $reversedArray;
    }
    
    private function checkNumberOfArrayElements($array) {
        if (count($array) == 10) {
            return true;
        } else {
            return false;
        }
    }

        private function calculateSumOfArrayWithKeyValue($array) {
        foreach ($array as $key => $value) {
            if ($key > 0) {
                $sum += ++$key * $value;
            }
        }
        return $sum;
    }
    
    public function checkNationalCodeValidation($number) {
        $reversedArray = $this->explodeAndReverse($number);
        if ($this->invalidCode($number)) {
            return false;
        } elseif ($this->checkNumberOfArrayElements($reversedArray)) {
            $sum = $this->calculateSumOfArrayWithKeyValue($reversedArray);
            $controlNum = $reversedArray[0];
            $recurrent = $sum % 11;
            if ( ($recurrent > 1) && ($controlNum == (11 - $recurrent)) ) {
                return true;
            } elseif ($recurrent == 0 && $controlNum == 0) {
                return true;
            } elseif ($recurrent == 1 && $controlNum == 1) {
                return true;
            } else {
                return false;
            } 
        } else {
            return false;
        }
    }
    
    
    private function randomNumber($length=9) {
        $result = '';
        for($i = 0; $i < $length; $i++) {
            $result .= mt_rand(0, 9);
        }
        return $result;
    }
    
    private function GenerateRandomCode($randomCode) {
        $reversedArray = $this->explodeAndReverse($randomCode);
        $sum = $this->calculateSumOfArrayWithKeyValue($reversedArray);
        $recurrent = $sum % 11;
        if ($recurrent > 1) {
            $controlNum = 11 - $recurrent;
            $randomCode = $randomCode . $controlNum;
            return $randomCode;
        } elseif ($recurrent == 0) {
            $controlNum = 0;
            $randomCode = $randomCode . $controlNum;
            return $randomCode;
        } elseif ($recurrent == 1) {
            $controlNum = 1;
            $randomCode = $randomCode . $controlNum;
            return $randomCode;
        }
    }
    
    public function generateNationalcode() {
        do {
            $randomCode = $this->randomNumber();
            $code = $this->GenerateRandomCode($randomCode);
        } while (!$this->checkNationalCodeValidation($code));
        return $code;
    }
    
}