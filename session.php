<?php
session_start();
echo $_SESSION["Sanne"] = "pretty";

setcookie("password", "123456789");
echo $_COOKIE["password"];