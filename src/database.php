<?php
    $server = "db";
    $database = "incidents";
    $user = "user";
    $password = "password";

    try {
        $conn = new PDO("mysql:host=$server;dbname=$database", $user, $password);
    } catch(PDOException $e) {
        echo "Exception appeared : " . $e->getMessage();
    }
?>