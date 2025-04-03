<?php

class LoginController extends BaseController
{
    protected function beforeAction()
    {
        $this->loginCheck($redirect = false);
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->loginUser();
            return;
        }
    }

    private function loginUser()
    {
        $this->render = false;

        // Validate and process login form data
        $email = $_POST['email'];
        $password = $_POST['password'];
        $errors = [];

        // Validate email and password
        if (!Validator::email($email)) {
            $errors[] = "Invalid email format";
        }

        if (!Validator::notEmpty($password)) {
            $errors[] = "Password is required";
        }

        if (!empty($errors)) {
            $response = new Response("error", "Validation failed", ["errors" => $errors]);
            echo $response;
            exit;
        }

        $user = $this->model->getUserByEmail($email);

        if ($user["count"] > 0) {
            // Verify password
            $user = $user["result"][0];
            if (md5($password . $user["salt"]) === $user["password"]) {
                $value = Session::generateSessionID();
                $validDays = 30;

                $this->model->updateSessionID($user["id"], $value, $validDays);
                Session::setCookie($value, $validDays);

                foreach ($user as $key => $value) {
                    Session::set($key, $value);
                }


                $response = new Response("success", "Login successful");
                echo $response;
            } else {
                $response = new Response("error", "Invalid email or password");
                echo $response;
            }
        } else {
            $response = new Response("error", "Invalid email or password");
            echo $response;
        }
    }

    function logout()
    {
        $this->render = false;

        session_destroy();
        setcookie('studrent_session_id', '', time() - 3600, '/');
        header("location:" . BASE_PATH . "/login");
        exit;
    }

    protected function afterAction() {}
}
