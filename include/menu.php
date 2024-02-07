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

// Retrieve image information from the database
$sql = "SELECT * FROM menu LIMIT 6";
$result = $conn->query($sql);

$dishes = [];
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $dishes[] = $row;
  }
} else {
  echo "0 results";
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="css/menu.css">
</head>
<body>
	<div class="card-container">
		<?php foreach ($dishes as $dish): ?>
		<div class="card">
			<img src="menu_images/<?php echo $dish['menu_image']; ?>" alt="Dish Image">
			<h2><?php echo $dish['menu_name']; ?></h2>
			<p><?php echo $dish['menu_description']; ?></p>
			<button onclick="location.href='dish.php?res_id=<?php echo $dish['res_id']; ?>';">Order Now</button>
		</div>
		<?php endforeach; ?>
	</div>
</body>
</html>