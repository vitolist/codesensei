<?php
date_default_timezone_set('Europe/Zagreb');


define('DEVELOPMENT', true);
define('SHOW_ERRORS', false);
define('APP_NAME', 'CodeSensei');
define('APP_VERSION', '1.0.0');
define('APP_AUTHOR', 'Noa Turk i Vito List');

if (DEVELOPMENT) {
    define('APPFOLDER', 'codesensei');
    define('DB_HOST', '138.197.178.70');
    define('DB_USERNAME', 'codesensei-remote');
    define('DB_PASSWORD', 'W7K0wlgMEX.TrLfZ');
    define('DB_NAME', 'codesensei_eu');
    // define('BASE_PATH', 'https://codesensei.xyz');
    define('BASE_PATH', 'https://testiranje.in');
} else {
    // define('APPFOLDER', 'codesensei.xyz');
    define('APPFOLDER', 'testiranje.in');
    define('DB_HOST', '138.197.178.70');
    define('DB_USERNAME', 'codesensei');
    define('DB_PASSWORD', '14(4n;C5DH,|g5');
    define('DB_NAME', 'codesensei_eu');
    // define('BASE_PATH', 'https://codesensei.xyz');
    define('BASE_PATH', 'https://testiranje.in');
}
