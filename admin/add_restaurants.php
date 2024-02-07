<!DOCTYPE html>
<html>
<head>
    <title>Add Restaurant</title>
</head>
<style>
  body {
      font-family: Arial, sans-serif;
    }

    label {
      display: block;
      margin-top: 20px;
      font-weight: bold;
    }

    input[type="text"], input[type="email"], input[type="tel"], input[type="date"], input[type="password"],input[type="username"], textarea {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ddd;
      border-radius: 5px;
      box-sizing: border-box;
    }

    select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ddd;
      border-radius: 5px;
      box-sizing: border-box;
    }

    input[type="submit"] {
      width: 100%;
      padding: 10px;
      margin-top: 20px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }
    form {
  /* Display the form elements in a grid with 3 columns */
  display: grid;
  grid-template-columns: 1fr 1fr;

  /* Add some margin to the top and bottom of the form elements */
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ddd;
  box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

form > * {
  /* Add some margin to the top and bottom of the form elements */
  margin: 0px 0;

  /* Add some padding to the form elements */
  padding: 10px;
}

/* Style the first column */
form > :nth-child(-n + 11) {
  /* Add some margin to the right of the form elements in the first column */
  margin-right: 20px;
}

/* Style the second column */
form > :nth-child(n + 12) {
  /* Add some margin to the left of the form elements in the second column */
  margin-left: 20px;
}

/* Style the third column */
form > :nth-child(n + 19) {
  /* Add some margin to the left of the form elements in the third column */
  margin-left: 20px;
}

.form .checkbox-container {
  /* Display the container as an inline-block element */
  display: inline-block;

  /* Add some margin between the checkboxes */
  margin-right: 10px;
}

.form .checkbox-column {
  /* Display the checkboxes in a column */
  display: flex;
  flex-direction: column;
}

.form .checkbox-column > * {
  margin-bottom: 0px;
}
.form .time-input-container {
  /* Display the container as a flex container */
  display: flex;

  /* Add some margin between the containers */
  margin-right: 10px;
}

.form .time-input-container label {
  /* Align the labels to the left */
  align-self: flex-start;
}

.form .time-input-container input {
  /* Align the inputs to the right */
  align-self: flex-end;
}
</style>

<body>
<?php include 'homepage.php'; ?>
  <div class="main">
  <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the database
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

    
// Collect the form data
$restaurant_name = $_POST["res_name"];
$res_email = $_POST["res_email"];
$res_phone = $_POST["res_phone"];
$res_address = $_POST["res_address"];
$open_hours = $_POST["open_hours"];
$close_hours = $_POST["close_hours"];
$open_days = implode(',', $_POST["open_days"]);
$res_password = isset($_POST["res_password"]) ? password_hash($_POST["res_password"], PASSWORD_DEFAULT) : null;
$res_date = date('Y-m-d', strtotime($_POST["res_date"]));

    // Check if image file is a valid image file
    if(isset($_FILES["res_image"]["tmp_name"]) && !empty($_FILES["res_image"]["tmp_name"])){
        $target_dir = "";
        $target_file = $target_dir . basename($_FILES["res_image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a valid file
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["res_image"]["tmp_name"]);
            if($check !== false) {
                // Upload file
                if (move_uploaded_file($_FILES["res_image"]["tmp_name"], $target_file)) {
                    $sql = "INSERT INTO restaurants (res_name, res_email, res_phone, res_address, open_hours, close_hours, open_days, res_password, res_image, res_date) VALUES ('$restaurant_name', '$res_email', '$res_phone', '$res_address', '$open_hours', '$close_hours', '$open_days', '$res_password', '$target_file', '$res_date')";
                    if ($conn->query($sql) === TRUE) {
                        echo "New record created successfully";
                        echo '<a href="all_restaurants.php">View all restaurants</a>';
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            } else {
                echo "File is not an image.";
            }
        }
    } else {
        $sql = "INSERT INTO restaurants (res_name, res_email, res_phone, res_address, open_hours, close_hours, open_days, res_password, res_image, res_date) VALUES ('$restaurant_name', '$res_email', '$res_phone', '$res_address', '$open_hours', '$close_hours', '$open_days', '$res_password', '$target_file', '$res_date')";
        if ($conn->query($sql) === TRUE) {
          echo "New record created successfully";
          echo '<a href="all_restaurants.php">View all restaurants</a>';
          exit();
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }

    // Reset res_id to start from 1
    $sql = "ALTER TABLE restaurants AUTO_INCREMENT = 1;";

    if ($conn->query($sql) === TRUE) {
        echo "";
    } else {
        echo "Error resetting res_id: " . $conn->error;
    }

    // Close the database connection
    $conn->close();

} else {
    // Display the form
    // ...
}
?>

<form action="add_restaurants.php" method="post" enctype="multipart/form-data">
    <!-- form fields here -->
    <div class="form" >
    <h2> Add Restaurants </h2>
    <label for="res_name">Restaurant Name:</label><br>
    <input type="text" id="res_name" name="res_name" required><br>
    <label for="res_email">Email:</label><br>
    <input type="email" id="res_email" name="res_email" required><br>
    <label for="res_username">Username:</label><br>
    <input type="username" id="res_username" name="res_username" required><br>
    <label for="res_password">Password:</label><br>
    <input type="password" id="res_password" name="res_password" required><br>
    <label for="res_phone">Phone:</label><br>
    <input type="tel" id="res_phone" name="res_phone" required><br>
    <label for="res_address">Address:</label><br>
    <textarea id="res_address" name="res_address" required></textarea><br>
    
    
</div>

    <div class="form">
   
    <div class="time-input-container">
    <label for="open_hours">Open Hours:</label><br><br>
    <input type="time" id="open_hours" name="open_hours" required><br>
</div>
<div class="time-input-container">
    <label for="close_hours">Close Hours:</label><br></br>
    <input type="time" id="close_hours" name="close_hours" required><br>
</div>
    <label for="open_days">Open Days:</label><br>
    <div class="form .checkbox-column">
    <div class="checkbox-container">
    <label for="monday">Monday</label><br>
    <input type="checkbox" id="monday" name="open_days[]" value="Monday">
</div>
<div class="checkbox-container">
    <label for="tuesday">Tuesday</label><br>
    <input type="checkbox" id="tuesday" name="open_days[]" value="Tuesday">
</div>
<div class="checkbox-container">
    <label for="wednesday">Wednesday</label><br>
    <input type="checkbox" id="wednesday" name="open_days[]" value="Wednesday">
</div>
</div>
<div class="form .checkbox-column">
<div class="checkbox-container">
    <label for="thursday">Thursday</label><br>
    <input type="checkbox" id="thursday" name="open_days[]" value="Thursday">
</div>
<div class="checkbox-container">
    <label for="friday">Friday</label><br>
    <input type="checkbox" id="friday" name="open_days[]" value="Friday">
    </div>
    <div class="checkbox-container">
    <label for="saturday">Saturday</label><br>
    <input type="checkbox" id="saturday" name="open_days[]" value="Saturday">
</div>
<div class="checkbox-container">
    <label for="sunday">Sunday</label><br>
    <input type="checkbox" id="sunday" name="open_days[]" value="Sunday">
    
</diV>
</div>
    <label for="res_image">Image:</label><br>
    <input type="file" id="res_image" name="res_image"><br>
    <label for="res_date">Date:</label><br>
    <input type="date" id="res_date" name="res_date" required><br>
    <input type="submit" name="submit" value="Submit">
   
</div>
</form>
</div>
</body>
</html>