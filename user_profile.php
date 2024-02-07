<?php
session_start();
include "include/header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
</head>
<style>
    body {
    font-family: Arial, sans-serif;
}

.container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
}

.form-group {
    margin-bottom: 15px;
}

.form-control {
    display: block;
    width: 100%;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
}

.form-control:focus {
    border-color: #66afe9;
    outline: 0;
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(102, 175, 233, 0.6);
}

.btn {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: normal;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
}

.btn-primary {
    color: #fff;
    background-color: #337ab7;
    border-color: #2e6da4;
}

.btn-primary:hover {
    color: #fff;
    background-color: #286090;
    border-color: #204d74;
}

.alert {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
}

.alert-success {
    color: #3c763d;
    background-color: #dff0d8;
    border-color: #d6e9c6;
}
    </style>
<body>
    <div class="container">
        <?php
    

        $host = 'localhost';
        $db   = 'uitm_fd';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';

        $mysqli = new mysqli($host, $user, $pass, $db);
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        $name = $_SESSION['username'];

        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('s', $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $currentSettings = $result->fetch_assoc();

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
            $name = $_POST["name"];
            $email = $_POST["email"];
            $address = $_POST["address"];
            $phone = $_POST["phone"];

            $query = "UPDATE users SET name = ?, email = ?, address = ?, phone = ? WHERE username = ?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param('sssss', $name, $email, $address, $phone, $name);
            $stmt->execute();

            // Refresh the current settings after the update
            $query = "SELECT * FROM users WHERE username = ?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param('s', $name);
            $stmt->execute();
            $result = $stmt->get_result();
            $currentSettings = $result->fetch_assoc();

            echo "
                <div class='alert alert-success'>
                    Your profile has been updated successfully.
                </div>
            ";
        }

        ?>
        <form method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= $currentSettings['username'] ?? '' ?>" readonly>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $currentSettings['name'] ?? '' ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $currentSettings['email'] ?? '' ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="<?= $currentSettings['address'] ?? '' ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" class="form-control" id="phone" name="phone" value="<?= $currentSettings['phone'] ?? '' ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
<?php include "include/footer.php" ?>

</html>