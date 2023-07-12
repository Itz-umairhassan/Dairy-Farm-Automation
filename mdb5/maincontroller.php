<?php

session_start();

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  
switch ($path) {
    case '/mdb5/':
        include './login.php';
        break;
    case './login/verify':
        include './LoginController.php';
        break;
   
    }