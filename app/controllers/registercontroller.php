<?php

class RegisterController extends BaseController
{

    protected function beforeAction()
    {
        $this->loginCheck(false);
    }


    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->registerUser();
            return;
        }

    }

    protected function afterAction() {}

    private function registerUser()
    {
        $this->render = false;

        $required_fields = array("first_name", "last_name", "email", "password");
        $errors = [];

        foreach ($required_fields as $field) {
            if (empty($_POST[$field])) {
                $errors[] = "$field is required";
            }
        }

        // Additional validation
        if (!Validator::email($_POST['email'])) {
            $errors[] = "Invalid email format";
        }

        if (!Validator::date($_POST['birth_date'])) {
            $errors[] = "Invalid date format";
        }

        if (!Validator::password($_POST['password'])) {
            $errors[] = "Password must be 8-255 characters long, contain both upper and lower case letters, at least one number, and special characters (!, ?, *, _, -)";
        }

        if (!empty($errors)) {
            $response = new Response("error", "Validation failed", ["errors" => $errors]);
            echo $response;
            exit;
        }

        // Sanitize inputs
        $first_name = Validator::sanitize($_POST['first_name']);
        $last_name = Validator::sanitize($_POST['last_name']);
        $sex = in_array($_POST["sex"], ["M", "Z"]) ? $_POST["sex"] : "M"; // TODO throw error
        $type = in_array($_POST["account_type"], ["student", "landlord"]) ? $_POST["account_type"] : "student"; // TODO throw error
        $phone = Validator::sanitize($_POST["phone"]);
        $birth_date = Validator::sanitize($_POST["birth_date"]);
        $email = Validator::sanitize($_POST['email']);
        $password = $_POST["password"];

        // Handle file upload
        if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
            $fileUpload = new FileUpload($_FILES['picture'], ROOT . DS . "public" . DS . 'uploads' . DS . 'propic');
            if ($fileUpload->upload()) {
                $picture = $fileUpload->getFilename();
            } else {
                $errors = $fileUpload->getErrors();
                $response = new Response("error", "File upload failed", ["errors" => $errors]);
                echo $response;
                exit;
            }
        } else {
            $picture = null; // or handle the case where no file was uploaded
        }

        // Check if email is already in the database
        if ($this->model->getUserByEmail($email)["count"] > 0) {
            $response = new Response("error", "Email is already registered");
            echo $response;
            exit;
        }

        $salt = $this->randomString();
        $hashed_password = md5($password . $salt);

        $user_id = $this->model->insert(
            "INSERT INTO user 
            (first_name, last_name, email, sex, phone, birth_date, propic, password, salt, type) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
            [$first_name, $last_name, $email, $sex, $phone, $birth_date, $picture, $hashed_password, $salt, $type]
        )["insert_id"];

        $token = $this->randomString(64);
        $issue_date = date('Y-m-d H:i:s');
        // Token is valid for 24 hours
        $expire_date = date('Y-m-d H:i:s', strtotime('+24 hours'));
        $this->model->insert("INSERT INTO auth_token (user_id, token, issue_date, expire_date) VALUES (?, ?, ?, ?)", [$user_id, $token, $issue_date, $expire_date]);

        $response = new Response("success", "Registration successful");
        echo $response;
    }

    private function randomString($length = 32)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }
}
