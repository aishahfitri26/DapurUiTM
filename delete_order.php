<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "uitm_fd";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the order ID from the request
$order_id = $_POST['order_id'];

// Delete the order
$sql = "DELETE FROM orders WHERE order_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $order_id);

if ($stmt->execute()) {
    // Order deleted successfully
    http_response_code(200);
} else {
    // Failed to delete the order
    http_response_code(500);
}

$stmt->close();
$conn->close();
?>