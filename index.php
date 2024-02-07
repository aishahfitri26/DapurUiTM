<?php
session_start();
include "connection/connect.php";
include "include/header.php";
?>
<?php include "include/photoindex.php" ?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
  * {
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 2rem;
}

.restaurant-card {
    background-color: #f4f4f4;
    border-radius: 5px;
    padding: 1rem;
    margin-bottom: 2rem;
    text-align: center;
}

.restaurant-card img {
    max-width: 50%;
    height: auto;
    border-radius: 5px;
    margin-bottom: 1rem;
}
.solid {
            border: 0;
            height: 1px;
            background-image: linear-gradient(to right, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.1));
        }
  </style>
<body>

<h2 style="text-align:center";>Popular Dishes of the Month</h2>
          <p style="text-align:center">Easiest way to order your favourite food among these top 6 dishes</p>
          <h1>Menu</h1>
		<?php include 'include/menu.php'; ?>
    <hr class="solid">
    <h1> List of Restaurants </h2>
    <?php include "display.php" ?>



<br>


</body>
<?php include "include/footer.php" ?>

</html>