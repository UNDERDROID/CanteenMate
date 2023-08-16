<?php


include("navbar.php");
$User = $_SESSION['username'];
require_once 'connection.php';

// Prepare the SQL statement to retrieve the orders
$sql = "SELECT `Order No.`, `Item Name`, `Item Price`, `Quantity`, `Total Price`, `Ordered Time`
FROM `orders`
WHERE `User` = '$User' ORDER BY `Order No.` ASC";

// Execute the statement and store the result set
$result = $conn->query($sql);

// Check if there are any orders
if ($result->num_rows > 0) {
    // Loop through each order and display it in the table
    $total_price = 0;
    
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <style>
                body{
                background-color: #2CD250;
                }
                table {
                border-collapse: collapse;
                width: 100%;
                background-color: white;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                }
                th, td {
                text-align: left;
                padding: 8px;
                }
                tr:nth-child(even)
                {
                background-color: #f2f2f2;
                }
                h3{
                font-size: 20px;
                color: white;
                text-shadow: 2px 2px gray;

                }
            </style>
        </head>
        <body>
    <table>
        <tr>
            <th>Order No.</th>
            <th>Item Name</th>
            <th>Item Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Ordered Time</th>
        </tr>    
        <?php
        while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["Order No."] . "</td>";
        echo "<td>" . $row["Item Name"] . "</td>";
        echo "<td>Rs. " . $row["Item Price"] . "</td>";
        echo "<td>" . $row["Quantity"] . "</td>";
        echo "<td>Rs. " . number_format(intval($row["Total Price"]), 2) . "</td>";
        echo "<td>" . $row["Ordered Time"] . "</td>";
        echo "</tr>";
        $total_price += floatval($row["Total Price"]);
        }
        ?>
    

     </table> 
     <?php
    echo "<h3>Total Price: Rs. " . number_format($total_price, 2) . "</h3>";
    ?>
        </body>
        </html>
<?php
    
} else {
    // Display a message if there are no orders
    echo "<tr><td colspan='6'>No orders found.</td></tr>";
}

// Close the result set and the database connection
$result->close();
$conn->close();
?>