<?php

class Validator
{
    public static function sanitize($data)
    {
        return htmlspecialchars(strip_tags($data));
    }

    public static function email($email)
    {
        // checks if parameter is valid, string and if its valid email matching email regex
        if (is_string($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    public static function password($password)
    {
        // checks if parameter is valid and meets criteria length 8-255, both upper and lower case letters, 
        // at least one number and special characters from array[!, ?, *, _, -]

        if (is_string($password) && preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!?\*_\-])[A-Za-z\d!?\*_\-]{8,255}$/', $password)) {
            return true;
        }
        return false;
    }

    public static function notEmpty($value)
    {
        // checks if parameter is not empty
        if (!empty($value)) {
            return true;
        }
        return false;
    }

    public static function string($value)
    {
        // checks if parameter is valid and is string
        if (is_string($value)) {
            return true;
        }
        return false;
    }

    public static function number($value)
    {
        // checks if parameter is valid and is number
        if (is_numeric($value)) {
            return true;
        }
        return false;
    }

    public static function date($date)
    {
        // checks if parameter is valid and is date
        if (is_string($date) && strtotime($date)) {
            return true;
        }
        return false;
    }

    public static function url($url)
    {
        // checks if parameter is valid and is url
        if (is_string($url) && filter_var($url, FILTER_VALIDATE_URL)) {
            return true;
        }
        return false;
    }

    public static function image($image)
    {
        // checks if parameter is valid and is image
        if (isset($image['tmp_name']) && getimagesize($image['tmp_name'])) {
            return true;
        }
        return false;
    }

    public static function file($file, $type)
    {
        // checks if parameter is valid and is file
        if (is_string($file) && file_exists($file) && mime_content_type($file) == $type) {
            return true;
        }
        return false;
    }

    public static function max($value, $max)
    {
        // checks if parameter is valid and is less than max
        if (is_numeric($value) && $value <= $max) {
            return true;
        }
        return false;
    }

    public static function min($value, $min)
    {
        // checks if parameter is valid and is greater than min
        if (is_numeric($value) && $value >= $min) {
            return true;
        }
        return false;
    }

    public static function between($value, $min, $max)
    {
        // checks if parameter is valid and is between min and max
        if (is_numeric($value) && $value >= $min && $value <= $max) {
            return true;
        }
        return false;
    }
}
