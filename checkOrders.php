<?php
session_start();
if(!isset($_SESSION['adminloggedin']) || $_SESSION['adminloggedin']!=true){
  header("location: adminLogIn.php");
  exit;
}
include_once ('adminNav.php');
require_once 'connection.php';

//DELETE
if (isset($_GET['User'])) {
    $userToDelete = $_GET['User'];

    // SQL query to delete orders for the selected user
    $query = "DELETE FROM orders WHERE User = '$userToDelete'";

    // Use prepared statement to prevent SQL injection
    $run = mysqli_query($conn,$query); 

    // Execute the delete query
    if ($run) {
        // Orders deleted successfully
        header("Location: checkOrders.php"); // Redirect back to your page
        exit();
    } else {
        // Handle the deletion error
        echo "Error deleting orders: " . $conn->error;
    }

}



// SQL query to retrieve all order details
$sql = "SELECT User, `Item Name`, `Item Price`, `Quantity`, `Total Price`, `Status` FROM orders ORDER BY User ASC";

// Execute the query
$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    // Create an associative array to store data grouped by username and initialize total sum
    $usernamesData = array();

    // Loop through the results
    while ($row = $result->fetch_assoc()) {
        $username = $row["User"];

        // Create a sub-array for the username if it doesn't exist
        if (!isset($usernamesData[$username])) {
            $usernamesData[$username] = array();
            $usernamesData[$username]['TotalSum'] = 0; // Initialize total sum
        }

        // Append the row data to the username's data array
        $usernamesData[$username][] = array(
            "Item Name" => $row["Item Name"],
            "Item Price" => $row["Item Price"],
            "Quantity" => $row["Quantity"],
            "Total Price" => $row["Total Price"],
            "Status" => $row["Status"]
        );

        // Calculate and update the total sum for the user
        $usernamesData[$username]['TotalSum'] += $row["Total Price"];
    }

    // Print tables for each unique username
    ?>
    <html>
    <head>
    <!-- <link href="orderStyle.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css"/> -->
        <style>
            
table {
  border-collapse: collapse;
  width: 100%;
  background-color: #1D2021;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
}
.DeleteButton{
    background-color:#1D2021;
    padding: 5px;
    text-decoration: none;

}
.status{
    
padding: 10px;
}
.status:hover{
cursor: pointer;
}
th{
  padding: 5px;
  text-align: center;
  /* border-bottom: 1px solid #DDD; */
  color: white;
}
td{
    text-align: center;
    padding: 1px;
    color: white;
}
tr:nth-child(even)
{
background-color: #303436;
}
tr:hover {background-color: #3e4142;}
.status{
    color:black;
}

        </style>
    </head>
    <body>
    <?php
    foreach ($usernamesData as $username => $userData) {
        echo "<h3>" . $username . "</h3>";
        echo "<a href='checkOrders.php?User=" . urlencode($username) . "' class='DeleteButton'>Delete Orders</a>";
        echo "
        <form action='#' method='POST' enctype='multipart/form-data'>
            <input type='hidden' name='username' value='" . $username . "'>
            <input type='submit' name='submit' value='Toggle Status' class='status'>
        </form>
        ";
        $run2 = false;
        $run3 = false;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['username'])) {
                $selectedUsername = $_POST['username'];
                
                
                
                // Check the current 'Status' in the database for the selected user
        $checkSql = "SELECT `Status` FROM `orders` WHERE `User` = '$selectedUsername'";
        $checkResult = mysqli_query($conn, $checkSql);

        if ($checkResult) {
            $row = mysqli_fetch_assoc($checkResult);
            $currentStatus = $row['Status'];

                if($currentStatus === 'PENDING'){
                $sql2 = "UPDATE `orders` SET `Status` = 'READY' WHERE `User` = '$selectedUsername'";
                $run2 = mysqli_query($conn, $sql2);
                }
                elseif($currentStatus === 'READY'){
                $sql3 = "UPDATE `orders` SET `Status` = 'PENDING' WHERE `User` = '$selectedUsername'";
                $run3 = mysqli_query($conn, $sql3);
                }else{
                    echo"No orders found";
                }
            }else{
                echo"query error";
            }

            }
            if ($run2) {
                header("Location: checkOrders.php"); // Redirect back to your page
                exit();
            }elseif ($run3) {
                header("Location: checkOrders.php");
                exit();
            }
            else{
                echo"Failed to update";
            }
        }
        
        echo "<table>";
        echo "<tr>";
        echo "<th>Item Name</th>";
        echo "<th>Item Price</th>";
        echo "<th>Quantity</th>";
        echo "<th>Total Price</th>";
        echo "<th>Status</th>";
        echo "</tr>";
        foreach ($userData as $row) {
            if (isset($row['Item Name'])) { // Check if it's a data row
                echo "<tr>";
                echo "<td>" . $row["Item Name"] . "</td>";
                echo "<td>" . $row["Item Price"] . "</td>";
                echo "<td>" . $row["Quantity"] . "</td>";
                echo "<td>" . $row["Total Price"] . "</td>";
                echo "<td>" . $row["Status"] . "</td>";
                echo "</tr>";
            }
        }
        echo "<tr><th colspan='3'>Total Sum:</th><th>" . $userData['TotalSum'] . "</th></tr>";
        echo "</table>";
    }
    ?>
    </body>
    </html>
    <?php
} else {
    echo "No orders found in the database.";
}

// Close the database connection
$conn->close();
?>
