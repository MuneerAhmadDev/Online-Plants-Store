<?php

class Product
{
    private $prefix = "prd";
    private $tableName = "ops_product";


    // ============================================= Getter Functions =============================================

    public function getID($condition)
    {
        include_once 'database.php';

        $db = new Database();

        $db->select($this->tableName, "ProductID", null, "ProductID = '$condition'", null, null);

        foreach ($db->getResult() as $val) {
            foreach ($val as $value)
                return $value;
        }
    }

    public function getName($condition)
    {
        include_once 'database.php';

        $db = new Database();

        $db->select($this->tableName, "ProductName", null, "ProductID = '$condition'", null, null);

        foreach ($db->getResult() as $val) {
            foreach ($val as $value)
                return $value;
        }
    }

    public function getCategory($condition)
    {
        include_once 'database.php';

        $db = new Database();

        $db->select($this->tableName, "ProductCategory", null, "ProductID = '$condition'", null, null);

        foreach ($db->getResult() as $val) {
            foreach ($val as $value)
                return $value;
        }
    }

    public function getPrice($condition)
    {
        include_once 'database.php';

        $db = new Database();

        $db->select($this->tableName, "ProductPrice", null, "ProductID = '$condition'", null, null);

        foreach ($db->getResult() as $val) {
            foreach ($val as $value)
                return $value;
        }
    }

    public function getStock($condition)
    {
        include_once 'database.php';

        $db = new Database();

        $db->select($this->tableName, "ProductStock", null, "ProductID = '$condition'", null, null);

        foreach ($db->getResult() as $val) {
            foreach ($val as $value)
                return $value;
        }
    }

    public function getInsertedDate($condition)
    {
        include_once 'database.php';

        $db = new Database();

        $db->select($this->tableName, "InsertedDate", null, "ProductID = '$condition'", null, null);

        foreach ($db->getResult() as $val) {
            foreach ($val as $value)
                return $value;
        }
    }

    public function getModifiedDate($condition)
    {
        include_once 'database.php';

        $db = new Database();

        $db->select($this->tableName, "ModifiedDate", null, "ProductID = '$condition'", null, null);

        foreach ($db->getResult() as $val) {
            foreach ($val as $value)
                return $value;
        }
    }

    public function getPicture($condition)
    {
        include_once 'database.php';

        $db = new Database();

        $db->select($this->tableName, "ProductPic", null, "ProductID = '$condition'", null, null);

        foreach ($db->getResult() as $val) {
            foreach ($val as $value)
                return $value;
        }
    }

    public function getDescription($condition)
    {
        include_once 'database.php';

        $db = new Database();

        $db->select($this->tableName, "ProductDescription", null, "ProductID = '$condition'", null, null);

        foreach ($db->getResult() as $val) {
            foreach ($val as $value)
                return html_entity_decode($value);
        }
    }

    // ================================ Get ID ================================ 

    public function getProductID()
    {
        include_once 'idGen.php';

        $obj = new IDGen();

        $res = $obj->generateID($this->prefix);

        return $res;
    }

    // ================================ Insert Product ================================ 

    public function insertProduct($pic, $name, $category, $desc, $price, $stock)
    {
        date_default_timezone_set('Asia/Karachi');

        include_once "database.php";

        $obj = new Database();

        if ($obj->insert($this->tableName, ["ProductID" => $this->getProductID(), "ProductName" => $name, "ProductCategory" => $category, "ProductDescription" => $desc, "ProductPrice" => $price, "ProductStock" => $stock, "InsertedDate" => date('Y-m-d H:i:s'), "ModifiedDate" => "", "ProductPic" => $pic]))
            return true;
        else
            return false;
    }

    // ================================ Fetch Data Product ================================ 

    public function fetchData()
    {
        include_once "database.php";

        $obj = new Database();

        $obj->select($this->tableName, '*', null, null, null, null);

        $res = $obj->getResult();

        return $res;
    }

    // ================================ Delete Product ================================ 

    public function deleteProduct($condition)
    {
        include_once "database.php";

        $obj = new Database();

        if ($obj->delete($this->tableName, "ProductID = '$condition' "))
            return true;
        else
            return false;
    }

    // ================================ Fetch Product Data on Condition ================================ 


    public function fetchDataOnCondition($condition)
    {
        include_once "database.php";

        $obj = new Database();

        $obj->select($this->tableName, '*', null, "ProductID = '$condition'", null, null);

        $res = $obj->getResult();

        return $res;
    }

    // ================================ Update Product Pic on Condition ================================ 

    public function updateProductPicture($path, $condition)
    {
        include_once "database.php";

        $obj = new Database();

        date_default_timezone_set('Asia/Karachi');

        if ($obj->update($this->tableName, ["ProductPic" => $path, "ModifiedDate" => date('Y-m-d H:i:s')], "ProductID = '$condition'"))
            return true;
        else
            return false;
    }

    // ================================ Update Product Details on Condition ================================ 

    public function updateproductDetails($name, $category, $desc, $price, $stock, $condition)
    {
        include_once "database.php";

        $obj = new Database();

        date_default_timezone_set('Asia/Karachi');

        if ($obj->update($this->tableName, ["ProductName" => $name, "ProductCategory" => $category, "ProductDescription" => $desc, "ProductPrice" => $price, "ProductStock" => $stock, "ModifiedDate" => date('Y-m-d H:i:s')], "ProductID = '$condition'"))
            return true;
        else
            return false;
    }

    // ================================ Get Rows Count ================================ 

    public function totalProducts()
    {
        include_once "database.php";

        $obj = new Database();

        $obj->countRows($this->tableName);

        foreach ($obj->getResult() as $value)
            foreach ($value as $val)
                return $val;
    }

    // ================================ Product Decriment ================================

    public function productDrecease($productID, $qanti)
    {
        include_once 'database.php';

        $db = new Database();

        $stock = $this->getStock($productID);

        $stock = $stock - $qanti;

        if ($db->update($this->tableName, ["ProductStock" => $stock], "ProductID = '$productID'"))
            return true;
        else
            return false;
    }
}
