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

// Check if form data was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $order_id = $_POST['order_id'];
  $status = $_POST['status'];

  $sql = "UPDATE orders SET status = '$status' WHERE order_id = $order_id";

  if ($conn->query($sql) === TRUE) {
    echo "Order status updated successfully";
  } else {
    echo "Error updating order status: " . $conn->error;
  }
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Order</title>
    <style>
   form {
  width: 300px;
  margin: 0 auto;
}

label {
  display: block;
  margin-top: 20px;
}

input[type="number"], select {
  width: 100%;
  padding: 5px;
  margin-top: 5px;
}

input[type="submit"] {
  margin-top: 20px;
}
      </style>
      <body>
      <?php include 'homepage.php'; ?>
  <div class="main">
      <form action=".php" method="post">
  <label for="order_id">Order ID:</label><br>
  <input type="number" id="order_id" name="order_id" required><br>
  <label for="status">New Status:</label><br>
  <select id="status" name="status" required>
    <option value="pending">Pending</option>
    <option value="in_progress">In Progress</option>
    <option value="completed">Completed</option>
  </select><br>
  <input type="submit" value="Update Status">
</form>
</div>
</body>
</html>