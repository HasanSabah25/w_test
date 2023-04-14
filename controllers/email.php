<?php
require('../config/config.php');

session_start();

if (isset($_POST['action']) && $_POST['action'] == 'forget') {
    $email = $_POST['email'];

    if (empty($email)) {
        echo json_encode(['state' => false, 'loc' => "email", 'message' => 'email is required.']);
        exit;
    }

    try {
        // check for user in database
        $q = $conn->prepare(
            'SELECT * FROM users WHERE email = :email'
        );
        $q->execute([
            'email' =>  $email,
        ]);
        $user = $q->fetch(PDO::FETCH_OBJ);

        if (!empty($user)) {

            $code = md5(random_bytes(16));

            // create file with code and redirect to reset.php
            $filename = '../reset_codes/' . $user->id . '.txt';
            // $content = "Code: $code\n";
            $content = "Link: http://localhost/Laven_Hussein/reset.php\n";
            file_put_contents($filename, $content);

            $q = $conn->prepare(
                'UPDATE  users SET reset_password_code = :code WHERE id =:id'
            );
            $q->execute([
                'code' =>  $code,
                'id' => $user->id,
            ]);

            $_SESSION['reset_code'] = $code;

            echo json_encode(['state' => true, 'message' => "Email sent successfully go check your email."]);
        } else {
            echo json_encode(['state' => false, 'loc' => "email", 'message' => 'Please enter a valid email address.']);
        }
    } catch (PDOException $e) {
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'reset') {
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $code = $_SESSION['reset_code'];

    if ($password != $confirmPassword) {
        echo json_encode(['state' => false, 'loc' => "confirmpassword", 'message' => 'write correct current password']);
        exit;
    }

    if (empty($password) || empty($confirmPassword)) {
        echo json_encode(['state' => false, 'loc' => "header", 'message' => 'Please fill the fields.']);
        exit;
    }
    if (strlen($password) < 8) {
        echo json_encode(['state' => false, 'loc' => "password", 'message' => 'Please enter a valid password that is at least 8 character.']);
        exit;
    }

    $q = $conn->prepare('UPDATE users SET password=:password  WHERE reset_password_code=:code ');
    $q->execute([
        'password' => md5($password),
        'code' => $code,
    ]);

    echo json_encode(['state' => true, 'loc' => "header", 'message' => 'password changed']);
    exit;
}
