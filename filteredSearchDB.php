<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Search result</title>
    <link rel="stylesheet" href="style.css"/>
    <style>
            table, th, td {
                border: 1px solid black;
                text-align: center;
                background: #ccf2ff;
            } 
            th, h3 {
                color: red;
            }
            .form {
                width: 51%;
                padding: 30px 25px;
            }
            h2 {
                text-align: center;
                color: red;
            }
            .bold {
                font-weight: bold;
            }
    </style>
</head>
<body>

        <?php
            session_start();
            $interests = $_SESSION['interest'];
            $gender = $_SESSION['gender'];
            $visitorAge = $_SESSION['age'];
            $notifications = $_SESSION['notifications'];

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "usersdatabase";
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                echo "<div class='form'>
                <h3>Connection to 'Database' failed!</h3><br/>
                <p class='link'>Click here to try the <a href='searchForm.php'>search </a> again.</p>
                </div>";
                die(""); 
            }

            if($visitorAge==="child") {
                $upperAgeLimit = 17;
                $lowerAgeLimit = 0;
            }else if ($visitorAge==="young") {
                $upperAgeLimit = 29;
                $lowerAgeLimit = 18;
            }else if ($visitorAge==="middle-aged") {
                $upperAgeLimit = 49;
                $lowerAgeLimit = 30;
            }else if ($visitorAge==="old") {
                $upperAgeLimit = 150;
                $lowerAgeLimit = 50;
            }

            if ($gender==="all") {
                $sql = "SELECT id, firstname, lastname, email, phone_Number, gender, age, interests, notifications, sended_date FROM usersubmissions 
                WHERE interests='$interests' AND age<=$upperAgeLimit AND age>=$lowerAgeLimit AND notifications='$notifications'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    echo "<div class='form'>
                    <h2>The data based on the search that was done</h2>
                    <table><tr><th>ID</th><th>Name</th><th>Lastname</th><th>Email</th><th>Telephone</th><th>gender</th>
                    <th>Age</th><th>Interests</th><th>Notifications</th><th>Submission Date</th></tr>";
                // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>".$row["id"]."</td><td>".$row["firstname"]."</td><td>".$row["lastname"]."</td><td>".$row["email"]."</td><td>".$row["phone_Number"]."</td>
                        <td class='bold'>".$row["gender"]."</td><td class='bold'>".$row["age"]."</td><td class='bold'>".$row["interests"]."</td><td class='bold'>".$row["notifications"]."</td><td>".$row["sended_date"]."</td></tr>";
                    }
                    echo "</table>
                    <p class='link'>Click here to <a href='searchForm.php'>search </a> again.</p>
                    </div>";
                } else {
                    echo "<div class='form'>
                        <h3>0 Results</h3>
                        <p class='link'>Click here to <a href='searchForm.php'>search </a> again.</p>
                    </div>";
                }
            }else {
                $sql = "SELECT id, firstname, lastname, email, phone_Number, gender, age, interests, notifications, sended_date FROM usersubmissions 
                WHERE interests='$interests' AND age<=$upperAgeLimit AND age>=$lowerAgeLimit AND notifications='$notifications' AND gender='$gender'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    echo "<div class='form'>
                    <h2>The data based on the search that was done</h2>
                    <table><tr><th>ID</th><th>Name</th><th>Lastname</th><th>Email</th><th>Telephone</th><th>gender</th>
                    <th>Age</th><th>Interests</th><th>Notifications</th><th>Submission Date</th></tr>";
                // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>".$row["id"]."</td><td>".$row["firstname"]."</td><td>".$row["lastname"]."</td><td>".$row["email"]."</td><td>".$row["phone_Number"]."</td>
                        <td class='bold'>".$row["gender"]."</td><td class='bold'>".$row["age"]."</td><td class='bold'>".$row["interests"]."</td><td class='bold'>".$row["notifications"]."</td><td>".$row["sended_date"]."</td></tr>";
                    }
                    echo "</table>
                    <p class='link'>Click here to <a href='searchForm.php'>search </a> again.</p>
                    </div>";
                } else {
                    echo "<div class='form'>
                        <h3>0 Results</h3>
                        <p class='link'>Click here to <a href='searchForm.php'>search </a> again.</p>
                    </div>";
                }
            }
            $conn->close();
        ?>

</body>
</html>