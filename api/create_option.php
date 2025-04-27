<?php
require_once '../config/connection.php';

header('Content-Type: application/json');

try {
    if(isset($_POST['question_id'], $_POST['option_text'])){
        $question_id = $_POST['question_id'];
        $option_text = $_POST['option_text'];

        $is_correct = (isset($_POST['is_correct']) && $_POST['is_correct'] === '1') ? 1 : 0;

        $sql = "INSERT INTO options (question_id, option_text, is_correct) VALUES (:question_id, :option_text, :is_correct)";
        $stmt = $connection->prepare($sql);

        $stmt->bindParam(":question_id", $question_id, PDO::PARAM_INT);
        $stmt->bindParam(":option_text", $option_text, PDO::PARAM_STR);
        $stmt->bindParam(":is_correct", $is_correct, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Option added successfully"]);
        } else {
            echo json_encode(["message" => "Failed to add option"]);
        }
    }
    else {
        echo json_encode(["message" => "Missing required fields"]);
    }
} catch (\Throwable $e) {
    echo $e;
}
