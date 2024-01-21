<?php

class UserOrders
{
    private $tableName = "ops_userorders";

    // ============================== Getters Functions ==============================

    public function getOrderID($userID)
    {
        include_once 'database.php';

        $db = new Database();

        $db->select($this->tableName, "OrderID", null, "UserID = '$userID'", null, null);

        foreach ($db->getResult() as $value)
            foreach ($value as $val)
                return $val;
    }


    public function getUserID($userID)
    {
        include_once 'database.php';

        $db = new Database();

        $db->select($this->tableName, "UserID", null, "UserID = '$userID'", null, null);

        foreach ($db->getResult() as $value)
            foreach ($value as $val)
                return $val;
    }


    // ==================================== Add Data ====================================

    public function addData($userID, $shippingAddress, $totalPrice)
    {
        include_once 'database.php';

        $db = new Database();

        date_default_timezone_set('Asia/Karachi');

        if ($db->insert($this->tableName, ["UserID" => $userID, "OrderStatus" => "Pending", "ShippingAddress" => $shippingAddress, "TotalPrice" => $totalPrice, "CreatedAt" => date('Y-m-d H:i:s')]))
            return true;
        else
            return false;
    }

    // ==================================== Update Status ====================================

    public function udpateOrderStatus($status, $userID, $orderID)
    {
        include_once 'database.php';

        $db = new Database();

        if ($db->update($this->tableName, ["OrderStatus" => $status], "OrderID = '$orderID' AND UserID = '$userID'"))
            return true;
        else
            return false;
    }
}
