<?php

class Login extends BaseModel
{


    function getUserByEmail($email)
    {
        return $this->select("SELECT * FROM user WHERE email = ?", array($email));
    }

    function updateSessionID($user_id, $value, $validDays)
    {
        $check = $this->select("SELECT * FROM session WHERE user_id = ?", array($user_id));

        // insert or update issue date and expire date
        if ($check["count"] == 0) {
            // Insert new session with DATETIME for issue_date and expire_date
            $this->insert(
                "INSERT INTO session (value, user_id, issue_date, expire_date) VALUES (?, ?, NOW(), DATE_ADD(NOW(), INTERVAL ? DAY))",
                array($value, $user_id, $validDays)
            );
        } else {
            // Update session with new issue_date and expire_date as DATETIME
            $this->update(
                "UPDATE session SET value = ?, issue_date = NOW(), expire_date = DATE_ADD(NOW(), INTERVAL ? DAY) WHERE user_id = ?",
                array($value, $validDays, $user_id)
            );
        }
    }
}
