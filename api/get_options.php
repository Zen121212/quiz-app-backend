<?php
require_once '../config/connection.php';

header('Content-Type: application/json');

try {
    if(isset($_GET['question_id'])){
        $_GET['question_id'];

        $sql = "SELECT id, option_text, is_correct FROM options WHERE question_id = :question_id";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":question_id",$question_id,PDO::PARAM_INT);
        $stmt->execute();
    
        $options = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $question[] = $row; 
        }

        if (!$options) {
            echo json_encode(["message" => "No options found"]);
            exit;
        }
    
        echo json_encode([
            "message" => "success",
            "options" => $options
        ]);
    }
} catch (\Throwable $e) {
    echo $e;
}
