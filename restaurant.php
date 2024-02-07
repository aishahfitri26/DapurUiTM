<?php
session_start();
include "connection/connect.php";
include "include/header.php";

?>
<!DOCTYPE html>
<html>
<head>
    <style>

            body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  font-size: 15px;
}

header {
  background-color: #333;
  color: #fff;
  padding: 1rem;
}

header h1 {
  margin: 0;
}

header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px;
  background-color: #333;
  color: #fff;
}

main {
  padding: 2rem;
}

section {
  margin-bottom: 2rem;
}

article {
  padding: 1rem;
  border: 1px solid #ddd;
  margin-bottom: 1rem;
}

article h3 {
  margin-top: 0;
}

footer {
  background-color: #333;
  color: #fff;
  padding: 1rem;
  text-align: center;
  position: fixed;
  bottom: 0;
  left: 0;
  width: 100%;
}
article ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

article li {
  display: flex;
  align-items: center;
  padding: 0.5rem 0;
}

article img {
  margin-right: 1rem;
  border-radius: 50%;
}
article button {
  background-color: #4CAF50;
  color: white;
  padding: 0.5rem 1rem;
  border: none;
  border-radius: 0.25rem;
  cursor: pointer;
  margin-left: 1rem;
}

article button:hover {
  background-color: #3e8e41;
}


.restaurant-list {
  border: 1px solid #ddd;
  padding: 1rem;
  margin-bottom: 1rem;
  display: flex;
  align-items: center;
}

.restaurant-list img {
  margin-right: 1rem;
  border-radius: 50%;
}

.restaurant-list p {
  flex: 1;
}

.restaurant-list button {
  margin-left: auto;
}


.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}


.restaurant-buttonclick {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 12px;
}

.restaurant-buttonclick:hover {
  background-color: #3e8e41;
}
    </style>
</head>

<body>

<article id="restaurant">
    <h3>Restaurants</h3>

    <?php
// Database connection parameters
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

// Fetch restaurant data from the database
$sql = "SELECT * FROM restaurants";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="restaurant-list">';
        echo '<img src="res_images/' . $row['res_image'] . '" width="100" height="100">';
        echo '<p><strong>' . $row['res_name'] . '</strong></p>';
        echo '<p><strong>Address:</strong> ' . $row['res_address'] . '</p>';
        echo '<p><strong>Phone:</strong> ' . $row['res_phone'] . '</p>';
        echo '<a href="dish.php?res_id=' . $row['res_id'] . '" target="_self" class="restaurant-buttonclick">View Menu</a>';
        echo '</div>';
    }
} else {
    echo "0 results";
}

// Close the connection
$conn->close();
?>
</article>


<?php include "include/footer.php" ?>
</body>

</html>
