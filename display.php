<?php
// Assuming $conn is a connection to your database
$conn = new mysqli('localhost', 'root', '', 'uitm_fd');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $res_name = $_POST['res_name'];
    $res_address = $_POST['res_address'];
    $res_image = $_FILES['res_image']['name'];
    $target_dir = "";
    $target_file = $target_dir . basename($_FILES["res_image"]["name"]);
    move_uploaded_file($_FILES["res_image"]["tmp_name"], $target_file);

    $sql = "INSERT INTO restaurants (res_name, res_address, res_image) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $res_name, $res_address, $res_image);
    $stmt->execute();
}

$sql = "SELECT res_id, res_name, res_address, res_image FROM restaurants";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurants</title>
    <style>
   .restaurants-container {
    display: flex;
    flex-wrap: wrap;
}

.restaurant-box {
    flex: 0 0 25%; /* This will make each box take up 25% of the container's width */
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    text-align: center;
    overflow: hidden; /* Add this line to prevent images from overflowing the box */
}

.restaurant-box img {
    width: 100%;
    height: auto; /* Set the height to auto to maintain aspect ratio */
    object-fit: cover;
}

.restaurant-box h2 {
    margin: 0;
    padding: 0;
}
    </style>
</head>
<body>
<div class="restaurants-container">
    <?php while($restaurant = $result->fetch_assoc()): ?>
        <div class="restaurant-box">
            <?php if (!empty($restaurant['res_image'])): ?>
                <img src="res_images/<?php echo $restaurant['res_image']; ?>" alt="<?php echo $restaurant['res_name']; ?>">
            <?php endif; ?>
            <h2><?php echo $restaurant['res_name']; ?></h2>
            <p>Address: <?php echo $restaurant['res_address']; ?></p>
            <a href="restaurant.php?res_id=<?php echo $restaurant['res_id']; ?>">View Details</a>
        </div>
    <?php endwhile; ?>
</div>
</body>
</html>