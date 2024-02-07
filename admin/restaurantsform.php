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

// Get form data
$res_name = $_POST['res_name'];
$res_phone = $_POST['res_phone'];
$open_hours = $_POST['open_hours'];
$open_days = $_POST['open_days'];
$res_address = $_POST['res_address'];
$res_email = $_POST['res_email'];
$close_hours = $_POST['close_hours'];
$res_image = $_FILES['res_image']['res_name'];

// Prepare an SQL statement to insert data into the database
$stmt = $conn->prepare("INSERT INTO restaurants (res_name, res_email, res_phone, open_hours, close_hours, open_days, res_address, res_image, res_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, CURDATE())");

// Check if the prepare statement was successful
if ($stmt === false) {
  echo "Error preparing statement: " . $conn->error;
} else {
  // Bind parameters to the prepared statement
  $stmt->bind_param("ssssssss", $res_name, $res_email, $res_phone, $open_hours, $close_hours, $open_days, $res_address, $res_image);

  // Execute the prepared statement
  $stmt->execute();

  // Move the uploaded image to the target directory
  move_uploaded_file($_FILES['res_image']['tmp_name'], "admin/res_images/" . $image);

  // Close the prepared statement and the connection
  $stmt->close();
  $conn->close();

  // Redirect to the restaurant list page
  header("Location: all_restaurants.php");
  exit;
}
?>