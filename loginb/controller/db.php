<?php

$db = null;
try{
    $db = new PDO("mysql:host=localhost;dbname=testdb;charset=utf8", 'root', 'root',[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch(Exception $e){
    echo $e->getMessage();
}