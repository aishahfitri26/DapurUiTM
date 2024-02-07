<?php
session_start(); // Add this line at the beginning of your PHP script

// Connect to the database
$conn = new mysqli("localhost", "root", "", "uitm_fd");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the menu_id from the URL parameter
$menu_id = isset($_GET["menu_id"]) ? $_GET["menu_id"] : 0;

// Handle form submission to update a menu item
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the required fields are empty
    if (empty($_POST["name"]) || empty($_POST["price"]) || empty($_POST["description"]) || empty($_FILES["image"])) {
        echo "All fields are required";
    } else {
        // Get updated menu information from form
        $name = $_POST["name"];
        $price = $_POST["price"];
        $description = $_POST["description"];
        $image = $_FILES["image"];
        $date = date("Y-m-d"); // Get current date for menu_date
        $c_id = $_POST["c_id"]; // Get selected category ID
        $menu_id = $_POST["menu_id"]; // Get the menu_id from the form

        // Update menu item in the database
        $sql = "UPDATE menu SET menu_name=?, menu_price=?, menu_description=?, menu_image=?, menu_date=?, c_id=? WHERE menu_id=?";

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Bind the parameters
        $stmt->bind_param("ssssssi", $name, $price, $description, $image['name'], $date, $c_id, $menu_id);

        // Check if image is uploaded
        if ($image["error"] == UPLOAD_ERR_OK) {
            $target_dir = "../menu_images/";
            $target_file = $target_dir . basename($image["name"]);
            move_uploaded_file($image["tmp_name"], $target_file);
        }

        // Execute the statement
        if ($stmt->execute()) {
            echo "Menu updated successfully";

            // Get the res_id from the menu table
            $sql = "SELECT res_id FROM menu WHERE menu_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $menu_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            // Redirect to the all_menu.php page with the res_id as a query parameter
            header("Location: all_menu.php?res_id=" . $row["res_id"]);
            exit();
        } else {
            echo "Error updating menu: " . $conn->error;
        }
    }
}


// Get the menu item details based on the menu_id
$sql = "SELECT menu.*, restaurants.res_id FROM menu INNER JOIN restaurants ON menu.res_id = restaurants.res_id WHERE menu_id = $menu_id";
$result = $conn->query($sql);
$menu = $result->fetch_assoc();

// Get all categories from the database
$sql = "SELECT * FROM menu_category WHERE c_name IN ('Foods', 'Drinks')";
$result = $conn->query($sql);

// Store the current image path
$current_image = isset($menu['menu_image']) && file_exists("../menu_images/{$menu['menu_image']}") ? "../menu_images/{$menu['menu_image']}" : "../menu_images/default.jpg";
?>


<!DOCTYPE html>
<html>
<head>
    <title>Update Menu Item</title>
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
    <h2>Update Menu Item</h2>

    <!-- Display the current image -->
    <img src="menu_images/<?php echo $current_image; ?>" alt="Current Menu Item Image" width="200">

    <!-- Update form -->
    <form action="update_menu.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="menu_id" value="<?php echo isset($menu["menu_id"]) ? $menu["menu_id"] : 0; ?>">

        <table>
            <tr>
                <th>Name:</th>
                <td><input type="text" name="name" value="<?php echo isset($menu["menu_name"]) ? $menu["menu_name"] : ''; ?>" required></td>
            </tr>
            <tr>
                <th>Price:</th>
                <td><input type="number" step="0.01" name="price" value="<?php echo isset($menu["menu_price"]) ? $menu["menu_price"] : ''; ?>" required></td>
            </tr>
            <tr>
                <th>Description:</th>
                <td><textarea name="description" required><?php echo isset($menu["menu_description"]) ? $menu["menu_description"] : ''; ?></textarea></td>
            </tr>
            <tr>
                <th>Image:</th>
                <td><input type="file" name="image" value="<?php echo isset($menu["menu_image"]) ? $menu["menu_image"] : ''; ?>"></td>
            </tr>
            <tr>
                <th>Category:</th>
                <td>
                <select name="c_id">
<option value="">Select a category</option>
<?php
          // Connect to the database
          $conn = mysqli_connect("localhost", "root", "", "uitm_fd");
          // Check connection
          if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
          }
          // Query to get menu categories
          $sql = "SELECT c_id, c_name FROM menu_category";
          $result = mysqli_query($conn, $sql);
          // Loop through the query result and create options
          if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
              echo '<option value="' . $row["c_id"] . '">' . $row["c_name"] . '</option>';
            }
          } else {
            echo '<option>No categories found</option>';
          }
          // Close the database connection
          mysqli_close($conn);
          ?>
</select>
                </td>
            </tr>
            <tr>
                <th>Date:</th>
                <td><input type="date" name="menu_date" value="<?php echo isset($menu["menu_date"]) ? $menu["menu_date"] : ''; ?>" required></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Update Menu Item"></td>
           
            </tr>
        </table>
    </form>
    </div>
</body>
</html>