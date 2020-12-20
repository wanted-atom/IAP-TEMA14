<?php
    require_once '../Processes/Database_Functions.php';
    session_start();
    $process_string = null;
    $process_result = null;

    //delete Recipe from personal collection
    if (isset($_POST["Delete_Recipe_button"])) {
        $conn = connect();
        $stmt = $conn->prepare("DELETE FROM user_recipes WHERE RecordID=?");
        $stmt->bind_param('s', $_POST["ID"]);
        $stmt->execute();
        $process_string = "Recipe Deleted!";
        $process_result = true;
    }

        //load user account details to be used in the settings form
        $conn = connect();
        $username = $_SESSION["username"];
        $stmt = ("SELECT * FROM clients WHERE Username ='$username' LIMIT 1");
        $result = $conn->query($stmt);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $first_name = $row["FirstName"];
                $last_name = $row["LastName"];
                $contact = $row["ContactDetails"];
                $email = $row["EmailAddress"];
                $username = $row["Username"];
                $password = $row["Password"];
            }
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0,
            minimum-scale=1.0 ">
    <link rel="icon" type="image/png" href="../Images/1.png">
    <link rel="stylesheet" type="text/css" href="../Processes/Header.css">
    <link rel="stylesheet" type="text/css" href="../Processes/Page_Content.css">
    <link rel="stylesheet" type="text/css" href="../Processes/Alert.css">
    <link rel="stylesheet" type="text/css" href="Modals.css">
    <link rel="stylesheet" type="text/css" href="Common_Account_styling.css">
    <title>Antonio's</title>
</head>
<body>
<header>
    <div class="container">
        <nav>
            <div class="nav-brand">
                <a href="../Index/Antonio's_Home.php"> <img src="../Images/sponge.png" alt="" style="outline: none"> </a>
            </div>
            <h1 class="page_heading">My Dashboard</h1>
            <h1 class="username"><i><?php echo $_SESSION["username"]?></i></h1>
            <div class="menu-icons open">
                <img src="../Images/menu.png" alt="">
            </div>

            <ul class="nav-list">
                <div class="menu-icons close">
                    <i><img src="../Images/close.png" alt=""></i>
                </div>

                <li class="nav-item">
                    <a href="../Index/Antonio's_Home.php" class="nav-link">Home</a>
                </li>

                <li class="nav-item">
                    <a href="CookBook.php" class="nav-link">Cook Book</a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">Reach Us</a>
                </li>

                <li class="nav-item">
                    <p class="nav-link" onclick="openForm_profile()">Settings</p>
                </li>

                <li class="nav-item">
                    <a href="Logout.php" class="nav-link">Log Out</a>
                </li>
            </ul>
        </nav>
    </div>
</header>

<main>
    <!--    main content-->
    <section class="hero">
        <div class="main-message container">
            <section class="page_content">
                <div class="container">
                    <div class="recipes-grid" id="recipes">
                        <?php
                            global $conn;
                            $name = $_SESSION["username"];
                            $images = $conn->query("SELECT * FROM user_recipes WHERE Username='$name'");
                            if ($images->num_rows > 0) {
                                while ($item = $images->fetch_assoc()) {
                        ?>
                        <div class="recipes-grid-item"
                             style="background-image: linear-gradient(135deg, rgba(227, 112, 83,0.2) 0%,
                                     rgba(152, 43, 65, 0.7) 100%), url('<?php echo $item["Image_Name"]?>'); ">
                            <form action="User_Page.php" method="post">
                                <h1><?php echo $item["Food_Name"]?></h1>
<!--                                <p>--><?php //echo $item["Category"]?><!--</p><br>-->
                                <p><?php echo $item["Prep_Time"]?></p><br>
                                <p><?php echo $item["Ingredients"]?></p><br>
                                <div class="buttons">
                                    <label>
                                        <input name="ID" type="text" value="<?php echo $item["RecordID"]?>" class="hide">
                                    </label>
                                    <input name="Delete_Recipe_button" type="submit" class="div_button delete" value="Delete" id="sub">
                            </form>
                            <form action="User_Page.php" method="post">
                                <label>
                                    <input name="ID" type="text" value="<?php echo $item["RecordID"]?>" class="hide">
                                </label>
                                <input name="Edit_Button" type="submit" class="div_button edit" value="Rate" >
                            </form>
                                </div>
                        </div>
                        <?php
                                }
                            }
                        else {
                            $process_result = false;
                            $process_string = "Explore Our Cook book For New Heavenly Recipes. Find It In The Navigation Menu On The Right!";
                        }
                        ?>
                    </div>
                </div>
            </section>
        </div>
    </section>

    <!-- my profile modal-->
    <div class="upload form-settings" id="settings">
        <form action="../Processes/Database_Functions.php" method="post" class="form-upload form-settings">
            <h1>My Account</h1>
            <label for="first_name">First Name:</label>
            <input id="first_name" minlength="2" name="first_name" required type="text" value="<?php echo $first_name?>">

            <label for="last_name">Last Name:</label>
            <input id="last_name" minlength="2" name="last_name" required type="text" value="<?php echo $last_name?>">

            <label for="contact">Contact:</label>
            <input id="contact" minlength="2" name="contact" required type="text" value="<?php echo $contact?>">

            <label for="email">Email Address:</label>
            <input id="email" minlength="2" name="email" required type="text" value="<?php echo $email?>">

            <label for="username">Username:</label>
            <input id="username" name="update_username" required minlength="6" type="text" value="<?php echo $username?>">

            <label for="password">Password:</label>
            <input id="password" name="update_password" required minlength="8" type="text" value="<?php echo $password?>">
            <div class="form-btn">
                <input name="update-button" type="submit" class="btn first" value="Update">
                <button class="btn cancel" onclick="show_delete_btn()">Delete Account</button>
                <input name="delete-button" type="submit" class="btn cancel delete" value="Confirm Delete" id="delete_button">
                <p class="btn cancel" onclick="closeForm_profile()">Close</p>
            </div>
        </form>
    </div>

<!--    Failed alert-->
    <?php
        if ($process_result === false) {
    ?>
            <div class="alert" style="display: block" id="alert">
                <span class="close_btn" onclick="this.parentElement.style.display = 'none';">&times;</span>
                <p><?php echo $process_string; ?></p>
            </div>
    <?php
        }
    ?>
<!--    successful alert-->
    <?php
        if ($process_result === true) {
    ?>
            <div class="alert" id="alert">
                <span class="close_btn" onclick="this.parentElement.style.display = 'none';">&times;</span>
                <p><?php echo $process_string; ?></p>
            </div>
    <?php
        }
    ?>

</main>
<script type="text/javascript" src="../Processes/Side_Navigation.js"></script>
<script type="text/javascript" src="Modals.js"></script>

</body>
</html>