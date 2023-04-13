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
