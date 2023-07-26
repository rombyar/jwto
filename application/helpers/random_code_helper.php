<?php  if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

function codeUn()
{
    $uniqid = uniqid();
    $rand_start = rand(1, 5);
    $rand_8_char = substr($uniqid, $rand_start, 8);
    return $rand_8_char;
}


function cutText($text)
{
    $num_char = 60;
    return substr($text, 0, $num_char) . '...';
}

function randomBytes($length = 6)
{
    $characters = '0123456789';
    $characters_length = strlen($characters);
    $output = '';
    for ($i = 0; $i < $length; $i++) {
        $output .= $characters[rand(0, $characters_length - 1)];
    }

    return $output;
}
