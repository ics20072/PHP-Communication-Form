<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Welcome to the registration search form!</title>
    <link rel="stylesheet" href="style.css"/>
    <style>
        .italicFont {
            color: red;
            font-style: italic;
        }
        .search-input {
            font-size: 15px;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 25px;
            height: 17px;
            width: calc(49% - 23px);
            margin-bottom: 3px;
        }
        .search-button {
            color: #fff;
            background: #55a1ff;
            border: 0;
            outline: 0;
            width: 100%;
            height: 40px;
            font-size: 16px;
            text-align: center;
            cursor: pointer;
            margin-top: 3px;
        }
        .red {
            color: red;
        }
    </style>
</head>
<body>

    <?php
        if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['searchRecordSimple'])) {
            $firstname = $_REQUEST['firstName'];
            $firstname = str_replace(' ', '', $firstname);
            $surname = $_REQUEST['lastName'];
            $surname = str_replace(' ', '', $surname);

            if ($firstname==="" && $surname==="") {
                echo "<div class='form'>
                <h3 class='red'>You have not entered any data to search!</h3><br/>
                <p class='link'>Click here to <a href='searchForm.php'>search </a> again.</p>
                </div>";
            }else {
                session_start();
                $_SESSION['firstname'] = $firstname;
                $_SESSION['lastname'] = $surname;
                header("Location: searchDB.php");
            }
        }else {
    ?>
    <form class="form"  method="post">
        <h1 class="login-title">Registration search</h1>
        <hr>
        <h3>Simple search by <span class="italicFont">Name</span> or <span class="italicFont">Surname </span>or both</h3>
        <input type="text" class="search-input" name="firstName" placeholder="Firstname">
        <input type="text" class="search-input" name="lastName" placeholder="Surname">
        <input type="submit" value="Search" name="searchRecordSimple" class="search-button"/>
        <hr>
        <h3>Search for records with <span class="italicFont">filters</span></h3>
        <p class='link'>Click here to <a href='administratorPage.php'> move to Management Page</a> again.</p>
    </form>

    <?php
        }
    ?>

</body>
</html>