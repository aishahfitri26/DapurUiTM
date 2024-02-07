<?php
session_start();
include "connection/connect.php";
include "include/header.php";



?>

<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
      crossorigin="anonymous" />
</head>
    <style>

        main {
            padding: 2rem;
        }

        section {
            margin-bottom: 2rem;
        }


        article {
            padding: 1rem;
            border: 1px solid #ddd;
            margin-bottom: 1rem;
        }

        article h3 {
            margin-top: 0;
        }


        .menu-box {
            border: 1px solid #ddd;
            padding: 1rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }

        .menu-box img {
            margin-right: 1rem;
            border-radius: 50%;
        }

        .menu-box p {
            flex: 1;
        }

        .menu-box button {
            margin-left: auto;
        }


        .col-25 {
            -ms-flex: 25%;
            flex: 25%;
            padding: 0 16px;
        }

        .container {
            background-color: #f2f2f2;
            padding: 5px 20px 15px 20px;
            border: 1px solid lightgrey;
            border-radius: 3px;
        }

        hr {
            border: 1px solid lightgrey;
        }

        span.price {
            float: right;
            color: grey;
        }

        .cart {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cart-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 0.25rem;
            cursor: pointer;
        }

        .col-25 {
        -ms-flex: 25%;
        flex: 25%;
        padding: 0 16px;
        }

        .cart-button:hover {
            background-color: #3e8e41;
        }

        .cart-item {
            margin-bottom: 0.5rem;
        }
    </style>
</head>

<body>

    <!-- Menu -->
    <main>
        <section id="restaurant">

            <?php
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            $restaurantId = $_GET['res_id'];
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

            if (isset($_GET['res_id'])) {
                $restaurantId = $_GET['res_id'];
            } else {
                // Handle the case where res_id is not present in the GET request
                $restaurantId = null;
                // or you can redirect user to some error page
                header('Location:index.php');
                exit();
            }
            
            // Fetch restaurant data
            $restaurantInfoQuery = "SELECT res_name FROM restaurants WHERE res_id = '$restaurantId'";
            $restaurantInfoResult = $conn->query($restaurantInfoQuery);

            if ($restaurantInfoResult && $restaurantInfoResult->num_rows > 0) {
                $restaurantInfoRow = $restaurantInfoResult->fetch_assoc();
                $restaurantName = $restaurantInfoRow['res_name'];

                echo "<h2 style='text-align:left;'>Restaurant: $restaurantName</h2>";
                echo "<p style='text-align:left;'>Restaurant ID: $restaurantId</p>";
            } else {
                echo "Restaurant information not found.";
            }


            // Fetch menu items for the restaurant from the database
            $menuQuery = "SELECT * FROM menu WHERE res_id = '$restaurantId'";
            $menuResult = $conn->query($menuQuery);

            if (!$menuResult) {
                die("Error: " . $menuQuery . "<br>" . $conn->error);
            }

            // Calculate the total price of all items in the cart
            $totalPrice = 0;

            // Display menu items
            if ($menuResult->num_rows > 0) {
                while ($row = $menuResult->fetch_assoc()) {
                    echo '<div class="menu-box" data-name="' . $row['menu_name'] . '" data-price="' . $row['menu_price'] . '">';
                    echo '<img src="menu_images/' . $row['menu_image'] . '" alt="' . $row['menu_name'] . '" width="100" height="100">';
                    echo '<p>' . $row['menu_name'] . ' - RM' . $row['menu_price'] . '</p>';
                    
                    echo '<form method="post" action="" class="add-to-cart-form">';
                    echo '<input type="hidden" name="item_name" value="' . $row['menu_name'] . '">';
                    echo '<input type="hidden" name="item_price" value="' . $row['menu_price'] . '">';
                    echo '<input type="hidden" name="menu_id" value="' . $row['menu_id'] . '">';
                    echo '<input type="hidden" name="res_id" value="' . $row['res_id'] . '">';
                    echo '<button type="button" class="add-to-cart">Add to Cart</button>';
                    echo '</form>';
                    echo '</div>';
                    // Update the total price
                    $totalPrice += $row['menu_price'];
                }
            } else {
                echo "No menu items found.";
            }

            // Save the total price to a session variable
            $_SESSION['cart_total'] = $totalPrice;

            // Close database connection
            $conn->close();
            ?>
        </section>

        <!-- Cart section -->
        <div class="cart">
            <div class="col-25">
                <div class="container">
                    <h4>Cart
                        <span class="price" style="color:black">
                            <i class="fa fa-shopping-cart"></i>
                            <b class="cart-item-count"></b>
                            <?php echo (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) ? count($_SESSION['cart']) : ''; ?>

        </b>
                        </span>
                    </h4>
                    <div class="cart-items">
                    <?php
                        // Display the updated cart items
                        if (isset($_SESSION['cart'])) {
                            foreach ($_SESSION['cart'] as $item) {
                                echo '<div class="cart-item">';
                                echo $item['menu_name'] . ' x' . $item['quantity'] . ' - RM' . ($item['price'] * $item['quantity']);
                                echo '<a href="remove_item.php?res_id=' . $_GET['res_id'] . '&action=remove&menu_name=' . urlencode($item['menu_name']) . '">';
                                echo '<i class="fa fa-trash pull-right"></i></a>';
                                echo '</div>';
                            }
                        }
                        ?>                    
                        </div>
                    <hr>
                    <p>Total<span class="price" style="color:black"><strong>RM </strong><b class="cart-total"></b></span></p>
                    
                    <div class=delivery-method">
                                    <label class="custom-control custom-radio m-b-20">
                                        <input name="mod" id="radioStacked1" checked value="COD" type="radio" class="custom-control-input"> 
                                        <span class="custom-control-indicator"></span> 
                                        <span class="custom-control-description">Cash on Delivery</span>
                                    </label>
                                    <br>
                                    <p></p>
                    </div>
                    <button class="cart-button" onclick="checkLoginAndProceed()">Checkout</button>
                </div>
            </div>
        </div>

    </main>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
// Initialize the shopping cart object

var shoppingCart = {
    items: [],

    addItem: function(name, price, quantity, menu_id, res_id) {
        // Check if the item already exists in the cart
        var existingItem = this.items.find(function(item) {
            return item.name === name;
        });

        if (existingItem) {
            // If the item already exists, increase the quantity
            existingItem.quantity += quantity;
        } else {
            // If the item doesn't exist, add it to the cart
            this.items.push({
                name: name,
                price: price,
                quantity: quantity,
                menu_id: menu_id,
                res_id: res_id
            });
        }

        // Update the cart display
        this.displayCart();
        
        // Save the cart to localStorage
        this.saveToLocalStorage();
    },

    displayCart: function() {
        // Clear the existing cart items
        $('.cart-items').empty();

        // Calculate the total number of items in the cart
        var totalItems = this.items.reduce(function(total, item) {
            return total + item.quantity;
        }, 0);

        // Display the total number of items in the cart
        $('.cart-item-count').text(totalItems);

        // Display each item in the cart
        this.items.forEach(function(item) {
            var itemHtml = `<div class="cart-item">${item.name} x${item.quantity} - RM${item.price * item.quantity}
            <a href="#" class="delete-item" data-name="${item.name}">
            <i class="fa fa-trash pull-right"></i>
            </a>
            </div>`;
            
            $('.cart-items').append(itemHtml);
            
        });

        // Calculate the total price of all items in the cart
        var totalPrice = this.items.reduce(function(total, item) {
            return total + item.price * item.quantity;
        }, 0);

        // Display the total price of all items in the cart
        $('.cart-total').text(totalPrice.toFixed(2));
    },

    removeItem: function(name) {
        // Find the index of the item to remove
        var itemIndex = this.items.findIndex(function(item) {
            return item.name === name;
        });

        // If the item is found, remove it from the array
        if (itemIndex !== -1) {
            this.items.splice(itemIndex, 1);
            this.displayCart();
            
            // Save the cart to localStorage after removing an item
            this.saveToLocalStorage();
        }
    },

    saveToLocalStorage: function() {
        // Save the current cart items to localStorage
        localStorage.setItem('shoppingCart', JSON.stringify(this.items));
    },

    loadFromLocalStorage: function() {
        // Load the cart items from localStorage
        var storedCart = localStorage.getItem('shoppingCart');
        if (storedCart) {
            this.items = JSON.parse(storedCart);
            this.displayCart();
        }
    }
};

// Load the cart items from localStorage when the page loads
shoppingCart.loadFromLocalStorage();

// Add a click event listener to the "Add to Cart" button
$('.add-to-cart').click(function(e) {
    e.preventDefault();

    // Get the name and price of the item from the form
    var name = $(this).siblings('input[name="item_name"]').val();
    var price = parseFloat($(this).siblings('input[name="item_price"]').val());
    var menu_id = $(this).siblings('input[name="menu_id"]').val();
    var res_id = parseFloat($(this).siblings('input[name="res_id"]').val());
    if (isNaN(price)) {
        console.error("Invalid price");
        return;
    }

    // Add the item to the cart
    shoppingCart.addItem(name, price, 1, menu_id, res_id);

     // Update the cart display
    shoppingCart.displayCart();
});

// Add a click event listener to the "Delete" button in cart items
$('.cart-items').on('click', '.delete-item', function() {
        var itemName = $(this).data('name');
        shoppingCart.removeItem(itemName);
});

// Display the initial cart
shoppingCart.displayCart();

function checkLoginAndProceed() {
    var storedCart = localStorage.getItem('shoppingCart');
    var param = {
        cart: storedCart
    }
    $.ajax({
        url: 'check_login.php',
        type: 'GET',
        success: function(response) {
            if (response === 'true') {
                // User is logged in, proceed to checkout
                // window.location.href = 'check_out.php';
                $.ajax({
                    url: 'check_out.php',
                    type: 'POST',
                    data: param,
                    success: function(response) {
                        var d = JSON.parse(response);
                        if(d.status){
                            localStorage.removeItem('shoppingCart');
                            window.location.href = 'confirmation.php';
                        }else{
                            alert('Failed to checkout!');
                        }
                    }
                });
            } else {
                // User is not logged in, show an alert and redirect to the login page
                alert("Please login first.");
                window.location.href = 'login.php';
            }
        },
        error: function() {
            // Handle error
            console.log('Error occurred while checking login status.');
        }
    });
}

</script>


</body>

</html>