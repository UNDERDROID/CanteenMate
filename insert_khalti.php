<?php
require_once 'connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $token = $_POST['token'];
    $amount = $_POST['amount'];

    // Build the query for Khalti verification
    $args = http_build_query(array(
        'token' => $token,
        'amount' => $amount
    ));

    $url = "https://khalti.com/api/v2/payment/verify/";

    // Initialize cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // Set the headers for the request
    $headers = ['Authorization: Key test_secret_key_f8982be3fd06498aa6456aa4b5099c54'];
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // Execute cURL request and get the response
    $response = curl_exec($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Decode the response
    $response_data = json_decode($response, true);

    if ($status_code == 200 && isset($response_data['idx'])) {
        // Prepare statement to insert into khalti table
        $stmt = $conn->prepare("INSERT INTO khalti (Username, Token, Amount) VALUES (?, ?, ?)");
        
        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }

        // Bind parameters
        $stmt->bind_param("sss", $username, $token, $amount);

        // Execute the statement
        if ($stmt->execute()) {
            echo "New record created successfully";

            // Prepare statement to update the orders table
            $update_stmt = $conn->prepare("DELETE FROM orders WHERE User = ?");
            
            if ($update_stmt === false) {
                die("Error preparing statement: " . $conn->error);
            }

            // Bind parameters
            $update_stmt->bind_param("s", $username);
            // Execute the statement
            if ($update_stmt->execute()) {
                echo " and payment status updated successfully.";
            } else {
                echo " but failed to update payment status: " . $update_stmt->error;
            }

            // Close the update statement
            $update_stmt->close();
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the insert statement
        $stmt->close();
    } else {
        // Payment verification failed
        echo "Payment verification failed.";
    }
}
?>
