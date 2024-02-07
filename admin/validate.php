<?php

include_once('dblogin.php');

function test_input($data) {
	
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$username = test_input($_POST["username"]);
	$password = test_input($_POST["password"]);
	$stmt = $conn->prepare("SELECT * FROM adminlogin");
	$stmt->execute();
	$users = $stmt->fetchAll();
	$found = false;
	
	foreach($users as $user) {
		
		if($user['username'] == $username) {
			$found = true;
			if($user['password'] == $password) {
				header("location: adminpage.php");
			}
			else {
				echo "<script language='javascript'>";
				echo "alert('WRONG PASSWORD');";
				echo "window.location.href='index.php';";
				echo "</script>";
			}
		}
	}
	
	if(!$found) {
		echo "<script language='javascript'>";
		echo "alert('WRONG USERNAME');";
		echo "window.location.href='index.php';";
		echo "</script>";
	}
}

?>