<?php
require '../config/config.php';
session_start();

$action = $_POST['action'];

if ($action == 'login') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) && empty($password)) {
        echo json_encode(['state' => false, 'loc' => "all", 'emailmessage' => 'email is required', 'passwordmessage' => 'password is required']);
        exit;
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['state' => false, 'loc' => "email", 'message' => 'Please enter a valid email address.']);
        exit;
    }
    if (empty($password) || strlen($password) < 8) {
        echo json_encode(['state' => false, 'loc' => "password", 'message' => 'Please enter a valid password that is at least 8 character.']);
        exit;
    }
    try {
        // check for user in database
        $q = $conn->prepare(
            'SELECT * FROM users WHERE email = :email AND password = :password'
        );
        $q->execute([
            'email' =>  $email,
            'password' => md5($password)
        ]);
        $user = $q->fetch(PDO::FETCH_OBJ);

        if (!empty($user)) {
           
            $_SESSION['user'] = $user;

            echo json_encode(['state' => true, 'message' => "successfull"]);
        } else {
            echo json_encode(['state' => false, 'loc' => "email", 'message' => 'email or Password is wrong.']);
        }
    } catch (PDOException $e) {
    }
}


// signup
if ($action == 'signup') {

    $full_name = $_POST['fullName'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $checkExistingEmail = $conn->prepare(
        "SELECT email FROM users
         WHERE email = :email"
    );
    $checkExistingEmail->execute([
        'email' => $email,
    ]);
    if (empty(($full_name)) && empty(($email)) && empty(($password))) {
        echo json_encode([
            'state' => false,
            'message' => "All fields are required"
        ]);
        exit;
    }
    if (!preg_match("/^[a-zA-Z ]*$/", $full_name)) {
        echo json_encode(['state' => false, 'loc' => "fullname", 'message' => 'Please enter a valid full name.']);
        exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['state' => false, 'loc' => "email", 'message' => 'Please enter a valid email address.']);
        exit;
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && $checkExistingEmail->fetch(PDO::FETCH_ASSOC)) {
        echo json_encode(['state' => false, 'loc' => "email", 'message' => 'This email is already taken']);
        exit;
    }
    if (strlen($password) < 8) {
        echo json_encode(['state' => false, 'loc' => "password", 'message' => 'Please enter a valid password that is at least 8 character']);
        exit;
    }

    // insert new user
    $query = $conn->prepare(
        'INSERT INTO `users`(`full_name`, `email`, `password`) 
         VALUES(:fullname, :email, :password)'
    );
    $query->execute([
        'fullname' => $full_name,
        'email' => $email,
        'password' => md5($password)
    ]);
    echo json_encode(['state' => true, 'message' => 'Account created successfully']);

    exit;
}

if ($action == 'logout') {
   
    unset($_SESSION['user']);
    session_destroy();
    header('Location: ../login.php');
}
