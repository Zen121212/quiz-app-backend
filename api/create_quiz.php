<?php
require_once '../config/connection.php';

header('Content-Type: application/json');

try{
    if(isset($_POST['title'], $_POST['description'])){
        $title = $_POST['title'];
        $description = $_POST['description'];

        $sql = "INSERT INTO quizzes (title, description) VALUES (:title, :description)";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":title", $title, PDO::PARAM_STR);
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Quiz created successfully"]);
        } else {
            echo json_encode(["message" => "Failed to create quiz"]);
        }

    }else {
        echo json_encode(["message" => "Missing required fields"]);
    }
} catch (\Throwable $e) {
    echo $e;
}
