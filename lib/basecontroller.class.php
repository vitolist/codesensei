<?php

class BaseController
{
    protected $controller;
    protected $action;
    protected $model;
    protected $viewData = [];

    public $render = true;
    public $user;

    public function __construct($controller, $action)
    {
        $this->controller = $controller;
        $this->action = $action;

        $this->loadModel($controller);
    }

    protected function loadModel($controllerName)
    {
        $modelName = strtolower($controllerName);
        $modelFile = ROOT . DS . 'app' . DS . 'models' . DS . $modelName . '.php';


        if (file_exists($modelFile)) {
            require_once $modelFile;
            $modelName = ucfirst($modelName);

            if (class_exists($modelName)) {

                $this->model = new $modelName();
            } else {
                echo "Model class '$modelName' not found.";
            }
        } else {
            echo "Model file '$modelFile' not found.";
        }
    }

    protected function set($key, $value)
    {
        $this->viewData[$key] = $value;
    }

    protected function renderView()
    {

        if ($this->render) {
            $viewFile = ROOT . DS . 'app' . DS . 'views' . DS . strtolower($this->controller) . DS . $this->action . '.php';

            if (file_exists($viewFile)) {
                extract($this->viewData); // Extract view data as variables

                if (file_exists(ROOT . DS . 'app' . DS . 'views' . DS . strtolower($this->controller) . DS . "header.php")) {
                    require ROOT . DS . 'app' . DS . 'views' . DS . strtolower($this->controller) . DS . "header.php";
                } else {
                    require ROOT . DS . 'app' . DS . 'views' . DS . "header.php";
                }

                require $viewFile;

                if (file_exists(ROOT . DS . 'app' . DS . 'views' . DS . strtolower($this->controller) . DS . "footer.php")) {
                    require ROOT . DS . 'app' . DS . 'views' . DS . strtolower($this->controller) . DS . "footer.php";
                } else {
                    require ROOT . DS . 'app' . DS . 'views' . DS . "footer.php";
                }
            } else {
                echo "View file for '$this->action' not found.";
            }
        }
    }

    protected function beforeAction() {}

    protected function afterAction() {}

    public function executeAction($action, $params = [])
    {
        if (method_exists($this, $action)) {
            $reflection = new ReflectionMethod($this, $action);
            if ($reflection->isPublic()) {
                $this->beforeAction();
                call_user_func_array([$this, $action], $params);
                $this->afterAction();
                $this->renderView();
            } else {
                $this->actionNotFound($action);
            }
        } else {
            $this->actionNotFound($action);
        }
    }

    protected function actionNotFound($action)
    {
        echo "Action '$action' not found in controller '" . get_class($this) . "'";
    }

    public function loginCheck($redirect = true)
    {

        Session::start();

        // check if studrent_session_id cookie is set
        if (Session::getCookie()) {

            $cookie = Session::getCookie();
            $isValid = $this->sessionValid($cookie);

            if ($isValid) {
                $user = $this->model->getUserBySessionCookie($cookie);

                if ($user["status"] == "active") {
                    // $this->user = $user;

                    foreach ($user as $key => $value) {
                        Session::set($key, $value);
                    }
                } elseif ($user['status'] == "registered") {
                } elseif ($user['status'] == "not active") {
                }

                Session::logIn();

                return true;
            } else {
                if ($redirect) {
                    Router::redirect("/login");
                }

                return false;
            }
        } else {
            if ($redirect) {
                Router::redirect("/login");
            }

            return false;
        }

        return false;
    }

    function authWithToken($token)
    {
        $real_token = $this->model->select("SELECT * FROM auth_token WHERE token = ?", array($token));

        if ($real_token["row_count"] == 0) {
            // token invalid
        } else {
            $user_id = $real_token["result"][0]["user_id"];
            $this->model->update("UPDATE user set status = 'active' WHERE user_id = ?", array($user_id));

            Router::redirect("/login");
        }
    }

    public function sessionValid($cookie)
    {
        $check = $this->model->getSessionFromCookie($cookie);

        if ($check["count"] > 0) {

            $session = $check["result"][0];

            // check if expire date is valid
            $expire_date = strtotime($session["expire_date"]);
            $current_date = strtotime(date("Y-m-d H:i:s"));
            if ($expire_date > $current_date) {
                return true;
            }

            return false;
        }

        return false;
    }
}
