<?php
require '../config/config.php';

$action = $_POST['action'];

if ($action == 'login') {

    $email = $_POST['email'];
    $password = md5($_POST['password']);
    if (empty($email)) {
        echo json_encode(['status' => 0, 'msg' => 'Username or Password is wrong']);
    }
    try {
        // check for user in database
        $checkUser = $conn->prepare(
            "SELECT id, name, email,phone_number,profile_img
             FROM users
             WHERE email = :email AND password = :password"
        );
        $checkUser->execute([
            'email' => $email,
            'password' => $password
        ]);

        $user = $checkUser->fetch(PDO::FETCH_OBJ);

        if (!empty($user)) {

            session_start();
            $_SESSION['user'] = $user;
            echo json_encode(['status' => 1, 'data' => []]);
        } else {
            echo json_encode(['status' => 0, 'msg' => 'Username or Password is wrong']);
        }
    } catch (PDOException $e) {
        // echo json_encode(['status' => 100, 'msg' => $e->getMessage()]);
    }
}

$op = $_POST["action"];

if ($op == 'signup') {

    $full_name = $_POST['fullName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (empty(($full_name)) && empty(($email)) && empty(($password))) {
        echo json_encode([
            'status' => 0,
            'msg' => "All fields are required"
        ]);
        exit;
    }
    if (!preg_match("/^[a-zA-Z ]*$/", $full_name)) {
        echo json_encode(['status' => 0, 'loc' => "fullname", 'msg' => 'Please enter a valid full name.']);
        exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 0, 'loc' => "email", 'msg' => 'Please enter a valid email address.']);
        exit;
    }
    if (strlen($password) < 8) {
        echo json_encode(['status' => 0, 'loc' => "password", 'msg' => 'Please enter a valid password that is at least 8 character']);
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
