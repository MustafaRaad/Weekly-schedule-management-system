<?php
// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  header("location: /wsms/pages/home.php");
  exit;
} else{
  header("location: /wsms/pages/users/user_login.php");
}
