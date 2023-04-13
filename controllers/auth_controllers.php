<?php
require("../config/config.php");
$op = $_POST["action"];

if ($op == 'signup') {

    $full_name = $_POST['fullName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (empty($full_name) || !preg_match("/^[a-zA-Z ]*$/", $full_name)) {
        echo json_encode(['status' => 0, 'loc' => "fullname", 'msg' => 'Please enter a valid full name.']);
        exit;
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 0, 'loc' => "email", 'msg' => 'Please enter a valid email address.']);
        exit;
    }
    if (empty($password) || strlen($password) < 8) {
        echo json_encode(['status' => 0, 'loc' => "password", 'msg' => 'Please enter a valid password that is at least 8 characters long.']);
        exit;
    }

    // insert new user
    $q = $conn->prepare(
        'INSERT INTO `users`(`full_name`, `email`, `password`) 
         VALUES(:fullname, :email, :password)'
    );
    $q->execute([
        'fullname' => $full_name,
        'email' => $email,
        'password' => md5($password)
    ]);
    echo json_encode(['status' => 1]);
    
    exit;

}
