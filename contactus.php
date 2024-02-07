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
    <title>Contact Us</title>
    <link rel="stylesheet" href="contact.css">
</head>
<style>


h1 {
    color: #333;
    margin-bottom: 20px;
}

form {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    max-width: 600px;
    margin: 0 auto;
}

label {
    display: block;
    margin-bottom: 5px;
    color: #333;
}

input[type="text"],
input[type="email"],
input[type="tel"],
select,
textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 3px;
    font-size: 14px;
}

input[type="submit"],
input[type="reset"] {
    background-color: #4CAF50;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

input[type="submit"]:hover,
input[type="reset"]:hover {
    background-color: #45a049;
}
    </style>
</style>
<body>
<img src="img/contactus.png" alt="Nature" class="responsive" width="100%" height="50%">
    <h1>Contact Us</h1>
    <form action="contact.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" required>
        <br>
        <label for="query_type">Query Type:</label>
        <select id="query_type" name="query_type" required>
            <option value="feedback">Feedback</option>
            <option value="problem">Problem</option>
            <option value="membership">Membership</option>
        </select>
        <br>
        <label for="query_explanation">Query Explanation:</label>
        <textarea id="query_explanation" name="query_explanation" required></textarea>
        <br>
        <input type="submit" value="Submit">
        <input type="reset" value="Reset">
    </form>

    <?php include "include/footer.php" ?>
</body>
</html>