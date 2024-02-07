
<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href=
"https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/login.css">
    <title>Login Page</title>
</head>
 <style>
    .show-password {
            display: flex;
            align-items: center;
            height: 100%;
            margin-left: 10px;
        }

        .show-password input[type="checkbox"] {
            display: none;
        }

        .show-password label {
            cursor: pointer;
            padding: 0 5px;
            font-size: 1.2em;
            color: #6c757d;
            transition: color 0.15s ease;
        }

        .show-password label:hover {
            color: #007bff;
        }
    </style>
<body>
    <form action="validate.php" method="post">
        <div class="login-box">
        <div class="login-header" style="display: flex; align-items: center;">
                <img src="images/logo.png" alt="Admin Login" style="width: 100px; height: 100px; margin-right: 10px;">
                <h1>Restaurant Admin</h1>
            </div>
 
            <div class="textbox">
                <i class="fa fa-user" aria-hidden="true"></i>
                <input type="text" placeholder="Username"
                         name="res_username" value="">
            </div>
 
            <div class="textbox">
                <i class="fa fa-lock" aria-hidden="true"></i>
                <input type="password" placeholder="Password" name="res_password" value="">
                <div class="show-password">
                    <input type="checkbox" id="show-password-check">
                    <label for="show-password-check">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                    </label>
                </div>
            </div>
 
            <input class="button" type="submit" name="login" value="Sign In">
        </div>
    </form>

    <script>
        // Add this JavaScript code to toggle the password visibility when the checkbox is clicked
        const checkbox = document.getElementById("show-password-check");
        const passwordInput = document.querySelector("input[name='res_password']");

        checkbox.addEventListener("change", () => {
            if (checkbox.checked) {
                passwordInput.setAttribute("type", "text");
                checkbox.closest("label").classList.add("active");
            } else {
                passwordInput.setAttribute("type", "password");
                checkbox.closest("label").classList.remove("active");
            }
        });
        </script>

</body>
 
</html>