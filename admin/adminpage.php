<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "uitm_fd";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sqlUsers = "SELECT COUNT(*) as total FROM users";
$resultUsers = $conn->query($sqlUsers);
$rowUsers = $resultUsers->fetch_assoc();
$totalUsers = $rowUsers["total"];

$sqlRestaurants = "SELECT COUNT(*) as total FROM restaurants";
$resultRestaurants = $conn->query($sqlRestaurants);
$rowRestaurants = $resultRestaurants->fetch_assoc();
$totalRestaurants = $rowRestaurants["total"];

$sqlOrders = "SELECT COUNT(*) as total FROM orders";
$resultOrders = $conn->query($sqlOrders);
$rowOrders = $resultOrders->fetch_assoc();
$totalOrders = $rowOrders["total"];

$sqlMenu = "SELECT COUNT(*) as total FROM menu";
$resultMenu = $conn->query($sqlMenu);
$rowMenu = $resultMenu->fetch_assoc();
$totalMenu = $rowMenu["total"];

// Close the database connection
$conn->close();
?>

<!DOCTYPE html> 
<html lang="en">
<head> 
<meta charset="UTF-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Admin Dashboard</title> 
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css"> 
 <style> 
 body 
 { font-family: Arial, sans-serif; background-color: #f5f5f5; }

.container 
{ max-width: 1200px; margin: 0 auto; padding: 0 15px; }

.card 
{ border: none; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 30px; }

.card-header 
{ background-color: #343a40; color: #fff; border-radius: 10px 10px 0 0; padding: 20px; font-size: 24px; font-weight: bold; }

.card-body 
{ padding: 30px; display: flex; justify-content: space-between; align-items: center; }

.stat 
{ background-color: #fff; border-radius: 5px; padding: 20px; text-align: center; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); flex: 1 1 25%; margin-right: 20px; }

.stat h3 
{ margin: 0; font-size: 36px; font-weight: bold; }

.stat p 
{ margin: 0; font-size: 18px; color: #6c757d; }

@media (max-width: 767.98px) 
{ .stat { flex: 1 1 100%; margin-right: 0; } } 
</style>

</head> 
<body> 
    <?php include 'homepage.php'; ?>
     <div class="main"> <br> <div class="container"> 
        <div class="card"> <div class="card-header"> Dashboard </div> 
        <div class="card-body"> 
            <div class="stat"> 
                <h3><?php echo $totalUsers; ?></h3> <p>Total Users</p>
             </div> <div class="stat"> <h3><?php echo $totalRestaurants; ?></h3> <p>Total Restaurants</p> </div>
              <div class="stat"> <h3><?php echo $totalOrders; ?></h3> <p>Total Orders</p> </div> <div class="stat"> <h3><?php echo $totalMenu; ?></h3> <p>Total Menu</p>
             </div> 
            </div> 
        </div> 
    </div> 
</div> 
</body>
 </html>