<?php

function setReporting()
{
    if (SHOW_ERRORS == true) {
        error_reporting(E_ALL);
        ini_set('display_errors', 'On');
    } else {
        error_reporting(E_ALL);
        ini_set('display_errors', 'Off');
        ini_set('log_errors', 'On');
    }
}

function dispatch()
{
    $url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
    $router = new Router($url);

    $controllerName = $router->getController();
    $actionName = $router->getAction();
    $parameters = $router->getParams();

    // Sanitize controller name to prevent directory traversal and other attacks
    $controllerName = preg_replace('/[^a-zA-Z0-9]/', '', $controllerName);
    $controllerClass = $controllerName . 'controller';

    // if (!class_exists($controllerClass)) {
    //     // TODO make 404 not found page
    //     header("Location: " . BASE_PATH . "/landing");
    //     exit;
    // }

    if (file_exists(ROOT . DS . 'app' . DS . 'controllers/' . $controllerClass . '.php')) {
        require_once ROOT . DS . 'app' . DS . 'controllers/' . $controllerClass . '.php';

        if (class_exists($controllerClass)) {
            $controller = new $controllerClass($controllerName, $actionName);

            // Use Reflection to check if the method is public
            $reflection = new ReflectionClass($controllerClass);
            if ($reflection->hasMethod($actionName)) {
                $method = $reflection->getMethod($actionName);
                if ($method->isPublic()) {
                    $controller->executeAction($actionName, $parameters);
                } else {
                    require_once ROOT . DS . 'app' . DS . 'views' . DS . 'header.php';
                    require_once ROOT . DS . 'app' . DS . 'views' . DS . '404.php';
                    require_once ROOT . DS . 'app' . DS . 'views' . DS . 'footer.php';
                    exit;
                    echo "Action '$actionName' is not accessible.";
                }
            } else {
                require_once ROOT . DS . 'app' . DS . 'views' . DS . 'header.php';
                require_once ROOT . DS . 'app' . DS . 'views' . DS . '404.php';
                require_once ROOT . DS . 'app' . DS . 'views' . DS . 'footer.php';
                exit;
                echo "Action '$actionName' not found.";
            }
        } else {
            require_once ROOT . DS . 'app' . DS . 'views' . DS . 'header.php';
            require_once ROOT . DS . 'app' . DS . 'views' . DS . '404.php';
            require_once ROOT . DS . 'app' . DS . 'views' . DS . 'footer.php';
            exit;
            echo "Controller class '$controllerClass' not found.";
        }
    } else {
        require_once ROOT . DS . 'app' . DS . 'views' . DS . 'header.php';
        require_once ROOT . DS . 'app' . DS . 'views' . DS . '404.php';
        require_once ROOT . DS . 'app' . DS . 'views' . DS . 'footer.php';
        exit;
        echo "Controller file for '$controllerClass' not found.";
    }
}

spl_autoload_register(function ($className) {
    $classFileName = strtolower($className);

    $paths = [
        ROOT . DS . 'app' . DS . 'controllers' . DS . $classFileName . '.php',
        ROOT . DS . 'app' . DS . 'models' . DS . $classFileName . '.php',
        ROOT . DS . 'helpers' . DS . $classFileName . '.class.php',
        ROOT . DS . 'lib' . DS . $classFileName . '.class.php',
    ];

    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once($path);
            return;
        }
    }

    error_log("Autoloader Error: Class '$className' not found in controllers, models, or helpers.");
});

setReporting();
dispatch();
