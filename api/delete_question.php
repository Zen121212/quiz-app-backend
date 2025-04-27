<?php
require_once '../config/connection.php';

header('Content-Type: application/json');

try{
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "DELETE FROM questions WHERE id = :id";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo json_encode(["message" => "Question deleted"]);
        } else {
            echo json_encode(["message" => "Delete failed"]);
        }

    }
    else {
        echo json_encode(["message" => "Missing required fields"]);
    }
} catch (\Throwable $e) {
    echo $e;
}
