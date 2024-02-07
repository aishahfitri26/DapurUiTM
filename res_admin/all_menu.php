
<!DOCTYPE html>
<html>
<head>
	<title>Menu</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<style>
    table {
	width: 100%;
	border-collapse: collapse;
}

th, td {
	padding: 10px;
	border: 1px solid black;
}

th {
	background-color: #f2f2f2;
}

td img {
	width: 100px;
	height: 100px;
}
    </style>
<body>
<?php include 'homepage.php'; ?>
  <div class="main">
    <br>
	<h1> All Menu</h1>
	<table>
		<thead>
			<tr>
				<th>Dish Name</th>
				<th>Price</th>
				<th>Categories</th>
				<th>Description</th>
				<th>Image</th>
				<th>Date</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
    <?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "uitm_fd");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if res_id is defined and has a valid value
if (isset($_GET['res_id']) && is_numeric($_GET['res_id'])) {
  $res_id = $_GET['res_id'];

  // Query to select all menu items based on res_id and join with menu_category table
  $sql = "SELECT menu.*, menu_category.c_name FROM menu INNER JOIN menu_category ON menu.c_id = menu_category.c_id WHERE menu.res_id = $res_id";

  $result = mysqli_query($conn, $sql);

// Display each menu item in a table row
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["menu_name"] . "</td>";
        echo "<td>RM" . number_format($row["menu_price"], 2) . "</td>";
        echo "<td>" . $row["c_name"] . "</td>"; // Display category name instead of c_id
        echo "<td>" . $row["menu_description"] . "</td>";
        echo "<td><img src='../menu_images/" . $row["menu_image"] . "' alt='Image of " . $row["menu_name"] . "' width='50'></td>";
        echo "<td>" . $row["menu_date"] . "</td>";
        $menu_id = $row['menu_id'];
        echo "<td><button class='delete-btn' data-id='" . $menu_id . "'>Delete</button> <a href='update_menu.php?menu_id=" . $menu_id . "'><button class='update-btn'>Update</button></a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>No menu items found</td></tr>";
}
}
// Close the connection
$conn->close();
?>
		</tbody>
	</table>
</div>
<script>
	 // Select all delete buttons
const deleteButtons = document.querySelectorAll('.delete-btn');

// Attach a click event listener to each delete button
deleteButtons.forEach(button => {
  button.addEventListener('click', event => {
    // Show a confirmation dialog
    if (confirm('Are you sure you want to delete this restaurant?')) {
      // Your code to handle the delete button click event
      const menu_id = event.target.getAttribute('data-id');

      // Send a request to delete the restaurant
      fetch('delete_menu.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'menu_id=' + encodeURIComponent(menu_id)
      })
      .then(response => {
        // Check if the restaurant was deleted successfully
        if (response.ok) {
          // Reload the page to reflect the changes
          location.reload();
        } else {
          alert('Failed to delete the restaurant');
        }
      });
    }
  });
});
	</script>

</body>
</html>
