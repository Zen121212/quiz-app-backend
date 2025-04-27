<?php
require_once '../config/connection.php';

header('Content-Type: application/json');

try{
    if(isset($_POST['id'], $_POST['title'], $_POST['description'])){
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];

        $sql = "UPDATE quizzes SET title = :title, description = :description WHERE id = :id";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":title", $title, PDO::PARAM_STR);
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Quiz updated"]);
        } else {
            echo json_encode(["message" => "Update failed"]);
        }

    }else {
        echo json_encode(["message" => "Missing required fields"]);
    }
} catch (\Throwable $e) {
    echo $e;
}
