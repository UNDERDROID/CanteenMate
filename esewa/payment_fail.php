<?php

require_once('../connection.php');
session_start();
$User = $conn->real_escape_string($_SESSION['username']);
$sql = "SELECT payment_id FROM esewa WHERE Username = '$User'";
$result = $conn->query($sql);

if ($result === false) {
    die("Error executing query: " . $conn->error);
}

    while($esewa = $result->fetch_assoc()) {
        $payment_id = $esewa["payment_id"];
        $_SESSION['payment_id']=$payment_id;
    }
echo "Payment id:" . $_SESSION['payment_id'];
?>