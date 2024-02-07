<?php

    session_start();
    include "connection/connect.php";
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
?>



<?php 

    
    // Get the current user's ID from the session
    $userId = isset($_SESSION['username']) ? $_SESSION['username'] : '';


    // Check if the user is logged in and has a valid user ID
    if (!isset($userId) || empty($userId)) {
        // Redirect the user to the login page if they are not logged in
        header('Location: login.php');
        exit();
    }


    // Get the cart items from the session
    $cart = $_POST['cart'];

    $cartItems = json_decode($cart);


    // Calculate the total price of the cart items
    $totalPrice = 0;
    $menuArr = [];
    $resArr = [];
    $qtyArr = [];
    $status = 'pending';
    foreach ($cartItems as $item) {

        $menu_id = $item->menu_id;
        $res_id = $item->res_id;
        $qty = $item->quantity;
        $totalPrice += $item->price * $item->quantity;
        array_push($menuArr, $menu_id);
        array_push($resArr, $res_id);
        array_push($qtyArr, $qty);
    }

    $menu = implode(", ", $menuArr);
    $res = implode(", ", $resArr);
    $qty = implode(", ", $qtyArr);

    $orderQuery = "INSERT INTO orders (user_id, menu_id, res_id, quantity, price, status, `date`) VALUES (?, ?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($orderQuery);
    $stmt->bind_param("ssssis", $userId, $menu, $res, $qty, $totalPrice, $status);
    if ($stmt->execute()) {
        echo json_encode(array('status' => true));
    } else {
        echo json_encode(array('status' => false, 'error' => $stmt->error));
    }



// Check if the user has already ordered from this restaurant
// $checkOrderQuery = "SELECT * FROM orders WHERE user_id = ? AND res_id = ?";
// $checkOrderStmt = $conn->prepare($checkOrderQuery);
// $checkOrderStmt->bind_param("ii", $userId, $restaurantId);
// $checkOrderStmt->execute();
// $checkOrderResult = $checkOrderStmt->get_result();

// If the user has not ordered from this restaurant before, insert a new order
// if ($checkOrderResult->num_rows == 0) {
//     $orderQuery = "INSERT INTO orders (user_id, res_id, price, date) VALUES (?, ?, ?, NOW())";
//     $stmt = $conn->prepare($orderQuery);
//     $stmt->bind_param("iii", $userId, $restaurantId, $totalPrice);
//     $stmt->execute();
// } else {
//     $orderId = $checkOrderResult->fetch_assoc()['order_id'];
//     $updateOrderQuery = "UPDATE orders SET price = price + ? WHERE order_id = ?";
//     $updateOrderStmt = $conn->prepare($updateOrderQuery);
//     $updateOrderStmt->bind_param("di", $totalPrice, $orderId);
//     $updateOrderStmt->execute();
// }

// Get the order ID from the database
// $orderId = $stmt->insert_id;

// Add the cart items to the order details table
// foreach ($cartItems as $item) {
//     $menuName = $item['menu_name'];
//     $price = $item['price'];
//     $quantity = $item['quantity'];

//     $orderDetailsQuery = "INSERT INTO order_details (order_id, menu_name, price, quantity) VALUES (?, ?, ?, ?)";
//     $orderDetailsStmt = $conn->prepare($orderDetailsQuery);
//     $orderDetailsStmt->bind_param("iidd", $orderId, $menuName, $price, $quantity);
//     $orderDetailsStmt->execute();
// }

// Clear the cart items from the session
// unset($_SESSION['cart']);

// Redirect the user to the order confirmation page
// header('Location: order_confirmation.php?order_id=' . $orderId);
// exit();
?>