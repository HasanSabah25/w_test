<?php
require 'db.php';

$op = $_POST['op'];

if($op == 'login'){
    $u = $_POST['username'];
    $p = md5($_POST['password']);
    try{
        // check for user in database
        $q = $db->prepare(
            'SELECT id, name, username
             FROM users
             WHERE username = :u AND password = :p');
        $q->execute([
            'u' => $u,
            'p' => $p
        ]);
        $user = $q->fetch(PDO::FETCH_OBJ);
       
        if(!empty($user)){
            // success: create session
            session_start();
            $_SESSION['user'] = $user;
            echo json_encode(['status'=>1, 'data'=>[]]);
        } else {
            echo json_encode(['status'=>0, 'msg'=>'Username or Password is wrong']);
        }
    } catch(PDOException $e) {
        echo json_encode(['status'=>100, 'msg'=>$e->getMessage()]);
    }
}

if($op == 'signup'){
    $n = $_POST['name'];
    $u = $_POST['username'];
    $p = $_POST['password'];
    $cp = $_POST['cpassword'];
    if($p != $cp) {
        echo json_encode(['status'=>0, 'msg'=>'Password is not match']);
        exit;
    }

    // check of username is exits
        // return user not available status

    // insert new user
    $q = $db->prepare(
        'INSERT INTO users(name, username,password)
         VALUES(:name, :username, :password)');
    $q->execute([
        'name' => $n,
        'username' => $u,
        'password' => md5($p)
    ]);
    // send status:1,0
    echo json_encode(['status'=>1, 'msg'=>'Successfully registered']);
}
