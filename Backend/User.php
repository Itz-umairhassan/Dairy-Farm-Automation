<?php

require_once('./Backend/DBConnection.php');

class User
{

    private $db;
    function __construct()
    {
        $this->db = new DataBase();
    }

    public function verify_user($email, $password)
    {
        $conn = $this->db->make_connection();

        $sql = "select * from user where email='" . $email . "' and password='" . $password . "'";

        //echo $sql;
        $result = mysqli_query($conn, $sql);
        $rr = mysqli_num_rows($result);
        mysqli_close($conn);

        if ($rr > 0) {
            $row = mysqli_fetch_assoc($result);
              $userid = $row['id'];
            return $userid;
        } else {
            return false;
        }


    }
    public function add_user($email,$password,$uname,$fname,$lname)
    {
        $conn = $this->db->make_connection();
        if($conn)
        {

        $sql = "INSERT INTO user (username, email, password) VALUES ('" . $uname . "',  '" . $email . "', '" . $password . "')";

        //echo $sql;
        mysqli_query($conn, $sql);
       
        mysqli_close($conn);
        
        return $email;
        
        } else {
            return false;
        }


    }

}

?>



