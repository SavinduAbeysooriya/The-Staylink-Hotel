<?php
require_once '../config.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tableNumber = intval($_POST['table_number']);

    try {
        $stmt = $pdo->prepare("SELECT capacity FROM tables WHERE table_number = ?");
        $stmt->execute([$tableNumber]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            echo json_encode(['capacity' => $result['capacity']]);
        } else {
            echo json_encode(['capacity' => 'Not found']);
        }
    } catch (PDOException $e) {
        echo json_encode(['capacity' => 'Error']);
    }
} else {
    echo json_encode(['capacity' => 'Invalid request']);
}
?>
