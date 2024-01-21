<?php

class Database
{
    private $database_host = "localhost";
    private $database_user = "root";
    private $database_password = "";
    private $database_name = "online_plants_store";

    private $conn = false;
    private $mysqli_connection = "";
    private $result = array();

    // Connection With Database.

    public function __construct()
    {
        if ($this->conn == false) {
            $this->mysqli_connection = new mysqli($this->database_host, $this->database_user, $this->database_password, $this->database_name) or die("Database connection failed" . print_r($this->mysqli_connection->error));
            $this->conn = true;
        }
    }


    // Verify Table Existence

    public function tableExist($table_name)
    {
        $query = "SHOW TABLES FROM $this->database_name LIKE '$table_name'";

        $tableInDB = $this->mysqli_connection->query($query);

        if ($tableInDB) {
            if ($tableInDB->num_rows > 0) {
                return true;
            } else {
                return false;
            }
        }
    }



    // Rsult Method

    public function getResult()
    {
        $val = $this->result;
        $this->result = array();
        return $val;
    }



    // insert method, to insert data in database

    public function insert($table_name, $parameters = array())
    {
        if ($this->tableExist($table_name)) {

            $table_columns = implode(',', array_keys($parameters));
            $table_columns_values = implode("','", $parameters);

            $query = "INSERT INTO $table_name ($table_columns) VALUES ('$table_columns_values')";
            if ($this->mysqli_connection->query($query)) {
                return true;
            } else {
                echo "<pre>";
                print_r($this->mysqli_connection->error);
                echo "</pre>";
            }
        } else {
            echo "Table does not exist";
        }
    }



    // update method in database

    public function update($table_name, $parameters = array(), $where = null)   // must use where clause must use.
    {
        if ($this->tableExist($table_name)) {

            $arguments = array();

            foreach ($parameters as $key => $value) {
                $arguments[] = "$key = '$value'";
            }

            $query = "UPDATE $table_name SET " . implode(',', $arguments);

            if ($where != null) {
                $query .= " WHERE $where";
            }
            if ($this->mysqli_connection->query($query)) {
                // echo "Record Updated Successfully.";
                return true;
            } else {
                echo "<pre>";
                print_r($this->mysqli_connection->error);
                echo "</pre>";
            }
        } else {
            echo "Table does not exist";
        }
    }



    // delete method, to delete record in database

    public function delete($table_name, $where = null)
    {
        if ($this->tableExist($table_name)) {

            $query = "DELETE FROM $table_name";

            if ($where != null) {
                $query .= " WHERE $where";
            }
            if ($this->mysqli_connection->query($query)) {
                // echo "Record Deleted Successfully.";
                return true;
            } else {
                echo "<pre>";
                print_r($this->mysqli_connection->error);
                echo "</pre>";
            }
        } else {
            echo "Table does not exist";
        }
    }



    // Select method, to show data in database

    public function select($table_name, $rows = "*", $join = null, $where = null, $order_by = null, $limit = null)
    {
        if ($this->tableExist($table_name)) {

            $query = "SELECT $rows FROM $table_name";

            if ($join != null)
                $query .= " JOIN $join";

            if ($where != null)
                $query .= " WHERE $where";

            if ($order_by != null)
                $query .= " ORDER BY $order_by";

            if ($limit != null)
                $query .= " LIMIT 0, $limit";

            $query_res = $this->mysqli_connection->query($query);

            if ($query) {
                $this->result = $query_res->fetch_all(MYSQLI_ASSOC);
            } else {
                echo $this->mysqli_connection->error;
            }
        } else {
            echo "Table does not exist";
        }
    }




    // Destructor method, to close connection

    public function __destruct()
    {
        if ($this->conn) {
            $this->mysqli_connection->close();
            $this->conn = false;
        }
    }
}







?>
<!-- hslkj -->