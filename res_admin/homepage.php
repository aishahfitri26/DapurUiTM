<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/sidenav.css">
<style>
</style>
</head>
<body>
<div class="header">
<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "uitm_fd";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the restaurant ID from the URL parameter
$restaurantId = isset($_GET['res_id']) ? intval($_GET['res_id']) : 1;

// Fetch the restaurant name from the database
$sql = "SELECT res_name FROM restaurants WHERE res_id = $restaurantId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Output the restaurant name in the header
  while($row = $result->fetch_assoc()) {
    echo "<span>" . $row["res_name"] . "</span>";
  }
} else {
  echo "<span>My Company</span>";
}

// Close the database connection
$conn->close();
?>

  <a href="logout.php" class="logout-button">Logout</a>
</div>

<div class="sidenav">
<a href="adminpage.php?res_id=<?php echo $restaurantId; ?>">Home</a>
<a href="update_restaurant.php?res_id=<?php echo $restaurantId; ?>">Restaurant Profile</a>
<button class="dropdown-btn">Menu
  <i class="fa fa-caret-down"></i>
</button>
<div class="dropdown-container">
  <a href="all_menu.php?res_id=<?php echo $restaurantId; ?>">All Menu</a>
  <a href="add_menu.php?res_id=<?php echo $restaurantId; ?>">Add Menu</a>
</div>
<a href="all_orders.php?res_id=<?php echo $restaurantId; ?>">Orders</a>
</div>


<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}
</script>

</body>
</html>