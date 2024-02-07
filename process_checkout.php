<?php
session_start();

// Check if the cart is not empty
if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    // Get the total amount from the form
    $total_amount = $_POST['total_amount'];

    // Process the checkout process here, e.g., store the order details in a database or send an email to the customer

    // Clear the cart
    unset($_SESSION['cart']);

    // Redirect the user to the success page
    header('Location: order.php');
    exit;
} else {
    // Redirect the user to the cart page if the cart is empty
    header('Location: dish.php');
    exit;
}