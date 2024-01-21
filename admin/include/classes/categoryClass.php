<?php

class Category
{
    private $tableName = "ops_category";
    private $prefix = "prtcat";

    // ============================== Getter Functions ==============================

    public function getCategoryName()
    {
        include_once "database.php";

        $obj = new Database();

        $obj->select($this->tableName, "CategoryName", null, null, null, null);

        foreach ($obj->getResult() as $value)
            foreach ($value as $val)
                return $val;
    }

    public function getCategoryDescription()
    {
        include_once "database.php";

        $obj = new Database();

        $obj->select($this->tableName, "CategoryDescription", null, null, null, null);

        foreach ($obj->getResult() as $value)
            foreach ($value as $val)
                return $val;
    }

    public function getCategoryInsertedDate()
    {
        include_once "database.php";

        $obj = new Database();

        $obj->select($this->tableName, "InsertedDate", null, null, null, null);

        foreach ($obj->getResult() as $value)
            foreach ($value as $val)
                return $val;
    }

    public function getCategoryModifiedDate()
    {
        include_once "database.php";

        $obj = new Database();

        $obj->select($this->tableName, "ModifiedDate", null, null, null, null);

        foreach ($obj->getResult() as $value)
            foreach ($value as $val)
                return $val;
    }

    public function getCategoryID()
    {
        include_once 'idGen.php';

        $obj = new IDGen();

        $res = $obj->generateID($this->prefix);

        return $res;
    }

    // ============================== Insert Data Function ==============================

    public function insertCategory($name, $description)
    {
        include_once "database.php";

        $obj = new Database();

        date_default_timezone_set('Asia/Karachi');

        if ($obj->insert($this->tableName, ['CategoryID' => $this->getCategoryID(), 'CategoryName' => $name, 'CategoryDescription' => $description, 'InsertedDate' => date('Y-m-d H:i:s'), 'ModifiedDate' => '']))
            return true;
        else
            return false;
    }

    // ============================== Fetch Data Function ==============================

    public function fetchData()
    {
        include_once "database.php";

        $obj = new Database();

        $obj->select($this->tableName, '*', null, null, null, null);

        $res = $obj->getResult();

        return $res;
    }

    // ============================== Delete Data Function ==============================

    public function deleteData($condition)
    {
        include_once "database.php";

        $obj = new Database();

        if ($obj->delete($this->tableName, "CategoryID = '$condition' "))
            return true;
        else
            return false;
    }

    // ============================== Fetch Data on Condition Function ==============================

    public function fetchDataOnCondition($condition)
    {
        include_once "database.php";

        $obj = new Database();

        $obj->select($this->tableName, '*', null, "CategoryID = '$condition'", null, null);

        $res = $obj->getResult();

        return $res;
    }

    // ============================== Update Data Function ==============================

    public function updateCategory($name, $description, $id)
    {
        include_once "database.php";

        $obj = new Database();

        date_default_timezone_set('Asia/Karachi');

        if ($obj->update($this->tableName, ["CategoryName" => $name, "CategoryDescription" => $description, "ModifiedDate" => date('Y-m-d H:i:s')], "CategoryID = '$id'"))
            return true;
        else
            return false;
    }

    // ================================ Get Rows Count ================================ 

    public function totalCategories()
    {
        include_once "database.php";

        $obj = new Database();

        $obj->countRows($this->tableName);

        foreach ($obj->getResult() as $value)
            foreach ($value as $val)
                return $val;
    }
}
