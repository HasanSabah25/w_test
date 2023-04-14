<?php

$db = null;
try {
    $db = new PDO("mysql:host=localhost;dbname=laven_auth_assignment;charset=utf8", 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (Exception $e) {
    echo $e->getMessage();
}
