<?php
session_start();

// submit.php
require_once '../connection/connect.php';

// Validate and sanitize form data
$res_name = filter_var(trim($_POST['res_name']), FILTER_SANITIZE_STRING);
$res_email = filter_var(trim($_POST['res_email']), FILTER_SANITIZE_EMAIL);
$res_phone = filter_var(trim($_POST['res_phone']), FILTER_SANITIZE_NUMBER_INT);
$res_address = filter_var(trim($_POST['res_address']), FILTER_SANITIZE_STRING);
$res_date = filter_var(trim($_POST['res_date']), FILTER_SANITIZE_STRING);

if (!empty($res_name) && !empty($res_email) && !empty($res_phone) && !empty($res_address) && !empty($res_date)) {
  // Insert form data into database
  $sql = "INSERT INTO restaurants (res_name, res_email, res_phone, res_address, res_date)
  VALUES (?, ?, ?, ?, ?)";

  $stmt = $conn->prepare($sql);
  if ($stmt) {
    $stmt->bind_param("sssss", $res_name, $res_email, $res_phone, $res_address, $res_date);

    if ($stmt->execute()) {
      echo "New restaurant added successfully!";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
  } else {
    echo "Error preparing statement: " . $conn->error;
 
} } else { echo "One or more required fields are missing."; }

$conn->close(); ?>