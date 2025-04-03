<?php


function abort($code, $message = '')
{
    http_response_code($code);
    die($message);
}
