<?php

declare(strict_types=1);

use IranianNationalCode\NationalCode;

require_once "vendor/autoload.php";

$code = filter_input(INPUT_POST, 'userCode', FILTER_SANITIZE_NUMBER_INT);
$nationalCode = new NationalCode();
if ($code === '' || $code === null) {
    echo '<h1>enter a number!</h1>';
    echo '<h1>'.$nationalCode->generateNationalCode().'</h1>';
} elseif ($nationalCode->checkNationalCodeValidation($code)) {
echo '<h1>valid</h1>';
} else {
    echo '<h1>invalid</h1>';
}
