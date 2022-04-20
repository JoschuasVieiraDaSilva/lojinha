<?php

function isNotEmpty($str) {
    if ($str != NULL && $str != '') {
        return TRUE;
    } else {
        return FALSE;
    }
}

function isEmpty($str) {
    if ($str == NULL || $str == '') {
        return TRUE;
    } else {
        return FALSE;
    }
}

function notNull($val, $message) {
    if (isEmpty($val)) {
        die($message);
    }
}

function validateStr($str, $length, $message) {
    if (strlen($str) > $length && $length != 0 || !is_string($str)) {
        die($message);
    }
}

function validateInt($int, $length, $message) {
    if (strlen($int) > $length && $length != 0 || preg_match('/[^0-9]/', $int)) {
        die($message);
    }
}

function validateDate($date, $message) {
    $numericDate = preg_replace('/[^0-9]/', '', $date);
    if (strlen($numericDate) != 8 && isNotEmpty($numericDate) || strlen($date) != 10 && strlen($date) != 8 && isNotEmpty($date) || isEmpty($numericDate) && isNotEmpty($date) || preg_match('/[^0-9\/-]/', $date)) {
        die($message);
    }
}

function validateCpf($cpf, $message) {
    if (preg_match('/^\d\d\d\.\d\d\d\.\d\d\d\-\d\d$/', $cpf) != 1 && isNotEmpty($cpf)) {
        die($message);
    }
}

function validateDecimal($decimal, $decimalLength, $floatLength, $message) {
    $int = substr($decimal, 0, strpos($decimal, '.'));
    $float = substr($decimal, strpos($decimal, '.') + 1, strlen($decimal));
    if (strlen($int) + strlen($float) > $decimalLength || strlen($float) > $floatLength || preg_match('/[^0-9.]/', $decimal) || preg_match_all('/\./', $decimal) > 1) {
        die($message);
    }
}

function validatePersonType($type, $message) {
    if ($type != 'F' && $type != 'J' && isNotEmpty($type)) {
        die($message);
    }
}

function validateAtivo($ativo, $message) {
    if ($ativo != 'N' && $ativo != 'S' && isNotEmpty($ativo)) {
        die($message);
    }
}

function validateUf($uf, $message) {
    $possibleUfs = ['AC', 'AL', 'AM', 'AP', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MG', 'MS', 'MT', 'PA', 'PB', 'PE', 'PI', 'PR', 'RJ', 'RN', 'RO', 'RR', 'RS', 'SC', 'SE', 'SP', 'TO'];
    $isValidUf = FALSE;
    for ($i = 0; $i < count($possibleUfs); $i++) {
        if ($possibleUfs[$i] == $uf) {
            $isValidUf = TRUE;
            break;
        }
    }
    if (!$isValidUf && isNotEmpty($uf)) {
        die($message);
    }
}

function validateCep($cep, $message) {
    if (preg_match('/^\d\d\d\d\d\-\d\d\d$/', $cep) != 1 && isNotEmpty($cep)) {
        die($message);
    }
}

function validatePhone($phone, $message) {
    if (preg_match('/^\(\d\d\)\s\d?\d\d\d\d\-\d\d\d\d$/', $phone) != 1 && isNotEmpty($phone)) {
        die($message);
    }
}

function validateEmail($email, $message) {
    if (preg_match('/^[a-zA-Z0-9_\.]+@([a-zA-Z0-9]+\.)+[a-zA-Z0-9]+$/', $email) != 1 && $email != NULL && $email != '') {
        die($message);
    }
}

function validateFrete($frete, $message) {
    $possibleFretes = [0, 1, 2, 3, 4];
    $isValidFrete = FALSE;
    for ($i = 0; $i < count($possibleFretes); $i++) {
        if ($possibleFretes[$i] == $frete) {
            $isValidFrete = TRUE;
            break;
        }
    }
    if (!$isValidFrete && isNotEmpty($frete)) {
        die($message);
    }
}

?>