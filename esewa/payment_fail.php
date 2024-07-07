<?php
require_once('../connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    $username = $_SESSION['username'];
    $pid = $username . time();
    $amount = $_SESSION['total_price'];

    // SQL statement to insert or update the amount if the username already exists
    $sql = "INSERT INTO esewa (Username, payment_id, amount, Time) VALUES (?, ?, ?, current_timestamp())
            ON DUPLICATE KEY UPDATE payment_id = VALUES(payment_id), amount = VALUES(amount), Time = current_timestamp()";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("ssd", $username, $pid, $amount);

    if ($stmt->execute()) {
        echo "<script>alert('Order Id updated'); window.location='myOrders.php';</script>";
    } else {
        echo "Error: " . htmlspecialchars($stmt->error);
    }

    $stmt->close();
}
?>