<?php
require_once '../config/connection.php';

header('Content-Type: application/json');

try {
    if(isset($_POST['name'], $_POST['last_name'], $_POST['email'], $_POST['password'])){
        $name = $_POST['name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // check if email already exists
        $checkSql = "SELECT id FROM users WHERE email = :email";
        $checkStmt = $connection->prepare($checkSql);
        $checkStmt->bindParam(":email", $email, PDO::PARAM_STR);
        $checkStmt->execute();

        if ($checkStmt->fetch()) {
            echo json_encode(["message" => "Email already registered"]);
            exit;
        }

        // hashing the password for security 
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // handling if is_admin
        $is_admin = (isset($_POST['is_admin']) && $_POST['is_admin'] === '1') ? 1 : 0;

        $sql = "INSERT INTO users (name, last_name, email, password, is_admin) VALUES (:name, :last_name, :email, :password, :is_admin)";
        $stmt = $connection->prepare($sql);
        
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":last_name", $last_name, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":password", $hashed_password, PDO::PARAM_STR);
        $stmt->bindParam(":is_admin", $is_admin, PDO::PARAM_INT);
        
        $stmt->execute();
    
        echo json_encode(["message" => "User registered successfully"]);
    } else {
        echo json_encode(["message" => "Missing required fields"]);
    }
} catch (\Throwable $e) {
    echo $e;
}


