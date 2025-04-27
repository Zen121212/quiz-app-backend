<?php

require_once '../config/connection.php';

header('Content-Type: application/json');

try {
    if(isset($_POST['email']) && isset($_POST['password'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":email",$email,PDO::PARAM_STR_CHAR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                echo json_encode(["message" => "Login successful", "user" => $user]);
            } else {
                echo json_encode(["message" => "Invalid password"]);
            }
        } else {
            echo json_encode(["message" => "Invalid email"]);
        }
    }else {
        echo json_encode(["message" => "Missing required fields"]);
    }
} catch (\Throwable $e) {
    echo $e;
}
