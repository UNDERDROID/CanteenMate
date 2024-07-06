

<?php
session_start();
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Get the item name, item price, and quantity from the form submission
    $item_name = $_POST['item_name'];
    $item_price = $_POST['item_price'];
    $quantity = $_POST['quantity'];
    $total_price = $item_price * $quantity;
    $User = $_SESSION['username'];

    // Do something with the values (e.g. add them to a database, calculate a total price, etc.)
    // ...
    require_once 'connection.php';
   
        // Prepare the SQL statement with placeholders
        $stmt = $conn->prepare("INSERT INTO orders (`Item Name`, `Item Price`, `Quantity`, `Total Price`, `Ordered Time`, `User`) VALUES (?, ?, ?, ?, current_timestamp(),?)");

        // Bind the parameters to the placeholders
        $stmt->bind_param("sddds", $item_name, $item_price, $quantity, $total_price,$User);

        // Execute the statement
    if ($stmt->execute()) {

        $pid = $username . time();
        $amount = $total_price;
    
        // SQL statement to insert or update the amount if the username already exists
        $sql = "INSERT INTO esewa (Username, payment_id, amount, Time) VALUES (?, ?, ?, current_timestamp())
                ON DUPLICATE KEY UPDATE payment_id = VALUES(payment_id), amount = VALUES(amount), Time = current_timestamp()";
    
        $stmt2 = $conn->prepare($sql);
        if ($stmt2 === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }
    
        $stmt2->bind_param("ssd", $User, $pid, $amount);
    
        if ($stmt2->execute()) {
            echo "<script>alert('Order confirmed'); window.location='myOrders.php';</script>";
        } else {
            echo "Error: " . htmlspecialchars($stmt2->error);
        }
        // echo "<script>alert('Order placed successfully! Item Name: $item_name, Item Price: Rs.$item_price, Quantity: $quantity, Total Price: Rs." . number_format($total_price, 2) . "');
        // window.location='index.php';
        // </script>";
        
        
    } else {
        echo "Error placing order: " . $stmt->error;
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
}
?>
