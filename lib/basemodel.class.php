<?php

class BaseModel extends SQLDB
{

    function getSessionFromCookie($cookie)
    {
        return $this->select("SELECT * from session where value = ?", array($cookie));
    }

    function getUserById($user_id)
    {
        return $this->select("SELECT * FROM user WHERE id =?", array($user_id));
    }

    function getUserBySessionCookie($cookie)
    {
        return $this->select_one("SELECT u.* FROM user u left JOIN session s ON u.id = s.user_id WHERE s.value = ? LIMIT 1", array($cookie));
    }

}
