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

// Handle form submission to update a restaurant
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    // Get updated restaurant information from form
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $open_hours = $_POST["open_hours"];
    $close_hours = $_POST["close_hours"];
    $open_days = $_POST["open_days"];
    $image = $_FILES["image"];
    $date = date("Y-m-d"); // Get current date for res_date

    // Check if image is uploaded
    if ($image["error"] == UPLOAD_ERR_OK) {
        $target_dir = "../res_images/";
        $target_file = $target_dir . basename($image["name"]);
        move_uploaded_file($image["tmp_name"], $target_file);
    } else {
        echo "Error uploading image: " . $image["error"];
        exit;
    }

    // Query to update restaurant information in database
    $sql = "UPDATE restaurants SET res_name='$name', res_email='$email', res_phone='$phone', res_address='$address', open_hours='$open_hours', close_hours='$close_hours', open_days='$open_days', res_image='{$image['name']}', res_date='$date' WHERE res_id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Restaurant updated successfully";
    } else {
        echo "Error updating restaurant: " . $conn->error;
    }

    // Redirect back to all restaurants page
    header("Location: all_restaurants.php");
    exit();
}
// Get restaurant information from database based on ID passed in URL
$id = $_GET["res_id"];
$sql = "SELECT * FROM restaurants WHERE res_id=$id";
$result = $conn->query($sql);
$restaurant = $result->fetch_assoc();

// Store the current image path
$current_image = "../res_images/" . $restaurant['res_image'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Restaurant</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 50%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<?php include 'homepage.php'; ?>
  <div class="main">
    <h2>Update Restaurant</h2>

    <!-- Display the current image -->
    <img src="res_images/<?php echo $current_image; ?>" alt="Current Restaurant Image" width="200">

    <!-- Update form -->
    <form action="update_restaurant.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $restaurant["res_id"]; ?>">

        <table>
            <tr>
                <th>Name:</th>
                <td><input type="text" name="name" value="<?php echo $restaurant["res_name"]; ?>" required></td>
            </tr>
            <tr>
                <th>Email:</th>
                <td><input type="email" name="email" value="<?php echo $restaurant["res_email"]; ?>" required></td>
            </tr>
            <tr>
                <th>Phone:</th>
                <td><input type="tel" name="phone" value="<?php echo $restaurant["res_phone"]; ?>" required></td>
            </tr>
            <tr>
                <th>Address:</th>
                <td><input type="text" name="address" value="<?php echo $restaurant["res_address"]; ?>" required></td>
            </tr>
            <tr>
                <th>Open Hours:</th>
                <td><input type="time" name="open_hours" value="<?php echo $restaurant["open_hours"]; ?>" required></td>
            </tr>
            <tr>
                <th>Close Hours:</th>
                <td><input type="time" name="close_hours" value="<?php echo $restaurant["close_hours"]; ?>" required></td>
            </tr>
            <tr>
                <th>Open Days:</th>
                <td><input type="text" name="open_days" value="<?php echo $restaurant["open_days"]; ?>" required></td>
            </tr>
            <tr>
                <th>Image:</th>
                <td><input type="file" name="image" value="<?php echo $restaurant["res_image"]; ?>">
            </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Update Restaurant"></td>
            </tr>
        </table>
    </form>
    </div>
</body>
</html>