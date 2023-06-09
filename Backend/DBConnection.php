<?php

class DataBase
{
    private $servername = "localhost:3307";
    private $user_name = "root";
    private $password = "umair";
    private $dbname = "dairyFarm";

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

