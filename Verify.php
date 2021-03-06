<?php
    require_once '../Processes/Database_Functions.php';
    session_start();
    $conn = connect();
    $result = null;

    if (isset($_POST["close"])) {
        header('location: Dashboard.php');
    }

    if (isset($_POST["verify"])) {
        $username = $_SESSION["username"];
        $stmt = $conn->prepare("SELECT vkey FROM clients WHERE Username=?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            mysqli_stmt_bind_result($stmt, $ver_code);
            mysqli_stmt_fetch($stmt);
            $a = $_POST["code"];
            if ($ver_code == $_POST["code"]) {
                $stmt = $conn->prepare("UPDATE clients SET Verified='1' WHERE Username='$username' ");
                if ($stmt->execute()) {
                    $result = true;
                    $_SESSION["verified"] = 1;
                    header("location: ../User_Portals/Dashboard.php");
                }
            }
            else {
                $result = false;
            }
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
                <a href="../Index/Antonio's_Home.php"> <img src="../Images/sponge.png" alt="" style="outline: none"> </a>
            </div>
            <h1 class="page_heading">Verify Account</h1>
            <h1 class="username"><i><?php echo $_SESSION['username']?></h1>
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
                        <div class="recipes-grid-item">
                            <form action="Verify.php" method="post">
                                <h1><label>Enter Account Verification Code:
                                        <input type="number" name="code">
                                    </label>
                                </h1>

                                <div class="buttons">
                                    <input name="verify" type="submit" class="div_button add" value="Verify">
                                    <input name="close" type="submit" class="div_button like" value="Close">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php
        if($result === false) {
            ?>
            <div class="alert" style="display: block; background-color: red; color: black;font-weight: bolder">
                <span class="close_btn" onclick="this.parentElement.style.display = 'none';">&times;</span>
                <p>Verification Failed!</p>
            </div>
            <?php
        }
        ?>
    </section>
</main>

<script type="text/javascript" src="../Processes/Side_Navigation.js"></script>
</body>
</html>