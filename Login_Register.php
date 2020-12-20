<?php
require_once '../Processes/Database_Functions.php';

//variables for alert divs
$login_result = null;
$sign_up = null;

//call to login function in file: Database_Functions
if (isset($_POST['login-button'])) {
    $login_result = user_login($_POST['username'], $_POST['password']);
    ($login_result == 1)? header("location: ../User_Portals/Dashboard.php") : $login_string = "Login Failed!";
}

//call to sign up function in file: Database_Functions
if (isset($_POST['sign-up-button'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $contact = $_POST['phone'];
    $username = $_POST['sign_username'];
    $password = $_POST['sign_password'];

    //actual function call and pass user input
    if (create_account($first_name, $last_name, $email, $contact, $username, $password)) {
        $sign_up = true; //if the process is successful
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0,
            minimum-scale=1.0 ">

    <link rel="icon" type="image/png" href="../Images/login.png">
    <link rel="stylesheet" type="text/css" href="../Processes/Header.css">
    <link rel="stylesheet" type="text/css" href="../Processes/Page_Content.css">
    <link rel="stylesheet" type="text/css" href="../Processes/Alert.css">
    <link rel="stylesheet" type="text/css" href="Login_Register.css">
    <title>Antonio's</title>
</head>

<body>
    <header>
        <div class="container">
            <nav>
                <div class="nav-brand">
                    <a href="../Index/Antonio's_Home.php"> <img src="../Images/sponge.png" alt="" style="outline: none"> </a>
                </div>

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
                        <a href="#" class="nav-link">Catering</a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">About US</a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">Reach Us</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section class="hero">

            <!--            sign up form-->
            <div class="sign-up">
                <p>Sign Up</p>
                <span>Kindly fill in the details below to create your account.</span>
                <div class="sign-up-form">
                    <form action="Login_Register.php" method="POST">
                        <div class="fields">
                            <label for="fn">First Name</label>
                            <label for="ln">Last Name</label><br>
                            <input type="text" name="first_name" required minlength="2" maxlength="12" id="fn">
                            <input type="text" name="last_name" required minlength="2" maxlength="12" id="ln">
                        </div>
                        <div class="fields">
                            <label for="ph">Phone</label>
<!--                            <label for="ad">Address</label><br>-->
                            <input type="number" name="phone" required minlength="2" maxlength="10" id="ph">
<!--                            <input type="text" name="address" required minlength="2" maxlength="15" id="ad">-->
                        </div>
                        <div class="fields">
                            <label for="em">Email</label>
                            <label for="user">Username</label><br>
                            <input type="email" name="email" required id="em">
                            <input type="text" name="sign_username" required minlength="6" maxlength="10" id="user">
                        </div>
                        <div class="fields">
                            <label for="spa">Password</label>
                            <label for="cp">Confirm Password</label><br>
                            <input type="password" name="sign_password" required minlength="8" id="spa">
                            <input type="password" name="cp"  required minlength="8" id="cp">
                        </div>
                        <div class="cta">
                            <span>By creating an account you agree to our <i><a href="#">Terms & Privacy</a></i>.</span>
                            <input class="btn" type="submit" name="sign-up-button" value="Submit">
                            <a href="#" class="btn">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>

            <!--            login form-->
            <div class="login">
                <p>Login</p>
                <form action="Login_Register.php" method="POST">
                    <div class="login-form">
                        <label for="us">Username</label>
                        <input type="text" name="username" placeholder="Enter Username" required minlength="6" id="us">
                        <label for="pa">Password</label>
                        <input type="password" name="password" placeholder="Enter Password" required minlength="8" id="pa">
                    </div>
                    <div class="l-cta">
                        <input class="btn" type="submit" value="Login" name="login-button">
                        <a href="#" class="forgot"><i>Forgot Password?</i></a>
                    </div>
                </form>
            </div>

            <!--            login alert-->
            <?php
                if(is_numeric($login_result)) {
            ?>
            <div class="alert" style="display: block">
                <span class="close_btn" onclick="this.parentElement.style.display = 'none';">&times;</span>
                <p><?php echo $login_string?></p><br>
                <p><a href="../User_Portals/forgotPassword.php">Forgot Password?</a></p>
            </div>
            <?php
                }
            ?>

            <!--            sign up alert-->
            <?php
            if($sign_up === true) {
                ?>
                <div class="alert" style="display: block; background-color: aquamarine; color: black;font-weight: bolder">
                    <span class="close_btn" onclick="this.parentElement.style.display = 'none';">&times;</span>
                    <p>Account Created Successfully!</p>
                </div>
                <?php
            }
            ?>
        </section>
    </main>
    <script type="text/javascript" src="../Processes/Side_Navigation.js"></script>
</body>
</html>