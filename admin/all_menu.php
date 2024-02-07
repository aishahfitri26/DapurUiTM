<?php
// Create database connection
$conn = new mysqli('localhost', 'root', '', 'uitm_fd');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch all records from the menu table and join with the restaurant and menu_category tables
$sql = "SELECT menu.*, menu_category.c_name, restaurants.res_name FROM menu INNER JOIN menu_category ON menu.c_id = menu_category.c_id INNER JOIN restaurants ON menu.res_id = restaurants.res_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Menu</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
			border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
<?php include 'homepage.php'; ?>
  <div class="main">
	<br>
    <div>
        <table>
            <thead>
                <tr>
                    <th>Menu Name</th>
                    <th>Menu Price</th>
                    <th>Category</th>
                    <th>Restaurant</th>
                    <th>Menu Description</th>
                    <th>Menu Image</th>
                    <th>Menu Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["menu_name"] . "</td>";
                        echo "<td>RM" . number_format($row["menu_price"], 2) . "</td>";
                        echo "<td>" . $row["c_name"] . "</td>"; // Display category name instead of c_id
                        echo "<td>" . $row["res_name"] . "</td>"; // Display restaurant name instead of res_id
                        echo "<td>" . $row["menu_description"] . "</td>";
                        echo "<td><img src='../menu_images/" . $row["menu_image"] . "' alt='Image of " . $row["menu_name"] . "' width='50'></td>";
                        echo "<td>" . $row["menu_date"] . "</td>";
                        $menu_id = $row['menu_id'];
                        echo "<td><button class='delete-btn' data-id='" . $menu_id . "'>Delete</button> <a href='update_menu.php?menu_id=" . $menu_id . "'><button class='update-btn'>Update</button></a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No menu items found</td></tr>";
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
</div>
</body>
</html>
