<?php
   $conn = "";
     
   try {
       $servername = "localhost";
       $dbname = "uitm_fd";
       $username = "root";
       $password = "";
     
       $conn = new PDO(
           "mysql:host=$servername; dbname=uitm_fd",
           $username, $password
       );
        
      $conn->setAttribute(PDO::ATTR_ERRMODE,
                       PDO::ERRMODE_EXCEPTION);
   }
   catch(PDOException $e) {
       echo "Connection failed: " . $e->getMessage();
   }

   
?> 