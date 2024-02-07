<?php

//masukkan semua include yang penting disini terutama connection kepada database


session_start();
require_once 'include/db.php';
include "include/clean.php";
include "include/header.php";
include "include/main_function.php";


if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE user_id = '$username'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            header('Location: index.php');
        } else {
            echo "Wrong password";
        }
    } else {
        echo "User not found";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="<?php echo $keywords; ?>">

    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  	<div class="container">
	  	
        
      
        
        
        
		      <form class="form-login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		        <h2 class="form-login-heading">sign in now</h2>
                
                  <?php
		if (isset($_POST["username"])) {
			
 login(cucidata($_POST["username"]),cucidata($_POST["password"]),$con);
		}
		
                        ?> 
                
                
                
		        <div class="login-wrap">
		            <input type="text" class="form-control" placeholder="User ID" autofocus name="username" autocomplete="off" id="form1">
		            <br>
		            <input type="password" class="form-control" placeholder="Password" name="password" autocomplete="off">
		            <label class="checkbox">
		                <span class="pull-right">
		                    <a data-toggle="modal" href="include/forgot-password.php"> Forgot Password?</a>
		
		                </span>
		            </label>
		            <button class="btn btn-theme btn-block" type="submit" href="../index.php"><i class="fa fa-lock"></i> SIGN IN</button>
		            <hr>
		            
		         
		            <div class="registration">
		                Don't have an account yet?<br/>
		                <a class="" href="register.php">
		                    Create an account
		                </a>
		            </div>
		
		        </div>
                
                </form>
		
		          <!-- Modal -->
		          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content" id="form-content">
		                      
                              <form method="post" id="ajaxform" autocomplete="off" action="forgot-password.php">
                              
                              <div id="status"> </div>
                              <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Forgot Password ?</h4>
		                      </div>
		                 
                              
                              </form>
		                  </div>
		              
                    
                      
                      </div>
                        
		          </div>
		          <!-- modal -->
		
		     	  	
	  	
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/bgg.jpg", {speed: 500});
    </script>



<script type="text/javascript">
$(document).ready(function() {	
	
	// submit form using $.ajax() method
	
	$('#ajaxform').submit(function(e){
		
		e.preventDefault(); // Prevent Default Submission
		
		$.ajax({
			url: 'forget.php',
			type: 'POST',
			data: $(this).serialize() // it will serialize the form data
		})
		.done(function(data){
			$('#status').fadeOut('slow', function(){
				$('#status').fadeIn('slow').html(data);
			});
		})
		.fail(function(){
			alert('Ajax Submit Failed ...');	
		});
	});
		
});


</script>



















  </body>
</html>
