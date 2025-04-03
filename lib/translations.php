<?php

require_once ROOT . DS . "config" . DS . "config.php";


// get language from cookie, by default it is en
$allowed_languages = array("en", "hr");
$lang = isset($_COOKIE['language']) && in_array($_COOKIE['language'], $allowed_languages) ? $_COOKIE['language'] : "en";

// english to croatian

$routes = array(
    "home" => "pocetna",
    "login" => "prijava",
    "register" => "registracija",
    "logout" => "odjava",
    "profile" => "profil",
    "about" => "o-nama",
    "map" => "karta",
    "apartments" => "stanovi",
);
