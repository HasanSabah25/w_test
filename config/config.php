<?php

define('DBHOST', 'localhost');
define('DBUSERNAME', 'root');
define('DBPASSWORD', '');
<<<<<<< HEAD
define('DBNAME', 'laven_auth_assignment');
=======
define('DBNAME', 'laven_auth_assinment');
>>>>>>> fd8bb54ea4b40bac6d725fb806396271b158ee9f

try {
    $conn = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Database Connection failed: " . $e->getMessage();
}
