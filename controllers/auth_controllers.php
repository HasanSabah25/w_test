<?php
$op=$_POST["action"];

if($op == 'signup'){

    $n = $_POST['fullName'];
    $u = $_POST['email'];
    $p = $_POST['password'];
    if(empty($n)) {
        echo json_encode(['status'=>0, 'loc'=>"fullname", 'msg'=>'pleas write you full name']);
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
