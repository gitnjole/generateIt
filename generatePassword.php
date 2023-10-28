<?php

function generateit ($passwordLength, $includeNumbers, $includeSymbols) {
    //arrays that will create actual password
    //range for clearer visibility
    $chars = range("a","z");
    $upper_chars = range("A","Z");
    $nums = range("0","9");
    $symbols = ['!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '_', '+', '-', '=', '[', ']', '{', '}', '|', ';', ':', ',', '.', '<', '>', '?', '/'];

    $password = '';

    $charset = array_merge($chars, $upper_chars);
    if ($includeNumbers == true) $charset = array_merge($charset, $nums);
    if ($includeSymbols == true) $charset = array_merge($charset, $symbols);

    //cook the password
    for ($i = 0; $i < $passwordLength; $i++) {
        $index = array_rand($charset);
        $password .= $charset[$index];
    
    }

    return $password;
}