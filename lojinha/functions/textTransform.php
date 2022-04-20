<?php

function anyToFloat($decimal) {
    $decimal = str_replace(',', '.', preg_replace('/[^0-9.,]/', '', $decimal));
    $totalDots = preg_match_all('/\./', $decimal);
    $lastDot = strrpos($decimal, '.') - $totalDots + 1;
    $decimal = str_replace('.', '', $decimal);
    $decimal = substr($decimal, 0, $lastDot) . '.' . substr($decimal, $lastDot, strlen($decimal));
    $beginsWithDot = preg_match('/^\./', $decimal);
    $endsWithDot = preg_match('/\.$/', $decimal);
    if ($beginsWithDot && $endsWithDot) {
        return NULL;
    }
    if ($endsWithDot) {
        $decimal = $decimal . '0';
    }
    if ($beginsWithDot) {
        $decimal = '0' . $decimal;
    }
    return $decimal;
}

function anyToCpf($cpf) {
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    if (isEmpty($cpf)) {
        return NULL;
    }
    return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
}

function anyToCep($cep) {
    $cep = preg_replace('/[^0-9]/', '', $cep);
    if (isEmpty($cep)) {
        return NULL;
    }
    return substr($cep, 0, 5) . '-' . substr($cep, 5, 3);
}

function anyToPhone($phone) {
    $phone = preg_replace('/[^0-9]/', '', $phone);
    $nineDigit = strlen($phone) > 10 ? TRUE : FALSE;
    if (isEmpty($phone)) {
        return NULL;
    }
    return '(' . substr($phone, 0, 2) . ') ' . substr($phone, 2, ($nineDigit ? 5 : 4)) . '-' . substr($phone, ($nineDigit ? 7 : 6), 4);
}

?>