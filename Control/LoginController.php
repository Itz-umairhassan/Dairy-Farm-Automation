<?php

require_once('./Backend/Admin.php');
if (!empty($_REQUEST['email'])) {

    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];

    $admin = new Admin();

    if ($admin->verify_user($email, $password)) {
        http_response_code(200);
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $_SESSION['type'] = "admin";

        echo "Correct";
    } else {
        http_response_code(400);
        echo "Wrong";
    }
} else {
    http_response_code(500);
    echo "Nothing";
}
?>

