<?php
require_once '../config/connection.php';

header('Content-Type: application/json');

try {
    $sql = "SELECT * FROM quizzes";
    $stmt = $connection->prepare($sql);
    $stmt->execute();

    $quizzes = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $quizzes[] = $row;
    }

    if (!$quizzes) {
        echo json_encode(["message" => "No quizzes found"]);
        exit;
    }

    echo json_encode([
        "message" => "success",
        "options" => $quizzes
    ]);

} catch (\Throwable $e) {
    echo $e;
}

