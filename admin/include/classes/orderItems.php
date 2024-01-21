<?php


class OrderItems
{
    private $tableName = "ops_orderitems";


    // ============================== Add Order Items ==============================

    public function addData($oderID, $productID, $productQuantity, $productPrice)
    {
        include_once 'database.php';

        $db = new Database();

        if ($db->insert($this->tableName, ["OrderID" => $oderID, "ProductID" => $productID, "ProductQuantity" => $productQuantity, "ProductPrice" => $productPrice]))
            return true;
        else
            return false;
    }
}
