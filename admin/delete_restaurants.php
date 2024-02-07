<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "uitm_fd";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the restaurant ID from the request
$res_id = $_POST['res_id'];

// Prepare the SQL statement to delete the restaurant
$stmt = $conn->prepare("DELETE FROM restaurants WHERE res_id=?");

// Bind the restaurant ID to the statement
$stmt->bind_param("i", $res_id);

// Execute the statement
$stmt->execute();

// Close the statement and the connection
$stmt->close();
$conn->close();
?>