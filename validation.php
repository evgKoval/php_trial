<?php

class Validation
{
    public static function checkName($name) {
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }

    public static function checkEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    public static function confirmPassword($password, $confirmPassword) {
        if (strlen($password) == 0 || strlen($confirmPassword) == 0) {
            return false;
        }
        if ($password === $confirmPassword) {
            return true;
        }
        return false;
    }

    public static function checkPassword($password) {
        if (strlen($password) >= 3) {
            return true;
        }
        return false;
    }

    public static function checkEmailExists($db, $email) {
        $db = $db->getConnection();
      
        $sql = 'SELECT COUNT(*) FROM users WHERE email = :email';
      
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if($result->fetchColumn())
            return true;
        return false;
    }
}