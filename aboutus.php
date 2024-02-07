<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Dapur UiTM</title>
<style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 0 20px;
    text-align: center;
}

.logo{
    display: block;
    margin: 0 auto;
}

h1 {
    color: #333;
    font-size: 24px;
    margin-bottom: 20px;
    max-width: 500px; /* Adjust the maximum width as needed */
    margin-left: auto;
    margin-right: auto;
}

h6 {
    line-height: 1.6;
    margin-bottom: 15px;
    max-width: 700px; 
    margin-left: auto;
    margin-right: auto;
    text-align: center;
    padding: 15px;
    border: 1px solid #ccc;
    border-radius: 5px; 
    background-color: #f9f9f9; 
}


/* Responsive Styles */
@media screen and (max-width: 600px) {
    .container {
        padding: 0 10px;
    }
}

.button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #f77cf0;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
    display: inline-block;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    text-align: center;
    align-items: center;
}

.button:hover {
    background-color: #f77cf0;
}

</style>
</head>
<body>
    <!-- Include header -->
    <?php 
    session_start();
    include 'include/header.php'; ?>

    <img src="img/abt.png" alt="Nature" class="responsive" width="100%" height="50%">
    <img src="img/logo.png" class="logo" width="20%" height="20%">

    <div class="container">
        <h1>About Us - Dapur UiTM</h1><br>
        <h6>Welcome to Dapur UiTM, your ultimate destination for delicious and convenient food ordering within the Universiti Teknologi MARA (UiTM) Machang campus!</h6>
        <h6>At Dapur UiTM, we strive to provide students with a diverse selection of mouth-watering cuisines, from local delicacies to international favorites, all available at your fingertips.</h6>
        <h6>Our platform is designed to streamline the food ordering process, allowing you to explore menus, place orders, and indulge in culinary delights without leaving the comfort of your campus.</h6>
        <h6>Whether you're craving a hearty meal, a quick snack, or a refreshing beverage, Dapur UiTM has you covered. With a range of restaurants and kiosks to choose from, you're sure to find something to satisfy your cravings.</h6>
        <h6>Thank you for choosing Dapur UiTM as your go-to food ordering solution. We look forward to serving you delicious meals and enhancing your dining experience at UiTM!</h6><br>
    

    <a href="restaurant.php" class="button">Explore Restaurants</a>
    </div>

    <!-- Include footer -->
    <?php include 'include/footer.php'; ?>
</body>
</html>
