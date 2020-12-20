<?php
require_once '../Processes/Database_Functions.php';
    session_start();
    $conn = connect();
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
            <h1 class="page_heading">User Collection</h1>
            <h1 class="username"><i><?php echo $_SESSION["username"]?></i></h1>
            <div class="menu-icons open">
                <img src="../Images/menu.png" alt="">
            </div>
            <ul class="nav-list">
                <div class="menu-icons close">
                    <i><img src="../Images/close.png" alt=""></i>
                </div>

                <li class="nav-item">
                    <a href="#" class="nav-link">Home</a>
                </li>

                <li class="nav-item">
                    <a href="Admin_Page.php" class="nav-link">Dashboard</a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">Reach Us</a>
                </li>

                <li class="nav-item">
                    <a href="Logout.php" class="nav-link">Log Out</a>
                </li>
            </ul>
        </nav>
    </div>
</header>

<main>
    <section class="hero">
        <div class="main-message container" >
            <section class="page_content">
                <div class="container">
                    <div class="recipes-grid" id="recipes">
                        <?php
                            global $conn;
                            $images = $conn->query("SELECT * FROM clients WHERE AccountType='User' ");

                            if ($images->num_rows > 0) {
                                while ($item = $images->fetch_assoc()) {
                        ?>
                        <div class="recipes-grid-item"
                             style="background-image: linear-gradient(135deg, rgba(227, 112, 83,0.2) 0%,
                                     rgba(102, 43, 65, 0.7) 100%), url('<?php echo $item["Image_Name"]?>');
                                     background-size: cover;
                                     background-repeat: no-repeat;
                                     background-position: center ">
                            <form action="CookBook.php" method="post">
                                <h1><?php echo $item["FirstName"]." ". $item["LastName"]?></h1>
                                <p><?php echo $item["EmailAddress"]?></p><br>
                                <p><?php echo $item["ContactDetails"]?></p><br
                                <p><?php echo $item["Username"]?></p><br>
                                <div class="buttons">
                                    <label>
                                        <input name="ID" type="text" value="<?php echo $item["ClientID"]?>" class="hide">
                                    </label>
                                    <input name="Add_Button" type="submit" class="div_button add" value="Message">
                                    <input name="Like_button" type="submit" class="div_button like" value="Delete">
                                </div>
                            </form>
                        </div>
                        <?php
                                }
                            }
                        ?>
                    </div>
                </div>
            </section>
        </div>
<!--        --><?php
//        if($add_result === true) {
//            ?>
<!--            <div class="alert" style="display: block; background-color: aquamarine; color: black;font-weight: bolder">-->
<!--                <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span>-->
<!--                <p>Recipe Added!</p>-->
<!--            </div>-->
<!--            --><?php
//        }
//        ?>
    </section>
</main>

<script type="text/javascript" src="../Processes/Side_Navigation.js"></script>
</body>
</html>