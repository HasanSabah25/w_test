<?php


try {
    $conn = new PDO("mysql:host=localhost:3307;dbname=laven_auth_assignment;charset=utf8", 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (Exception $e) {
    echo $e->getMessage();
}
