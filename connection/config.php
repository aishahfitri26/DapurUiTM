<?php
require_once 'connection/connect.php';

function get_user_data($user_id) {
    global $db;
    $query = "SELECT * FROM users WHERE user_id=$user_id";
    $result = $db->query($query);

    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}