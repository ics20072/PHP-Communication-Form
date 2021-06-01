<?php
    //include auth_session.php file on all user panel pages
    include("auth_session.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Management page</title>
    <link rel="stylesheet" href="style.css"/>
    <style>
    .login-button {
            margin-bottom: 8px;
        }
    .search-button {
        color: #fff;
        background: #0059b3;
        border: 0;
        outline: 0;
        width: 40%;
        height: 45px;
        font-size: 16px;
        text-align: center;
        cursor: pointer;
        border-radius: 15%;
        margin-bottom: 8px;
        }
    </style>
</head>
<body>

    <?php
        
        if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['createDB'])) {
            header("Location: createDB.php");
        }

        if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['details'])) {
            header("Location: showDB.php");
        }
    ?>

    <form class="form" method="post">
        <h1 class="login-title">Management page</h1>
        <p>Hey, <?php echo $_SESSION['username']; ?>!</p>
        <input type="submit" value="Search" name="searchRecord" class="search-button"/>
        <input type="submit" value="Create Database" name="createDB" class="login-button"/>
        <input type="submit" value="Show details" name="details" class="login-button"/>
        <p><a href="logout.php">Logout</a></p>
    </form>
</body>
</html>