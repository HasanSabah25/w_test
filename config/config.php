<?php

define('DBHOST', 'localhost:3307');
define('DBUSERNAME', 'root');
define('DBPASSWORD', '');
define('DBNAME', 'file_upload_assignment');

try {
    $conn = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Database Connection failed: " . $e->getMessage();
}
