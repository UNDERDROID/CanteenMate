<?php
session_start();

// Assuming you have checked and identified a payment failure scenario
$payment_failed = true; // Placeholder for demonstration

if ($payment_failed) {
  // Display alert and redirect
  echo '<script>alert("Payment failed. Your orders will not be processed.");';
  echo 'window.location.href = "../myOrders.php";</script>';
  exit(); // Stop further PHP script execution
}
?>

