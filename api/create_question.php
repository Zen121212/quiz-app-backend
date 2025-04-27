<?php
require_once '../config/connection.php';

header('Content-Type: application/json');


try {
    if(isset($_POST['quiz_id'], $_POST['question_text'])){
        $quiz_id = $_POST['quiz_id'];
        $question_text = $_POST['question_text'];

        $sql = "INSERT INTO questions (quiz_id, question_text) VALUES (:quiz_id, :question_text)";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":quiz_id", $quiz_id, PDO::PARAM_INT);
        $stmt->bindParam(":question_text", $question_text, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Question added successfully"]);
        } else {
            echo json_encode(["message" => "Failed to add question"]);
        }

    }else {
        echo json_encode(["message" => "Missing required fields"]);
    }
} catch (\Throwable $e) {
    echo $e;
}
