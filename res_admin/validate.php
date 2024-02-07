<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "uitm_fd");

// Check for errors
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the username and password from the form
$username = $_POST["res_username"];
$password = $_POST["res_password"];

// Secure the data by escaping characters that could break the SQL query
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);

// Check if the username and password match a record in the restaurants table
$sql = "SELECT res_id FROM restaurants WHERE res_username = '$username' AND res_password = '$password'";
$result = mysqli_query($conn, $sql);

// If a match was found, retrieve the res_id and create a unique URL
if (mysqli_num_rows($result) > 0) {
    $restaurant = mysqli_fetch_assoc($result);
    $restaurantId = $restaurant["res_id"];
    header("Location: adminpage.php?res_id=$restaurantId");
} else {
    // If no match was found, display an error message
    echo "Invalid username or password.";
}

// Close the database connection
mysqli_close($conn);
?>