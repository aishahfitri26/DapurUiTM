<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $query_type = $_POST["query_type"];
    $query_explanation = $_POST["query_explanation"];

    $to = "2022912639@student.uitm.edu.my";// put email  address here that you want to receive the contact form notification
    $subject = "New Query: $query_type";
    $message = "Name: $name\nEmail: $email\nPhone Number: $phone\nQuery Type: $query_type\nQuery Explanation: $query_explanation";
    $headers = "From: $email";

    if (mail($to, $subject, $message, $headers)) {
        echo "Your query has been sent successfully.";
    } else {
        echo "There was an error sending your query. Please try again later.";
    }
} else {
    header("Location: contact.html");
}
?>