<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>My Order</title>
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin-left: auto;
    margin-right: auto;

        }
        th, td {
            padding: 8px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            border: 1px solid #ddd;

        }
        th {
            background-color: #f2f2f2;
        }
        .edit-button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin: 4px 2px;
            cursor: pointer;
        }
        @media screen and (max-width: 600px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }
            th, td {
                /* To make table columns fit to mobile screen */
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
   <?php include "include/header.php"; ?>
<h2>Order History</h2>
   <table>
        <thead>
            <tr>
                <th>Menu</th>
                <th>Price</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

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

$sql = "SELECT o.order_id, o.menu_id, m.menu_name, o.price, o.status, o.date FROM orders o join menu m on o.menu_id = m.menu_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["menu_name"]. "</td><td>RM" . $row["price"]. "</td><td>" . $row["status"]. "</td><td>" . $row["date"]. "</td>
        <td><button class='delete-btn' data-id='" . $row["order_id"]. "'>Delete</button></td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>

<script>
function editOrder(menuId) {
    // Code to handle the edit order action
    console.log("Edit order with menu ID: " + menuId);
}
 // Select all delete buttons
 const deleteButtons = document.querySelectorAll('.delete-btn');

// Attach a click event listener to each delete button
deleteButtons.forEach(button => {
  button.addEventListener('click', event => {
    // Show a confirmation dialog
    if (confirm('Are you sure you want to delete this restaurant?')) {
      // Your code to handle the delete button click event
      const order_id = event.target.getAttribute('data-id');

      // Send a request to delete the restaurant
      fetch('delete_order.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'order_id=' + encodeURIComponent(order_id)
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
<?php include "include/footer.php" ?>

</html>