<?php


class ChidCategory
{
    private $tableName = 'ops_subcategory';
    private $prefix = 'chdcat';


    public function getCategoryID()
    {
        include_once 'idGen.php';

        $obj = new IDGen();

        $res = $obj->generateID($this->prefix);

        return $res;
    }


    // ============================== Insert Data Function ==============================

    public function insertChildCategory($name, $parentCategory, $description)
    {
        include_once "database.php";

        $obj = new Database();

        date_default_timezone_set('Asia/Karachi');

        if ($obj->insert($this->tableName, ['SubCategoryID ' => $this->getCategoryID(), 'SubCategoryName' => $name, "ParentCategory" => $parentCategory, 'SubCategoryDescription' => $description, 'InsertedDate' => date('Y-m-d H:i:s'), 'ModifiedDate' => '']))
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

    // ============================== Fetch Data on Condition Function ==============================

    public function fetchDataOnCondition($condition)
    {
        include_once "database.php";

        $obj = new Database();

        $obj->select($this->tableName, '*', null, "SubCategoryID = '$condition'", null, null);

        $res = $obj->getResult();

        return $res;
    }

    // ============================== Delete Data Function ==============================

    public function deleteData($condition)
    {
        include_once "database.php";

        $obj = new Database();

        if ($obj->delete($this->tableName, "SubCategoryID  = '$condition' "))
            return true;
        else
            return false;
    }

    // ============================== Update Data Function ==============================

    public function updateCategory($name, $description, $id)
    {
        include_once "database.php";

        $obj = new Database();

        date_default_timezone_set('Asia/Karachi');

        if ($obj->update($this->tableName, ["SubCategoryName" => $name, "SubCategoryDescription" => $description, "ModifiedDate" => date('Y-m-d H:i:s')], "SubCategoryID = '$id'"))
            return true;
        else
            return false;
    }

    // ============================== Update Prent Category Function ==============================

    public function updateParentCategory($id, $name)
    {
        include_once "database.php";

        $obj = new Database();

        date_default_timezone_set('Asia/Karachi');

        if ($obj->update($this->tableName, ["ParentCategory" => $name, "ModifiedDate" => date('Y-m-d H:i:s')], "SubCategoryID = '$id'"))
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
