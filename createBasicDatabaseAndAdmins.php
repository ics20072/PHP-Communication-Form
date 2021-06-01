<?php
    $servername = "localhost";
    $username = "root";
    $password = "";

    $conn = new mysqli($servername, $username, $password);

    if ($conn->connect_error) {
        die("Connection failed: ".$conn->connect_error);
    }

    $sql = "CREATE DATABASE IF NOT EXISTS LoginSystem"; /*Create initial databases when running the program 
    if it is running for the first time and the database has not already been created*/

    if($conn->query($sql)===TRUE) {
        $dbname = "LoginSystem";
        $newConn = new mysqli($servername, $username, $password, $dbname);

        if ($newConn->connect_error){
            die("Cnonnection failed: ".$newConn->connect_error);
        }

        /*Create a table with the login details of the administrators*/
        $newSql = "CREATE TABLE administrators(
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            username varchar(50) NOT NULL,
            password varchar(50) NOT NULL,
            email varchar(50) NOT NULL,
            creation_date TIMESTAMP
        )";

        if ($newConn->query($newSql)===TRUE) {
            /*Create a table with the login details of the visitors*/
            $newSql2 = "CREATE TABLE visitors(
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                username varchar(50) NOT NULL,
                password varchar(50) NOT NULL,
                email varchar(50) NOT NULL,
                create_datetime TIMESTAMP
            )";

            if ($newConn->query($newSql2)===TRUE) {
                /*Create two administrators and enter them into the database.*/
                $create_datetime = date("Y-m-d H:i:s");
                $password = "12345";
        
                $query = "INSERT into `administrators` (username, password, email, creation_date)
                VALUES ('admin1', '" . md5($password) . "', 'admin1@gmail.com', '$create_datetime');";
        
                $query .= "INSERT into `administrators` (username, password, email, creation_date)
                VALUES ('admin2', '" . md5($password) . "', 'admin2@gmail.com', '$create_datetime')";
                $newConn->multi_query($query);
            }
        }
        $newConn->close();
    }  
    $conn->close();
?>

