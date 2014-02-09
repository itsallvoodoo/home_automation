<?php
    require '../includes/db_secure_connect.php';
    require '../includes/functions.php';
 
sec_session_start(); // Our custom secure way of starting a PHP session.
 
if (isset($_POST['email'], $_POST['p'])) {
    $email = $_POST['email'];
    $password = $_POST['p']; // The hashed password.
    
    var test = login($email, $password, $mysqli);
    if (test == "passed") { // true ------------------------------------------
        // Login success 
        header('Location: /index.php');
    } else {
        // Login failed 
        header('Location: /index.php?error=' + test);
    }
} else {
    // The correct POST variables were not sent to this page. 
    echo 'Invalid Request';
}