<?php

require_once('./Backend/DBConnection.php');

class Admin
{

    private $db;
    function __construct()
    {
        $this->db = new DataBase();
    }

    public function verify_user($email, $password)
    {
        $conn = $this->db->make_connection();

        $sql = "select * from admin where email='" . $email . "' and password='" . $password . "'";

        //echo $sql;
        $result = mysqli_query($conn, $sql);
        $rr = mysqli_num_rows($result);
        mysqli_close($conn);

        if ($rr > 0) {
            return $email;
        } else {
            return false;
        }


    }
}

?>

