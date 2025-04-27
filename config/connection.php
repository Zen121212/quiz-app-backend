<?php
$host = 'localhost:3306';
$port = 3306;
$db = 'quiz_db';
$user = 'root';
$pass = 'root';

try {
    $connection = new PDO("mysql:host=$host;port=$port;dbname=$db", $user, $pass);
} catch (\Throwable $e) {
    echo $e;
}
