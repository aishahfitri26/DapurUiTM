<?php
require_once 'config.php';

function login($username, $password) {
    global $db;
    $query = "SELECT id FROM users WHERE username='$username' AND password='$password'";
    $result = $db->query($query);

    if ($result && $result->num_rows > 0) {
        $user_id = $result->fetch_row()[0];
        $_SESSION['user_id'] = $user_id;
        return $user_id;
    } else {
        return false;
    }
}