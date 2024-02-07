<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <title>All Restaurants</title>
</head>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    table {
      border-collapse: collapse;
      width: 10%;
    }

    th, td {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    th {
      background-color: #f2f2f2;
    }
    .sidenav { width: 250px; float: left; } .main { margin-left: 250px; }
  </style>
</head>
<body>
  <?php include 'homepage.php'; ?>
  <div class="main">
    <h2>All Restaurants</h2>

    <table>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Username</th>
    <th>Password</th>
    <th>Phone</th>
    <th>Address</th>
    <th>Open Hours</th>
    <th>Close Hours</th>
    <th>Open Days</th>
    <th>Image</th>
    <th>Date</th>
    <th>Action</th>
  </tr>
  <?php
    // Your PHP code to fetch data from the database
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

    // Query to get all restaurants
    $sql = "SELECT * FROM restaurants";
    $result = $conn->query($sql);

    // Display restaurants
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["res_id"]. "</td>";
            echo "<td>" . $row["res_name"]. "</td>";
            echo "<td>" . $row["res_email"]. "</td>";
            echo "<td>" . $row["res_username"]. "</td>";
            echo "<td>******</td>"; // Hide password
            echo "<td>" . $row["res_phone"]. "</td>";
            echo "<td>" . $row["res_address"]. "</td>";
            echo "<td>" . $row["open_hours"]. "</td>";
            echo "<td>" . $row["close_hours"]. "</td>";
            echo "<td>" . $row["open_days"]. "</td>";
            echo "<td><img src='res_images/" . $row["res_image"] . "' alt='Image of " . $row["res_name"] . "' width='50'></td>";
            echo "<td>" . $row["res_date"]. "</td>";
            $res_id = $row['res_id'];
            echo "<td><button class='delete-btn' data-id='" . $res_id . "'>Delete</button> <a href='update_restaurant.php?res_id=" . $res_id . "'><button class='update-btn'>Update</button></a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='11'>No restaurants found</td></tr>";
    }

    $conn->close();
  ?>
</table>
    </table>
    <script>
   // Select all delete buttons
const deleteButtons = document.querySelectorAll('.delete-btn');

// Attach a click event listener to each delete button
deleteButtons.forEach(button => {
  button.addEventListener('click', event => {
    // Show a confirmation dialog
    if (confirm('Are you sure you want to delete this restaurant?')) {
      // Your code to handle the delete button click event
      const res_id = event.target.getAttribute('data-id');

      // Send a request to delete the restaurant
      fetch('delete_restaurants.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'res_id=' + encodeURIComponent(res_id)
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