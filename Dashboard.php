<?php
session_start();
$name = $_SESSION["AccountType"];
$Account_verified = $_SESSION["verified"];
if ($Account_verified == 1) {
    ($name === "user")? header("location: ../User_Portals/User_Page.php") : header("location: ../User_Portals/Admin_Page.php");
}
else {
    header("location: ../User_Portals/Verify.php");
}

