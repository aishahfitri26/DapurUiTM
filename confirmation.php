<?php
session_start();
include "connection/connect.php";
include "include/header.php";
?>
<!DOCTYPE html> 
<html>
     <head> 
        <title>Confirmation</title> 
        <link rel="stylesheet" href="styles.css">
     </head> 
     <style>
        .confirmation-container { 
         width: 500px; 
         margin: 0 auto; 
         padding: 20px; 
         border: 1px solid #ddd; 
      }
         .button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 0.25rem;
            cursor: pointer;
            display: inline-block;
            text-decoration: none;
            transition: background-color 0.3s ease;
         }

         .button:hover {
            background-color: #3e8e41;
         }

#order-list { list-style: none; padding: 0; }

#order-list li { margin-bottom: 10px; }
        </style>
     <body> 
      <br>
      <br>
      <br>
        <div class="confirmation-container">
             <h1>Confirmation</h1> 
             <p>Thank you for your order!</p> 
      
             <p>Delivery Method:Cash On Delivery</span></p> 
     
             <p>Your order will be processed and delivered to you soon.</p> 
            
             <a href="order.php" class="button">Check order</a>

             <br>
             <br>
             <br>

</div>
<?php include "include/footer.php" ?>

</body>
</html>