<?php

class Register extends BaseModel {


    function getUserById($user_id)
    {
        return $this->select("SELECT * FROM user WHERE id =?", array($user_id))["result"][0];
    }

    function getUserByEmail($email)
    {
        return $this->select("SELECT * FROM user WHERE email =?", array($email));
    }

}
