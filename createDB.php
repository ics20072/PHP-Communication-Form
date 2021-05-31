<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href="style.css"/>
    <style>
        .red {
            color: red;
        }
        .allGood {
            color: green;
        }
    </style>
</head>
<body>

    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";

        $conn = new mysqli($servername, $username, $password);

        if ($conn->connect_error) {
            echo "<div class='form'>
            <h3 class='red'>Connection to 'localhost' failed!</h3><br/>
            <p class='link'>Click here to <a href='administratorPage.php'> move to Management Page</a> again.</p>
            </div>";
            die(""); 
        }

        $sql = "CREATE DATABASE usersDatabase";
        if ($conn->query($sql)===TRUE) {
            $dbname = "usersDatabase";
            $newConn = new mysqli($servername, $username, $password, $dbname);

            if ($newConn->connect_error) {
                echo "<div class='form'>
                <h3 class='red'>Connection failed!</h3><br/>
                <p class='link'>Click here to <a href='administratorPage.php'> move to Management Page</a> again.</p>
                </div>";
            }else {
                $newSql = "CREATE TABLE userSubmissions (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                firstname VARCHAR(30) NOT NULL,
                lastname VARCHAR(30) NOT NULL,
                email VARCHAR(50),
                phone_Number VARCHAR(15),
                gender VARCHAR(10),
                age INT(6),
                interests VARCHAR(50),
                notifications VARCHAR(3),
                sended_date TIMESTAMP
                )";

                if($newConn->query($newSql)===TRUE) {
                    echo "<div class='form'>
                    <h3 class='allGood'>Database and Table created Successfully!</h3><br/>
                    <p class='link'>Click here to <a href='administratorPage.php'> move to Management Page</a> again.</p>
                    </div>";
                }else {
                    echo "<div class='form'>
                    <h3 class='red'>Error creating Table for Database!</h3><br/>
                    <p class='link'>Click here to <a href='administratorPage.php'> move to Management Page</a> again.</p>
                    </div>";
                    die($newConn->error);
                }
            }
            $newConn->close();
        }else {
            echo "<div class='form'>
            <h3 class='red'>Database already Created!</h3><br/>
            <p class='link'>Click here to <a href='administratorPage.php'> move to Management Page</a> again.</p>
            </div>";
        }

        $conn->close();
    ?>

</body>
</html>