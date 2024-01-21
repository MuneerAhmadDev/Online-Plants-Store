<?php


class UserCart
{
    private $tableName = "ops_usercart";

    // ======================== Getter Functions ========================

    public function getCartID($userID)
    {
        include_once 'database.php';

        $obj = new Database();

        $obj->select($this->tableName, 'CartID', null, "UserID = '$userID'", null, null);

        foreach ($obj->getResult() as $value)
            foreach ($value as $val)
                return $val;
    }

    public function getUserID($userID)
    {
        include_once 'database.php';

        $obj = new Database();

        $obj->select($this->tableName, 'UserID', null, "UserID = '$userID'", null, null);

        foreach ($obj->getResult() as $value)
            foreach ($value as $val)
                return $val;
    }

    public function getProductID($userID)
    {
        include_once 'database.php';

        $obj = new Database();

        $obj->select($this->tableName, 'ProductID', null, "UserID = '$userID'", null, null);

        foreach ($obj->getResult() as $value)
            foreach ($value as $val)
                return $val;
    }

    public function getProductPrice($userID)
    {
        include_once 'database.php';

        $obj = new Database();

        $obj->select($this->tableName, 'ProductPrice', null, "UserID = '$userID'", null, null);

        foreach ($obj->getResult() as $value)
            foreach ($value as $val)
                return $val;
    }

    public function getCreatedAt($userID)
    {
        include_once 'database.php';

        $obj = new Database();

        $obj->select($this->tableName, 'CreatedAt', null, "UserID = '$userID'", null, null);

        foreach ($obj->getResult() as $value)
            foreach ($value as $val)
                return $val;
    }


    // ======================== Insert Data Function ========================

    public function addCart($userID, $prodID, $productQuantity, $productPrice)
    {
        include_once 'database.php';

        include_once 'cartItems.php';

        $items = new CartItems();

        $obj = new Database();

        date_default_timezone_set('Asia/Karachi');

        if ($obj->insert($this->tableName, ["UserID" => $userID, "CreatedAt" => date('Y-m-d H:i:s')])) {
            if ($items->addItems($this->getCartID($userID), $prodID, $productPrice, $productQuantity))
                return true;
            else
                false;
        }
    }

    // ======================== Remove Cart Function ========================

    public function deleteCart($userID)
    {
        include_once 'database.php';

        $db = new Database();

        if ($db->delete($this->tableName, "UserID = '$userID'"))
            return true;
        else
            return false;
    }
}
