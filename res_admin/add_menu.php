<?php
require_once '../connection/connect.php'; // Assuming you have a config.php file with your database connection details

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $c_id = $_POST['c_id'];
    $menu_name = $_POST['menu_name'];
    $menu_price = $_POST['menu_price'];
    $menu_description = $_POST['menu_description'];
    $menu_date = isset($_POST['menu_date']) && !empty($_POST['menu_date']) ? $_POST['menu_date'] : date('Y-m-d');

    // Get the res_id value from the query parameter
    $res_id = isset($_GET['res_id']) ? intval($_GET['res_id']) : 1;

    // Check if image file is a valid image
    if (isset($_FILES["menu_image"])) {
        $target_dir = "menu_images/";
        $target_file = $target_dir . basename($_FILES["menu_image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["menu_image"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["menu_image"]["tmp_name"], $target_file)) {
                // Insert the menu item into the database
                $sql = "INSERT INTO menu (c_id, menu_name, menu_price, menu_description, menu_image, menu_date, res_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("isssssi", $c_id, $menu_name, $menu_price, $menu_description, $target_file, $menu_date, $res_id);
                $stmt->execute();
                $menu_id = $stmt->insert_id;
                $stmt->close();

                // Retrieve the menu item from the database
                $sql = "SELECT * FROM menu WHERE menu_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $menu_id);
                $stmt->execute();
                $menu = $stmt->get_result()->fetch_assoc();
                $stmt->close();

                // Display the uploaded image
                echo "<img src='menu_images/{$menu['menu_image']}' alt='Menu Image' style='width: 100px; height: auto;'>";

                // Redirect to the all_menu.php page
                header('Location: all_menu.php?res_id=' . $res_id);
                exit;
            } else {
                echo "Error uploading the image.";
                exit;
            }
        } else {
            echo "File is not an image.";
            exit;
        }
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Menu</title>
</head>
<body>
<?php include 'homepage.php'; ?>
  <div class="main">
<style>
/* Styles for the menu filter form */
form {
    display: flex;
    flex-direction: column;
    max-width: 500px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f2f2f2;
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

label {
    margin-bottom: 8px;
    font-weight: bold;
    color: #333;
}

input[type="text"],
input[type="number"],
textarea {
    margin-bottom: 10px;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    width: 80%;
}

input[type="submit"] {
    margin-top: 16px;
    padding: 10px 20px;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

/* Styles for the custom select element */
select {
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 8" width="14" height="8"><polygon points="0,0 14,0 7,7"></polygon></svg>');
  background-repeat: no-repeat;
  background-position: right 10px center;
  padding-right: 25px;
  border: 1px solid #ccc;
  border-radius: 4px;
  height: 30px;
  line-height: 30px;
  font-size: 14px;
  width: 80%;
}

/* Styles for the menu table */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th,
td {
    padding: 16px;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f2f2f2;
    font-weight: bold;
    color: #333;
}

td img {
    width: 100px;
    height: auto;
}
input[type="date"] {
  width: 200px;
  height: 30px;
  font-size: 16px;
  padding: 0 5px;
  border-radius: 4px;
  border: 1px solid #ccc;
}
</style>
<form action="add_menu.php" method="post" enctype="multipart/form-data">
    <h2> Add Menu </h2>
    <label for="menu_name">Menu Name:</label>
    <input type="text" name="menu_name" id="menu_name" required>

    <label for="c_id">Category:</label>
<select name="c_id" id="c_id" required>
    <option value="">Select Category</option>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "uitm_fd");
    $sql = "SELECT * FROM menu_category";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='{$row['c_id']}'>{$row['c_name']}</option>";
    }
    ?>
</select>
<br>
    <label for="menu_price">Menu Price: RM</label>
    <input type="number" name="menu_price" id="menu_price" style="width:80%" step="0.01" required>

    <label for="menu_description">Menu Description:</label>
    <textarea name="menu_description" id="menu_description" required></textarea>

    <label for="menu_image">Menu Image:</label>
    <input type="file" name="menu_image" id="menu_image" required>
   <BR>

    <label for="menu_date">Menu Date:</label>
    <input type="date" name="menu_date" id="menu_date" required>

    <input type="submit" value="Add Menu">
</form>
</div>
</body>
</html>