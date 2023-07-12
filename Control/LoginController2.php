<?php

require_once('./Backend/User.php');

if (!empty($_REQUEST['email'])) 
{

    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];

    $user = new User();
    $id=$user->verify_user($email, $password);
    if ($id) 
    {
        http_response_code(200);
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $_SESSION['type'] = "user";
        $_SESSION['userid'] = $id;
       
    } else {
        http_response_code(400);
        echo "Wrong";
    }
} else {
    http_response_code(500);
    echo "Nothing".$_REQUEST['email'].$_REQUEST['password'];
}
?>

