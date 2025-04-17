<?php

function validateTextLength($text, $min, $max) {
    $length = strlen(trim($text));
    return ($length >= $min && $length <= $max);
}

function validateNumberRange($number, $min, $max) {
    // Check if it's a valid number
    if (!is_numeric($number)) {
        return false;
    }
    
    // Convert to number for range check
    $number = (int)$number;
    
    // Check if within range
    return ($number >= $min && $number <= $max);
}

function validateOption($selected, $validOptions) {
    return in_array($selected, $validOptions);
}

?>