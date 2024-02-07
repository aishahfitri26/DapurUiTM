
<!DOCTYPE html>
<html>
<head>
</head>
  <style>
    .main {
      width: 80%;
      margin: 0 auto;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    table, th, td {
      border: 1px solid black;
      padding: 5px;
    }
    th {
      text-align: left;
    }
   @media only screen and (max-width: 600px) { .main { width: 100%; } table, th, td { border: 1px solid black; padding: 10px; font-size: 16px; } } 

  </style>
</head>
<body>
<?php include 'homepage.php'; ?>
  <div class="main">
    <br>
    <h2>List Of Users</h2>
    <table>
      <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Action</th>
      </tr>
      <?php
      // PHP code to retrieve and display table data
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

// Retrieve data from database
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

// Display table data
while($row = $result->fetch_assoc()) {
  echo "<tr>";
  echo "<td>" . $row['user_id'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['name'] . "</td>";
  echo "<td>" . $row['email'] . "</td>";
  echo "<td>" . $row['address'] . "</td>";
  echo "<td>" . $row['phone'] . "</td>";
  $user_id = $row['user_id'];
  echo "<td><button class='delete-btn' data-id='" . $user_id . "'>Delete</button> <a href='update_user.php?user_id=" . $user_id . "'><button class='update-btn'>Update</button></a></td>";
  echo "</tr>";
}

$conn->close();
      ?>
    </table>

<!--<script>
// Add event listener to action buttons
var buttons = document.getElementsByTagName("button");
for (var i = 0; i < buttons.length; i++) {
  buttons[i].addEventListener("click", function() {
    var action = this.parentElement.parentElement.getElementsByTagName("td")[5].innerText;
    if (action == "edit") {
      // Handle edit button click
    } else if (action == "delete") {
      // Handle delete button click
    }
  });
}
</script>-->
</div>

</body>
</html>