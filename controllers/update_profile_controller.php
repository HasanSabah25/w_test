<?php
session_start();
require("../config/config.php");

if (isset($_POST['action']) == "update_profile") {

    $full_name = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // 
    if (empty($full_name) && empty($email)) {
        echo json_encode(['status' => 0, 'loc' => "all", 'msg' => ' Required']);
        exit;
    }
    if (empty($full_name) || !preg_match("/^[a-zA-Z ]*$/", $full_name)) {
        echo json_encode(['status' => 0, 'loc' => "fullname", 'msg' => 'Please enter a valid full name.']);
        exit;
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 0, 'loc' => "email", 'msg' => 'Please enter a valid email address.']);
        exit;
    }

    $imagePath = $_SESSION['user']->profile_img;
    if ($_FILES["formFile"]) {
        $file_data = $_FILES["formFile"];
        $filename = basename($file_data["name"]);
        $uploadPath = '../uploads/' . $filename;
        if (move_uploaded_file($file_data["tmp_name"], $uploadPath)) {
            $imagePath = 'uploads/' . $filename;
            // if Session img path != asser/ing/default-img.png => delete the file in this path
        }
    }

    $q = $conn->prepare('UPDATE users SET full_name=:full_name, email=:email, phone_number=:phone_number, profile_img=:profile_img  WHERE id=:id ');
    $q->execute([
        'full_name' => $full_name,
        'email' =>  $email,
        'phone_number' => $phone,
        'profile_img' => $imagePath,
        'id' => $_SESSION['user']->id,
    ]);

    $q = $conn->prepare('SELECT * FROM users WHERE id=:id');
    $q->execute([
        'id' => $_SESSION['user']->id,
    ]);
    $_SESSION['user'] = $q->fetch(PDO::FETCH_OBJ);

    echo json_encode(['status' => 1, 'loc' => "header", 'msg' => 'Profile updated']);
    exit;
}
