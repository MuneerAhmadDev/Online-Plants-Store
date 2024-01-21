<?php

class CartItems
{
    private $tableName = "ops_cartitems";

    // ======================= Getter functions =======================

    public function getCartTotalItems($cartID)
    {
        include_once 'database.php';

        $db = new Database();

        $db->select($this->tableName, "count(*)", null, "CartID = '$cartID'", null, null);

        foreach ($db->getResult() as $value)
            foreach ($value as $val)
                return $val;
    }

    // ======================= Add item function =======================

    public function addItems($cartID, $productID, $productPrice, $productQuantity)
    {
        include_once 'database.php';

        $obj = new Database();

        if ($obj->insert($this->tableName, ["CartID " => $cartID, "ProductID" => $productID, "ProductPrice" => $productPrice, "ProductQuantity" => $productQuantity]))
            return true;
        else
            return false;
    }

    // ======================= Update item quantity function =======================

    public function updateProductQuantity($cartID, $productID, $productQuantity)
    {
        include_once 'database.php';

        $db = new Database();

        if ($db->update($this->tableName, ["ProductQuantity" => $productQuantity], " CartID = '$cartID' AND ProductID = '$productID'"))
            return true;
        else
            return false;
    }

    // ======================= Update price with quantity update function =======================

    public function updatePrice($cartID, $productID, $productPrice)
    {
        include_once 'database.php';

        $db = new Database();

        if ($db->update($this->tableName, ["ProductPrice" => $productPrice], " CartID = '$cartID' AND ProductID = '$productID'"))
            return true;
        else
            return false;
    }


    // ======================= Remove item function =======================

    public function removeItem($cartID, $productID)
    {
        include_once 'database.php';

        $db = new Database();

        if ($db->delete($this->tableName, " CartID = '$cartID' AND ProductID = '$productID'"))
            return true;
        else
            return false;
    }
}
