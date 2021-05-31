<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>All Database data</title>
    <link rel="stylesheet" href="style.css"/>
    <style>
            table, th, td {
                border: 1px solid black;
                text-align: center;
            } 
            th {
                color: red;
            }
            .form {
                width: 51%;
                padding: 30px 25px;
            }
    </style>
</head>
<body>

    <?php
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
            <p class='link'>Click here to <a href='administratorPage.php'> move to Management Page</a> again.</p>
            </div>";
            die(""); 
        }
        $sql = "SELECT id, firstname, lastname, email, phone_Number, gender, age, interests, notifications, sended_date FROM usersubmissions";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<div class='form'>
            <table><tr><th>ID</th><th>Name</th><th>Lastname</th><th>Email</th><th>Telephone</th><th>gender</th>
            <th>Age</th><th>Interests</th><th>Notifications</th><th>Submission Date</th></tr>";
        // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["id"]."</td><td>".$row["firstname"]."</td><td>".$row["lastname"]."</td><td>".$row["email"]."</td><td>".$row["phone_Number"]."</td>
                <td>".$row["gender"]."</td><td>".$row["age"]."</td><td>".$row["interests"]."</td><td>".$row["notifications"]."</td><td>".$row["sended_date"]."</td></tr>";
            }
            echo "</table>
            <p class='link'>Click here to <a href='administratorPage.php'> move to Management Page</a> again.</p>
            </div>";
        } else {
            echo "<div class='form'>
                <h3>0 Results</h3>
                <p class='link'>Click here to <a href='administratorPage.php'> move to Management Page</a> again.</p>
            </div>";
        }
        $conn->close();  
    ?>

</body>
</html>