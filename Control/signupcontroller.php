<?php

require_once('./Backend/User.php');

if (!empty($_REQUEST['email'])) 
{

    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $uname=$_REQUEST['uname'];
    $fname = $_REQUEST['fname'];
    $lnaem=$_REQUEST['lname'];
    $user = new User();

    if ($user->add_user($email, $password,$uname,$fname,$lname)) {
        http_response_code(200);
       
        
    

        echo "Correct";
    } else {
        http_response_code(400);
        echo "Wrong";
    }
} else {
    http_response_code(500);
    echo "Nothing".$_REQUEST['email'].$_REQUEST['password'];
}
?>

