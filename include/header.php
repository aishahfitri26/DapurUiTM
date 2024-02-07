<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="css/design.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>  
    <div class="topmenu">
    <div class="menubar" >
    <?php
    if (isset($_SESSION['username'])) {
        echo '
            <div class="homepage">
                <a href="./index.php"><i class="fa fa-home"></i> Home</a>
            </div>
            <div class="restaurant">
                    <a href="./restaurant.php"><i class="fa fa-cutlery"></i> Restaurant</a>
            </div>
            <div class="user_profile">
                <a id = "../update_profile.php" href="./user_profile.php"><i class="fa fa-user-circle-o"></i> My Profile</a>
            </div>
            <div class="order">
                <a id = "order" href="./order.php"><i class="fa fa-shopping-cart"></i> My Order</a>
            </div>
             <div class="logout">
                <a href="./logout.php" class="split"><i class="fa fa-sign-out"></i>Logout</a>
             </div>
             <div class="welcome">
             <span class="welcome"> Welcome </span>'. $_SESSION['username'];
             echo '</div>';
    
      } else {
        echo '
            <div class="home">
                <a href="./index.php"><i class="fa fa-home"></i> Home</a>
            </div>
            <div class="restaurant">
                <a href="./restaurant.php"><i class="fa fa-cutlery"></i> Restaurant</a>
            </div>
            <div class="login">
                <a href="./login.php" class="split"><i class="fa fa-sign-in"></i> Login</a>
            </div>
            <div>
            <span>Welcome Visitor</span>
            </div>
        </div>
        </div>
        

        ';
        } ?>
</div>
    </div>
</body>
</html>