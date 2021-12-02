<!DOCTYPE html>
<html>
<meta charset="utf-8">
<link rel="stylesheet" href="css/navStyle.css" />
<link rel="stylesheet" href="css/style.css" />
</head>

<body>
        <?php
        require('db.php');
        // If form submitted, insert values into the database.
        if (isset($_REQUEST['username'])) {
                // removes backslashes
                $username = stripslashes($_REQUEST['username']);
                //escapes special characters in a string (hash this password and store hash)
                $username = mysqli_real_escape_string($con, $username);
                $email = stripslashes($_REQUEST['email']);
                $email = mysqli_real_escape_string($con, $email);
                $password = stripslashes($_REQUEST['password']);
                $password = mysqli_real_escape_string($con, $password);
                $trn_date = date("Y-m-d H:i:s");
                $query = "INSERT into `users` (username, passhash, email, trn_date, admin)
VALUES ('$username', '" . md5($password) . "', '$email', '$trn_date', 0)";
                $result = mysqli_query($con, $query);
                if ($result) {
                        header("Location: login.php");
                }
        } else {
        ?>
                <div class="form">
                        <h1>Registration</h1>
                        <form name="registration" action="registration.php" method="post">
                                <input type="text" name="username" placeholder="Username" required />
                                <input type="email" name="email" placeholder="Email" required />
                                <input type="password" name="password" placeholder="Password" required />
                                <input type="submit" name="submit" value="Register" />
                        </form>
                </div>
        <?php } ?>
</body>

</html>