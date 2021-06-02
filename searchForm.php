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
        h4 {
            margin-top: 3px;
            margin-bottom: 2px;
        }
        input {
            margin-top: 2px;
        }
        hr {
            border: 2px solid rgb(128, 128, 128);
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
                header("Location: simpleSearchDB.php");
            }
        }else if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['searchWithFilters'])) {
            if (isset($_POST['customerInterests']))    
                $interestForProducts = $_REQUEST['customerInterests'];
            else
                $interestForProducts = "";

            if (isset($_POST['gender']))   
                $visitorGender = $_REQUEST['gender'];
            else
                $visitorGender = "";

            if (isset($_POST['selectAge']))   
                $visitorAge = $_REQUEST['selectAge'];
            else
                $visitorAge = "";

            if (isset($_POST['takesNotifications']))   
                $notifications = $_REQUEST['takesNotifications'];
            else
                $notifications = "";

            if ($interestForProducts==="" || $visitorAge==="" || $visitorGender==="" || $notifications==="") {
                echo "<div class='form'>
                <h3 class='red'>There are fields where you have not selected anything!</h3><br/>
                <p class='link'>Click here to <a href='searchForm.php'>search </a> again.</p>
                </div>";
            }else {
                session_start();
                $_SESSION['interest'] = $interestForProducts;
                $_SESSION['gender'] = $visitorGender;
                $_SESSION['age'] = $visitorAge;
                $_SESSION['notifications'] = $notifications;
                header("Location: filteredSearchDB.php");
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
        <h4>*Choose the interest of a customer</h4>
        <input type="radio" id="Smartphones" name="customerInterests" value="Smartphones">
        <label for="Smartphones">Smartphones</label><br>
        <input type="radio" id="PcLaptopsMonitors" name="customerInterests" value="PC/Laptops/Monitors">
        <label for="PcLaptopsMonitors">PC/Laptops/Monitors</label><br>
        <input type="radio" id="WhiteAppliances" name="customerInterests" value="White Appliances">
        <label for="WhiteAppliances">White Appliances</label><br>
        <input type="radio" id="TV_Entertainment" name="customerInterests" value="TV/Entertainment">
        <label for="TV_Entertainment">TV/Entertainment</label><br>
        <input type="radio" id="Other" name="customerInterests" value="Other">
        <label for="Other">Other</label><br><br>
        <h4>*Choose gender:</h4>
        <input type="radio" id="male" name="gender" value="male">
        <label for="male">Male</label><br>
        <input type="radio" id="female" name="gender" value="female">
        <label for="female">Female</label><br>
        <input type="radio" id="all" name="gender" value="all">
        <label for="all">All</label><br><br>
        <h4>*Choose Age:</h4>
        <input type="radio" id="child" name="selectAge" value="child">
        <label for="child">0-17 years old</label><br>
        <input type="radio" id="young" name="selectAge" value="young">
        <label for="young">18-29 years old</label><br>
        <input type="radio" id="middle-aged" name="selectAge" value="middle-aged">
        <label for="middle-aged">30-49 years old</label><br>
        <input type="radio" id="old" name="selectAge" value="old">
        <label for="old">50+ yeards old</label><br><br>
        <h4>*Receives notifications?</h4>
        <input type="radio" id="yes" name="takesNotifications" value="Yes">
        <label for="yes">YES</label><br>
        <input type="radio" id="no" name="takesNotifications" value="No">
        <label for="no">NO</label><br><br>
        <input type="submit" value="Search" name="searchWithFilters" class="search-button"/>
        <p class='link'>Click here to <a href='administratorPage.php'> move to Management Page</a> again.</p>
    </form>

    <?php
        }
    ?>

</body>
</html>