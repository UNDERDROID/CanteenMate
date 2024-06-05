<?php require_once('../connection.php'); 
session_start();
$User = $_SESSION['username'];
$query = "DELETE FROM orders WHERE User = '$User'";

$run = mysqli_query($conn,$query); 

if ($run) {
	header("Location: ../myOrders.php"); // Redirect back to your page
} else {
	// Handle the deletion error
	echo "Error deleting orders: " . $conn->error;
}


?>
