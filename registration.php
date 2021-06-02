<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css"/>
    <style>
        .allGood {
            color: green;
        }
        .red {
            color: red;
        }
    </style>
</head>
<body>
<?php
    require('db.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($con, $username);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $confirmPassword = stripslashes($_REQUEST['ConfirmPassword']);
        $confirmPassword = mysqli_real_escape_string($con, $confirmPassword);
        $create_datetime = date("Y-m-d H:i:s");
        if ($password === $confirmPassword && $password!="" && filter_var($email, FILTER_VALIDATE_EMAIL) && $username!="") {

            $query    = "INSERT into `visitors` (username, password, email, create_datetime)
                        VALUES ('$username', '" . md5($password) . "', '$email', '$create_datetime')";
            $result   = mysqli_query($con, $query);
            if ($result) {
                echo "<div class='form'>
                    <h3 class='allGood'>You are registered successfully!</h3><br/>
                    <p class='link'>Click here to <a href='login.php'>Login</a></p>
                    </div>";
            }
            else {
            echo "<div class='form'>
                  <h3 class='red'>There was a problem during your registration!</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>";
            }
        }else if ($password != $confirmPassword){
            echo "<div class='form'>
            <h3 class='red'>The two codes are not identical.</h3><br/>
            <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
            </div>";
        }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<div class='form'>
            <h3 class='red'>Unacceptable email format!</h3><br/>
            <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
            </div>";
        }else {
            echo "<div class='form'>
            <h3 class='red'>There are fields you need to fill in.</h3><br/>
            <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
            </div>";
        }
    } else {
?>
    <form class="form"  method="post">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" required />
        <input type="text" class="login-input" name="email" placeholder="Email Adress">
        <input type="password" class="login-input" name="password" placeholder="Password">
        <input type="password" class="login-input" name="ConfirmPassword" placeholder="Confirm Password">
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link">Already have an account? <a href="login.php">Login here</a></p>
    </form>
<?php
    }
?>
</body>
</html>
