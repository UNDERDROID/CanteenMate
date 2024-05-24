// updateStatus.php
require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'])) {
    $selectedUsername = $_POST['username'];

    // Your existing code to toggle the status goes here

    // Fetch and return the updated status
    $checkSql = "SELECT `Status` FROM `orders` WHERE `User` = '$selectedUsername'";
    $checkResult = mysqli_query($conn, $checkSql);

    if ($checkResult) {
        $row = mysqli_fetch_assoc($checkResult);
        $currentStatus = $row['Status'];
        echo $currentStatus;
    } else {
        echo "Error fetching status";
    }
} else {
    echo "Invalid request";
}
