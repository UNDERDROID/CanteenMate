<?php
session_start();
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    $itemName = $_POST['itemName'];
    $user = $_SESSION['username'];

    if ($action == 'update') {
        $newQuantity = $_POST['quantity'];
        
        // Get the item price
        $sqlPrice = "SELECT `Item Price` FROM `orders` WHERE `User` = ? AND `Item Name` = ?";
        $stmtPrice = $conn->prepare($sqlPrice);
        $stmtPrice->bind_param("ss", $user, $itemName);
        $stmtPrice->execute();
        $resultPrice = $stmtPrice->get_result();
        $rowPrice = $resultPrice->fetch_assoc();
        $itemPrice = $rowPrice['Item Price'];

        // Calculate new total
        $newTotal = $itemPrice * $newQuantity;

        echo "Updating: Quantity = $newQuantity, Total Price = $newTotal, User = $user, Item Name = $itemName";
        // Update the order
        $sql = "UPDATE `orders` SET `Quantity` = ?, `Total Price` = ? WHERE `User` = ? AND `Item Name` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("idss", $newQuantity, $newTotal, $user, $itemName);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'newTotal' => $newTotal]);
        } else {
            echo json_encode(['success' => false, 'error' => $conn->error]);
        }
    } elseif ($action == 'remove') {
        // Remove the item from the order
        $sql = "DELETE FROM `orders` WHERE `User` = ? AND `Item Name` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $user, $itemName);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $conn->error]);
        }
    }
}

$conn->close();
?>