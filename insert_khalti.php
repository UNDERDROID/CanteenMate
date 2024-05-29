<?php
require_once 'connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $token = $_POST['token'];
        $amount = $_POST['amount'];

        // Prepare statement
        $stmt = $conn->prepare("INSERT INTO khalti (Username, Token, Amount) VALUES (?, ?, ?)");
        
        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }
    
        // Bind parameters
        $stmt->bind_param("sss", $username, $token, $amount);
    
        // Execute the statement
        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
    
        // Close statement
        $stmt->close();
    }
    