<!DOCTYPE html>
<html>
<head>
<style>
body {
    font-family: Arial, Helvetica, sans-serif;
}

#orders {
    font-size: 18px;
    width: 100%;
    border-collapse: collapse;
}

#orders td, #orders th {
    border: 1px solid #ddd;
    padding: 8px;
}

#orders tr:nth-child(even){background-color: #f2f2f2;}

#orders tr:hover {background-color: #ddd;}

#orders th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
}
</style>
</head>
<body>
<?php include 'homepage.php'; ?>
  <div class="main">
<h2>Orders</h2>

<table id="orders">
    <tr>
        <th>Order ID</th>
        <th>Product</th>
        <th>Quantity</th>
        <th>Total Price</th>
        <th>Date</th>
    </tr>
    <?php
    // Your PHP code here
    $host = 'localhost';
    $db = 'uitm_fd';
    $user = 'root';
    $password = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, $user, $password, $opt);

    $stmt = $pdo->query('SELECT * FROM orders');

    while ($row = $stmt->fetch()) {
        echo "<tr>";
        echo "<td>" . $row['order_id'] . "</td>";
        echo "<td>" . $row['user_id'] . "</td>"; //add this line to display user ID
        echo "<td>" . $row['product'] . "</td>";
        echo "<td>" . $row['quantity'] . "</td>";
        echo "<td>" . $row['total_price'] . "</td>";
        echo "<td>" . $row['date'] . "</td>";
        echo "</tr>";
    }
    ?>
    </div>
</body>
</html>