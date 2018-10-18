<?php
require("NationalCode.php");

//$submit = filter_input(INPUT_POST, 'submit');
//if (isset($submit)) {
// Using PHP Class
    $code = filter_input(INPUT_POST, 'userCode', FILTER_SANITIZE_NUMBER_INT);
    $nationalCode = new NationalCode();
    if ($code == '' || $code == null) {
        echo '<h1>enter a number!</h1>';
        echo '<h1>'.$nationalCode->generateNationalcode().'</h1>';
    } else {
        if ($nationalCode->checkNationalCodeValidation($code)) {
        echo '<h1>valid</h1>';
        } else {
            echo '<h1>invalid</h1>';
        }
    }