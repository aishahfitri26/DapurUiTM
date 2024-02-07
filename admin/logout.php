<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<style>
    .logout-button {
 margin: 20px;
}

.logout-button button {
 padding: 10px 20px;
 font-size: 18px;
 background-color: #ff0000;
 color: white;
 border: none;
 cursor: pointer;
}

.logout-button button:hover {
 background-color: #dc3545;
}
    </style>
<body>
 <div class="logout-button">
    <button onclick="location.href='logout.php'">Logout</button>
 </div>
 <?php
session_start();

// Unset all of the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();

// Redirect to the login page
header("Location: index.php");
exit;
?>
</body>
</html>