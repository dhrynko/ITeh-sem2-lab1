<?php
$dsn = "mysql:host=127.0.0.1; port=8889; dbname=iteh2lb1var7";
$user = 'root';
$pass = 'qwerty123';
try {
    $db = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    echo "Егор" . $e->getMessage();
}