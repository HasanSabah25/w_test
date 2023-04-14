<?php
session_start();
require("../config/config.php");

if (isset($_POST['action']) == 'changePassword') {
    $current_password = $_POST['currentpassword'];
    $new_password = $_POST['newpassword'];

    if ($_SESSION["user"]->password != md5($current_password)) {
        echo json_encode(['status' => 0, 'loc' => "currentpassword", 'msg' => 'write correct current password']);
        exit;
    }
    if (empty($new_password) || strlen($new_password) < 8) {
        echo json_encode(['status' => 0, 'loc' => "newpassword", 'msg' => 'Please enter a valid  new password that is at least 8 character.']);
        exit;
    }

    $q = $conn->prepare('UPDATE users SET password=:password  WHERE id=:id ');
    $q->execute([
        'password' => md5($new_password),
        'id' => $_SESSION['user']->id,
    ]);
    $_SESSION["user"]->password = md5($new_password);

    echo json_encode(['status' => 1, 'loc' => "header", 'msg' => 'password changed']);
    exit;
}
