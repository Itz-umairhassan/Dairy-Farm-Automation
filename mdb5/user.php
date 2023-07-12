<?php

require_once('./DBConnection.php');

class user
{

    private $db;
    function __construct()
    {
        $this->db = new DataBase();
    }

    public function verify_user($name, $password)
    {
        $conn = $this->db->make_connection();

        $sql = "select * from usercredentials where name='" . $name . "' and password='" . $password . "'";

        //echo $sql;
        $result = mysqli_query($conn, $sql);
        $rr = mysqli_num_rows($result);
        mysqli_close($conn);

        if ($rr > 0) {
            return $name;
        } else {
            return false;
        }


    }
}

?>

