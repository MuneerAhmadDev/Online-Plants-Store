<?php


class Admin
{
    private $tableName = "ops_admin";


   // ============================== Getter Functions ============================== 

    public function getName()
    {
        include_once "database.php";

        $obj = new Database();

        $obj->select($this->tableName, "AdminName", null, null, null, null);

        foreach ($obj->getResult() as $value)
            foreach ($value as $val)
                return $val;
    }

    public function getEmail()
    {
        include_once "database.php";

        $obj = new Database();

        $obj->select($this->tableName, "AdminEmail", null, null, null, null);

        foreach ($obj->getResult() as $value)
            foreach ($value as $val)
                return $val;
    }

    public function getMobileNumber()
    {
        include_once "database.php";

        $obj = new Database();

        $obj->select($this->tableName, "AdminMobile", null, null, null, null);

        foreach ($obj->getResult() as $value)
            foreach ($value as $val)
                return $val;
    }

    public function getAddress()
    {
        include_once "database.php";

        $obj = new Database();

        $obj->select($this->tableName, "AdminAddress", null, null, null, null);

        foreach ($obj->getResult() as $value)
            foreach ($value as $val)
                return $val;
    }

    public function getImage()
    {
        include_once "database.php";

        $obj = new Database();

        $obj->select($this->tableName, "AdminImage", null, null, null, null);

        foreach ($obj->getResult() as $value)
            foreach ($value as $val)
                return $val;
    }

    public function getPassword()
    {
        include_once "database.php";

        $obj = new Database();

        $obj->select($this->tableName, "AdminPassword", null, null, null, null);

        foreach ($obj->getResult() as $value)
            foreach ($value as $val)
                return $val;
    }

    // ============================== SetPasswor ============================== 

    public function setPassword($pass)
    {
        include_once 'database.php';

        $db = new Database();

        if ($db->update($this->tableName, ['AdminPassword' => password_hash($pass, PASSWORD_BCRYPT)], "AdminID = '1'"))
            return true;
        else
            return false;
    }

    // ============================== Update Profile Picture ============================== 

    public function updateProfilePicture($path)
    {
        include_once "database.php";

        $obj = new Database();

        if ($obj->update($this->tableName, ["AdminImage" => $path], "AdminID = 1"))
            return true;
        else
            return false;
    }

    // ============================== Update Profile ==============================

    public function updateProfile($name, $email, $mobile, $address)
    {
        include_once "database.php";

        $obj = new Database();

        if ($obj->update($this->tableName, ["AdminName" => $name, "AdminEmail" => $email, "AdminMobile" => $mobile, "AdminAddress" => $address], "AdminID = 1"))
            return true;
        else
            return false;
    }

    // ============================== Admin Login ==============================

    public function adminLogin($adminEmail, $adminPassword)
    {

        if (($adminEmail == $this->getEmail()) && (password_verify($adminPassword, $this->getPassword())))
            return true;
        else
            return false;
    }

    // ============================== Update Password ==============================

    public function updatePassword($oldPassword, $newPassword)
    {
        if (password_verify($oldPassword, $this->getPassword())) {

            include_once "database.php";

            $obj = new Database();

            if ($obj->update($this->tableName, ["AdminPassword" => password_hash($newPassword, PASSWORD_BCRYPT)], "AdminID = 1"))
                return true;
        } else
            return false;
    }


    // ============================== Recover forgot password ==============================

    public function setForgotPassword($userID, $newPassword)
    {
        include_once 'database.php';

        $db = new Database();

        if ($db->update($this->tableName, ["AdminPassword" => password_hash($newPassword, PASSWORD_BCRYPT)], "AdminID  = '$userID'"))
            return true;
        else
            return false;
    }
}