<?php
session_start();
include "connection/connect.php";
include "include/header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Restaurant Form</title>
  <style>
    /* Style the form container */
    form {
      width: 300px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
    }

    /* Style the form labels */
    label {
      display: block;
      margin-bottom: 10px;
      font-weight: bold;
    }

    /* Style the form inputs */
    input[type="text"], input[type="email"], input[type="tel"], textarea, input[type="date"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.1);
      font-size: 16px;
      line-height: 1.5;
    }

    /* Style the form submit button */
    input[type="submit"] {
      width: 100%;
      padding: 10px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      line-height: 1.5;
    }

    /* Style the form submit button hover effect */
    input[type="submit"]:hover {
      background-color: #3e8e41;
    }

    /* Style the form submit button active effect */
    input[type="submit"]:active {
      background-color: #347434;
    }
  </style>
</head>
<body>
    <?php  ?>
  <h1>Register Your Restaurant</h1>
  <form action="../submit.php" method="post">
    <label for="res_name">Name:</label>
    <input type="text" id="res_name" name="res_name" required><br>
    <label for="res_email">Email:</label>
    <input type="email" id="res_email" name="res_email" required><br>
    <label for="res_phone">Phone:</label>
    <input type="tel" id="res_phone" name="res_phone" pattern="[0-9]{10}" required><br>
    <label for="res_address">Address:</label>
    <textarea id="res_address" name="res_address" required></textarea><br>
    <label for="res_date">Date:</label>
    <input type="date" id="res_date" name="res_date" required><br>
    <br>
    <input type="submit" value="Submit">
  </form>

  <br>
  <br>
  <?php include "include/footer.php" ?>

</body>
</html>