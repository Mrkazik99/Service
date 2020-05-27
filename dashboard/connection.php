<?php
    $hostname = 'localhost';
    $dbname = "service";
    $dbuser = "root";
    $dbpasswd = "";
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8", $dbuser, $dbpasswd, [
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    echo '<script>console.log("Połączono z bazą danych.");</script>';
?>