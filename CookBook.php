<?php
    require_once '../Processes/Database_Functions.php';
    session_start();
    $add_result = null;
    //Add recipe to users personal collection
    if (isset($_POST["Add_Button"])) {

        //add recipe into the table user_recipes
        $conn = connect();
        $stmt = $conn->prepare("INSERT INTO user_recipes (RecordID, Food_Name, Category, Prep_Time, Ingredients,
                          Description, Image_Name) SELECT * FROM fooditems WHERE Record_ID=?");
        $stmt->bind_param('s', $_POST["ID"]);
        $stmt->execute();

        //add the users username to the record above
        $stmt = $conn->prepare("UPDATE user_recipes SET Username=? WHERE RecordID=?");
        $stmt->bind_param('ss', $_SESSION["username"], $_POST["ID"]);
        if ($stmt->execute()) {
            $add_result = true;
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
    <link rel="stylesheet" type="text/css" href="Common_Account_styling.css">
    <title>Antonio's</title>
</head>
<body>
<header>
    <div class="container">
        <nav>
            <div class="nav-brand">
                <a href="../Index/Antonio's_Home.php"><img src="../Images/sponge.png" alt="" style="outline: none"> </a>
            </div>
            <h1 class="page_heading">Cook Book</h1>
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
                    <a href="Dashboard.php" class="nav-link">Dashboard</a>
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

                            $conn = connect();
                            $images = $conn->query("SELECT * FROM fooditems");
                            if ($images->num_rows > 0) {
                                while ($item = $images->fetch_assoc()) {
                        ?>
                        <div class="recipes-grid-item"
                             style="background-image: linear-gradient(135deg, rgba(227, 112, 83,0.2) 0%,
                                     rgba(102, 43, 65, 0.7) 100%), url('<?php echo $item["Image_Name"]?>');">
                            <form action="CookBook.php" method="post">
                                <h1><?php echo $item["Food_Name"]?></h1>
<!--                                <p>--><?php //echo $item["Category"]?><!--</p>-->
                                <p><?php echo $item["Prep_Time"]?></p>
                                <p><?php echo $item["Ingredients"]?></p>
                                <div class="buttons">
                                    <label>
                                        <input name="ID" type="text" value="<?php echo $item["Record_ID"]?>" class="hide">
                                    </label>
                                    <input name="Add_Button" type="submit" class="div_button add" value="Add">
                                    <input name="Like_button" type="submit" class="div_button like" value="Like">
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
        <?php
        if($add_result === true) {
            ?>
            <div class="alert">
                <span class="close_btn" onclick="this.parentElement.style.display = 'none';">&times;</span>
                <p>Recipe Added!</p>
            </div>
            <?php
        }
        ?>
    </section>
</main>

<script type="text/javascript" src="../Processes/Side_Navigation.js"></script>
</body>
</html>