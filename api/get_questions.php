<?php
require_once '../config/connection.php';

header('Content-Type: application/json');

try {
    if (isset($_GET['quiz_id']))  {
        $quiz_id = $_GET['quiz_id'];

        $sql = "SELECT id, question_text FROM questions WHERE quiz_id = :quiz_id";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":quiz_id",$quiz_id,PDO::PARAM_INT);
        $stmt->execute();
    
        $questions = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $questions[] = $row;
        }
        if (!$questions) {
            echo json_encode(["message" => "No questions found"]);
            exit;
        }
    
        echo json_encode([
            "message" => "success",
            "questions" => $questions
        ]);
    }

} catch (\Throwable $e) {
    echo $e;
}

