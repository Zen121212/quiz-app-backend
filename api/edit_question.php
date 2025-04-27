<?php
require_once '../config/connection.php';

header('Content-Type: application/json');

try{
    if(isset($_POST['id'], $_POST['question_text'])){
        $id = $_POST['id'];
        $question_text = $_POST['question_text'];

        $sql = "UPDATE questions SET question_text = :question_text WHERE id = :id";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":question_text", $question_text, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Question updated"]);
        } else {
            echo json_encode(["message" => "Update failed"]);
        }

    }else {
        echo json_encode(["message" => "Missing required fields"]);
    }
} catch (\Throwable $e) {
    echo $e;
}
