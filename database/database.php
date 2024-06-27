<?php
    $server = 'dpg-cpurmil6l47c73fum6m0-a';
    $username = 'crud_productos_user';
    $password = 'oH9M4kXeKhqpBRvOiuNsVEw7FfRz6dXZ';
    $database = 'crud_productos';

    try {
        $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
    } catch (PDOException $e) {
        die('Connection Failed: ' . $e->getMessage());
    }
?>
