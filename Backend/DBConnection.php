<?php

class DataBase
{
    private $servername = "localhost:3306";
    private $user_name = "root";
    private $password = "root";
    private $dbname = "dairy";

    public function make_connection()
    {
        $conn = mysqli_connect($this->servername, $this->user_name, $this->password, $this->dbname);

        if ($conn)
            return $conn;
        else
            return false;
    }
}
?>

