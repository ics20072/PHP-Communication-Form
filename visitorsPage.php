<?php
    //include auth_session.php file on all user panel pages
    include("auth_session.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Welcome to the submission form</title>
    <link rel="stylesheet" href="style.css"/>
    <style>
        .login-button {
            margin-bottom: 5px;
            width: 40%;
            margin-top: 15px;
        }

        input[type=number] {
            width: 20%;
            height: 7px;
            margin-bottom:2px;
        }
        p {
            margin-bottom: 3px;
        }
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

        if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['submit'])) {
            
            $con = mysqli_connect("localhost","root","","usersdatabase");
            // Check connection
            if (mysqli_connect_errno()){
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }

            $firstname = trim($_REQUEST['firstname']);
            $lastname = trim($_REQUEST['lastname']);
            $email = $_REQUEST['email'];
            $telephone = trim($_REQUEST['phone']);
            if (isset($_POST['gender']))   
                 $gender = $_REQUEST['gender'];
            else
                 $gender = "";
            $age = $_REQUEST['age'];
            if (isset($_POST['products']))   
                $interests = $_REQUEST['products'];
            else
                $interests = "";
            if (isset($_POST['notifications']))   
                $notifications = $_REQUEST['notifications'];
            else
                $notifications = "";
            $create_datetime = date("Y-m-d H:i:s");

            if ($firstname!="" && $lastname!="" && $email!="" && $telephone!="" && $gender!="" && $age!="" && $interests!="" 
                                                        && $notifications!="" && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    
                $query    = "INSERT into `usersubmissions` (firstname, lastname, email, phone_Number, gender, age, interests, notifications, sended_date)
                            VALUES ('$firstname', '$lastname', '$email', '$telephone', '$gender', '$age', '$interests', '$notifications', '$create_datetime')";
                $result   = mysqli_query($con, $query);

                if($result) {
                    echo "<div class='form'>
                    <h3 class='allGood'>Your form was successfully registered!</h3><br/>
                    <p class='link'>Click here to <a href='visitorsPage.php'>submit</a> a new again.</p>
                    </div>";
                }else {
                    echo "<div class='form'>
                    <h3 class='red'>Unknown submission error!</h3><br/>
                    <p class='link'>Click here to <a href='visitorsPage.php'>submit</a> again.</p>
                    </div>";
                }
            }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                echo "<div class='form'>
                <h3 class='red'>Unacceptable email format!<h3><br/>
                <p class='link'>Click here to <a href='visitorsPage.php'>submit</a> again.</p>
                </div>";
            }else {
                echo "<div class='form'>
                <h3 class='red'>There are fields you need to fill in.</h3><br/>
                <p class='link'>Click here to <a href='visitorsPage.php'>submit</a> again.</p>
                </div>";
            }
        }else {
    ?>

    <form class="form" method="post">
        <h1 class="login-title">Please fill in your details!</h1>
        <p>Hey, <?php echo $_SESSION['username']; ?>!</p><hr>
        <input type="text" class="login-input" name="firstname" placeholder="Firstname..." autofocus="true"/>
        <input type="text" class="login-input" name="lastname" placeholder="Lastname..." autofocus="true"/>
        <input type="text" class="login-input" name="email" placeholder="Email..." autofocus="true"/>
        <input type="tel" class="login-input" name="phone" placeholder="+30" autofocus="true"/>
        <hr>
        <input type="radio" id="male" name="gender" value="male">
        <label for="male">Male</label><br>
        <input type="radio" id="female" name="gender" value="female">
        <label for="female">Female</label><br>
        <hr>
        <input type="number" class="login-input" name="age" autofocus="true" min="0" value="0"/>
        <label for="age">Age </label>
        <hr>
        <p>What products are you interested in?</p>
        <input type="radio" id="smartphones" name="products" value="Smartphones">
        <label for="smartphones">Smartphones</label><br>
        <input type="radio" id="pc" name="products" value="PC/Laptops/Monitors">
        <label for="pc">PC/Laptops/Monitors</label><br>
        <input type="radio" id="whiteAppl" name="products" value="White Appliances">
        <label for="whiteAppl">White Appliances</label><br>
        <input type="radio" id="tv" name="products" value="TV/Entertainment">
        <label for="tv">TV/Entertainment</label><br>
        <input type="radio" id="other" name="products" value="Other">
        <label for="other">Other</label><br>
        <hr>
        <p>Do you want to receive email notifications?</p>
        <input type="radio" id="yes" name="notifications" value="Yes">
        <label for="yes">Yes</label><br>
        <input type="radio" id="no" name="notifications" value="No">
        <label for="no">No</label><br>

        <input type="submit" name="submit" value="Submit" class="login-button">
        <input type="reset" name="reset" value="Reset" class="login-button">
        <p><a href="logout.php">Logout</a></p>
    </form>
    <?php
        }
    ?>
</body>
</html>