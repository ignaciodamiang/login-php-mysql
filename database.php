<?php
$server = 'localhost';
$username = 'your_username';
$password = 'your_password';
$database = 'login-php-mysql';

try {
    $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $error){
    die('Connection failed: '.$error->getMessage());
}
