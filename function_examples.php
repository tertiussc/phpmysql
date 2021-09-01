<?php
/**
 * Simple example function that return a greeting depending on the Argument provided
 * @return string It will return "Good monring" if TRUE and "Good afternoon" if FALSE
 */

function getMessage($morning){
    if($morning){
        return "Good Morning";
    } else {
        return "Good Afternoon";
    }
}

$message = getMessage(false);
echo $message;


function add($first, $second) {
    return $first + $second;
}

add(4, 5);