<?php
require_once '../config/connection.php';

header('Content-Type: application/json');


try{
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        
        $checkSql = "SELECT COUNT(*) FROM quizzes WHERE id = :id";
        $checkStmt = $connection->prepare($checkSql);
        $checkStmt->bindParam(":id",$id,PDO::PARAM_INT);
        $checkStmt->execute();
        $quizExists = $checkStmt->fetchColumn();
        
        if ($quizExists > 0) {
            $sql = "DELETE FROM quizzes WHERE id = :id";
            $stmt = $connection->prepare($sql);
            $stmt->bindParam(":id",$id,PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo json_encode(["message" => "Quiz deleted"]);
            } 

        } else {
            echo json_encode(["message" => "Quiz not found"]);
        }
    }
    else {
        echo json_encode(["message" => "Missing required fields"]);
    }
} catch (\Throwable $e) {
    echo $e;
}
