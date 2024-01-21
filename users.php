<?php

class Users
{
    private $tableName = "ops_users";
    private $prefix = "usr";

    // ============================================= Getter Functions =============================================

    public function getID($condition)
    {

        include_once 'admin/include/classes/database.php';

        $db = new Database();

        $db->select($this->tableName, "UserID", null, "UserID = '$condition'", null, null);

        foreach ($db->getResult() as $val) {
            foreach ($val as $value)
                return $value;
        }
    }

    public function getName($condition)
    {
        include_once 'admin/include/classes/database.php';

        $db = new Database();

        $db->select($this->tableName, "UserName", null, "UserID = '$condition'", null, null);

        foreach ($db->getResult() as $val) {
            foreach ($val as $value)
                return $value;
        }
    }

    public function getEmail($condition)
    {
        include_once 'admin/include/classes/database.php';

        $db = new Database();

        $db->select($this->tableName, "UserEmail", null, "UserID = '$condition'", null, null);

        foreach ($db->getResult() as $val) {
            foreach ($val as $value)
                return $value;
        }
    }

    public function getAddress($condition)
    {
        include_once 'admin/include/classes/database.php';

        $db = new Database();

        $db->select($this->tableName, "UserAddress", null, "UserID = '$condition'", null, null);

        foreach ($db->getResult() as $val) {
            foreach ($val as $value)
                return $value;
        }
    }

    public function getImage($condition)
    {
        include_once 'admin/include/classes/database.php';

        $db = new Database();

        $db->select($this->tableName, "UserImage", null, "UserID = '$condition'", null, null);

        foreach ($db->getResult() as $val) {
            foreach ($val as $value)
                return $value;
        }
    }

    public function getPassword($condition)
    {
        include_once 'admin/include/classes/database.php';

        $db = new Database();

        $db->select($this->tableName, "UserPassword", null, "UserID = '$condition'", null, null);

        foreach ($db->getResult() as $val) {
            foreach ($val as $value)
                return $value;
        }
    }

    public function getMobileNum($condition)
    {
        include_once 'admin/include/classes/database.php';

        $db = new Database();

        $db->select($this->tableName, "UserMobile", null, "UserID = '$condition'", null, null);

        foreach ($db->getResult() as $val) {
            foreach ($val as $value)
                return $value;
        }
    }

    public function getRegistrationDate($condition)
    {
        include_once 'admin/include/classes/database.php';

        $db = new Database();

        $db->select($this->tableName, "RegisterDate", null, "UserID = '$condition'", null, null);

        foreach ($db->getResult() as $val) {
            foreach ($val as $value)
                return $value;
        }
    }

    // ============================================= Generate ID Functions =============================================

    public function generateUserID()
    {
        $userID = $this->prefix . rand(100000, 999999);

        return $userID;
    }

    // ============================================= Create New User Functions =============================================

    public function newUser($name, $email, $userMobile, $password)
    {
        include_once 'admin/include/classes/database.php';

        $newUserEntry = new Database();

        date_default_timezone_set('Asia/Karachi');

        if ($newUserEntry->insert($this->tableName, ['UserID' => $this->generateUserID(), 'UserName' => $name, 'UserEmail' => $email, "UserMobile" => $userMobile, 'UserPassword' => password_hash($password, PASSWORD_BCRYPT), 'RegisterDate' => date('Y-m-d H:i:s')]))
            return true;
        else
            return false;
    }

    // ============================================= Add New User Functions (complete) =============================================

    public function addNewUser($userName, $userEmail, $userAddress, $userImage, $userPassword, $userMobile)
    {
        include_once 'admin/include/classes/database.php';

        $addNewUser = new Database();

        date_default_timezone_set('Asia/Karachi');

        if ($addNewUser->insert($this->tableName, ["UserID" => $this->generateUserID(), "UserName" => $userName, "UserEmail" => $userEmail,  "UserAddress" => $userAddress, "UserImage" => $userImage, "UserPassword" => password_hash($userPassword, PASSWORD_BCRYPT), "UserMobile" => $userMobile, "RegisterDate" => date('Y-m-d H:i:s')]))
            return true;
        else
            return false;
    }


    // ============================================= User Login Functions =============================================

    public function userLogin($email, $pass)
    {
        include_once 'admin/include/classes/database.php';

        $userLogin = new Database();

        $userLogin->select($this->tableName, 'UserEmail, UserPassword', null, "UserEmail = '$email'", null, null);

        foreach ($userLogin->getResult() as $val)

            if (($val['UserEmail'] == $email) && (password_verify($pass, $val['UserPassword']))) {
                return true;
            } else
                return false;
    }

    // ============================================= Update Profile Details Functions =============================================

    public function updateProfileDetails($name, $email, $address, $mobile, $condition)
    {
        include_once 'admin/include/classes/database.php';

        $updateProdileDetails = new Database();

        if ($updateProdileDetails->update($this->tableName, ["UserName" => $name, "UserEmail" => $email, "UserAddress" => $address, "UserMobile" => $mobile], "UserID = '$condition'"))
            return true;
        else
            return false;
    }

    // ============================================= Update Profile Pic Functions =============================================

    public function updateProfilePic($path, $condition)
    {
        include_once 'admin/include/classes/database.php';

        $updateProfilePic = new Database();

        if ($updateProfilePic->update($this->tableName, ["UserImage" => $path], "UserID = '$condition'"))
            return true;
        else
            return false;
    }

    // ============================================= Update User Password Functions =============================================

    public function updatePassword($newPass, $condition)
    {
        include_once 'admin/include/classes/database.php';

        $updatePass = new Database();

        if ($updatePass->update($this->tableName, ["UserPassword" => password_hash($newPass, PASSWORD_BCRYPT)], "UserID = '$condition'"))
            return true;
        else
            return false;
    }

    // ================================ Get Rows Count ================================ 

    public function totalUsers()
    {
        include_once 'admin/include/classes/database.php';

        $obj = new Database();

        $obj->countRows($this->tableName);

        foreach ($obj->getResult() as $value)
            foreach ($value as $val)
                return $val;
    }

    // ============================== Delete User Function ==============================

    public function deleteUser($condition)
    {
        include_once 'admin/include/classes/database.php';

        $obj = new Database();

        if ($obj->delete($this->tableName, "UserID = '$condition' "))
            return true;
        else
            return false;
    }

    // ============================== User Exist Function ==============================

    public function userExist($email)
    {
        include_once 'admin/include/classes/database.php';

        $obj = new Database();

        $obj->select($this->tableName, 'UserEmail', null, "UserEmail = '$email'", null, null);

        foreach ($obj->getResult() as $value)
            foreach ($value as $val)
                if ($val == $email)
                    return true;
                else
                    return false;
    }

    // ============================== Get User Login ID Function for session storage ==============================

    public function getUserLoginID($condition)
    {
        include_once 'admin/include/classes/database.php';

        $obj = new Database();

        $obj->select($this->tableName, 'UserID', null, "UserEmail = '$condition'", null, null);

        foreach ($obj->getResult() as $value)
            foreach ($value as $val)
                return $val;
    }

    // ============================== Recover forgot password ==============================

    public function setPassword($userID, $newPassword)
    {
        include_once 'admin/include/classes/database.php';

        $db = new Database();

        if ($db->update($this->tableName, ["UserPassword" => password_hash($newPassword, PASSWORD_BCRYPT)], "UserID = '$userID'"))
            return true;
        else
            return false;
    }
}
