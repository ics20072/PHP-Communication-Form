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
        $firstName = $_SESSION['firstname'];
        $lastName = $_SESSION['lastname'];

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

        if ($firstName!="" && $lastName!="") {
            $sql = "SELECT id, firstname, lastname, email, phone_Number, gender, age, interests, notifications, sended_date FROM usersubmissions WHERE firstname='$firstName' AND lastname='$lastName'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo "<div class='form'>
                <h2>The data based on the search that was done</h2>
                <table><tr><th>ID</th><th>Name</th><th>Lastname</th><th>Email</th><th>Telephone</th><th>gender</th>
                <th>Age</th><th>Interests</th><th>Notifications</th><th>Submission Date</th></tr>";
            // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>".$row["id"]."</td><td class='bold'>".$row["firstname"]."</td><td class='bold'>".$row["lastname"]."</td><td>".$row["email"]."</td><td>".$row["phone_Number"]."</td>
                    <td>".$row["gender"]."</td><td>".$row["age"]."</td><td>".$row["interests"]."</td><td>".$row["notifications"]."</td><td>".$row["sended_date"]."</td></tr>";
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
        }else if ($firstName!="" && $lastName==="") {
            $sql = "SELECT id, firstname, lastname, email, phone_Number, gender, age, interests, notifications, sended_date FROM usersubmissions WHERE firstname='$firstName'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo "<div class='form'>
                <h2>The data based on the search that was done</h2>
                <table><tr><th>ID</th><th>Name</th><th>Lastname</th><th>Email</th><th>Telephone</th><th>gender</th>
                <th>Age</th><th>Interests</th><th>Notifications</th><th>Submission Date</th></tr>";
            // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>".$row["id"]."</td><td class='bold'>".$row["firstname"]."</td><td>".$row["lastname"]."</td><td>".$row["email"]."</td><td>".$row["phone_Number"]."</td>
                    <td>".$row["gender"]."</td><td>".$row["age"]."</td><td>".$row["interests"]."</td><td>".$row["notifications"]."</td><td>".$row["sended_date"]."</td></tr>";
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
            $sql = "SELECT id, firstname, lastname, email, phone_Number, gender, age, interests, notifications, sended_date FROM usersubmissions WHERE lastname='$lastName'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo "<div class='form'>
                <h2>The data based on the search that was done</h2>
                <table><tr><th>ID</th><th>Name</th><th>Lastname</th><th>Email</th><th>Telephone</th><th>gender</th>
                <th>Age</th><th>Interests</th><th>Notifications</th><th>Submission Date</th></tr>";
            // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>".$row["id"]."</td><td>".$row["firstname"]."</td><td class='bold'>".$row["lastname"]."</td><td>".$row["email"]."</td><td>".$row["phone_Number"]."</td>
                    <td>".$row["gender"]."</td><td>".$row["age"]."</td><td>".$row["interests"]."</td><td>".$row["notifications"]."</td><td>".$row["sended_date"]."</td></tr>";
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