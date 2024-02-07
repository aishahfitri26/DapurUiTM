<?php 


//################### [coding pendaftaran pengguna ###############################
$con = mysqli_connect($host,$user,$pwd,$db) or die (mysqli_connect_errno());
function daftar ($con,$username,$password,$password2,$name,$email,$address,$phone)
{

//periksa sama ada pengguna telah wujud
$daftarSQL=mysqli_query($con,"SELECT username from users where username='$username'") or die (mysqli_error($con));

$bil_rekod_daftar=mysqli_num_rows($daftarSQL);


	if ($password<>$password2)
	echo '<strong>Status!</strong> Password did not match. Click <a href="register.php">here</a> to try again.';
						
	

	elseif ($bil_rekod_daftar==0)
	{
	//secure the password
	$password=md5($password);
	
	
	
	mysqli_query($con,"INSERT INTO users (username,password,name,email,address,phone) values ('$username','$password','$name','$email','$address','$phone')") or die (mysqli_error($con));
	
	echo '<strong>Status!</strong> New user account created. Click <a href="login.php">here</a> to login';
	
	
	
	
	
		
	}
	else
	{
		//sekiranya rekod telah wujud
		
		
		echo '
						  <strong>Status!</strong> Username already exists. Click <a href="register.php">here</a> to try again.
						';
		
		
		
		
	}
	
	
}


//######################################[T A M A T]######################################################



//###############################[Coding Login - Mula]#############################################################

function login ($user,$password,$con)
{
    global $con; // Add this line to tell PHP to use the global $con variable

    //periksa sama ada pengguna telah wujud
    $password=md5($password);
    $loginSQL=mysqli_query($con,"SELECT username,password,user_id from users where username='$user' and password='$password'") or die (mysqli_error($con));   
    $bil_rekod_login=mysqli_num_rows($loginSQL);
    $papar_rekod_login=mysqli_fetch_array($loginSQL);

    // ... rest of the function ...
	

	if ($bil_rekod_login==0)
	{
	//secure the password
		echo '<div class="alert alert-danger alert-dismissable">
						  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						  <strong>Status</strong> Wrong username or password!
						</div>'    ;
	
	
	}
	else
	{
		//sekiranya rekod telah wujud
	//session_start();
	$_SESSION["username"]=$papar_rekod_login['username'];
	header ("location: ./index.php");	
		
		echo '
						  <strong>Status!</strong> Login accepted. Redirecting....
						';
		
		
		
		
	}
	
	
}

//######################################[T A M A T]######################################################




//######################################MULA - BUAT NMBR RANDOM]######################################################
function getpassword($n) { 
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
  
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
  
    return $randomString; 
} 



?>