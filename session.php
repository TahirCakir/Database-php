<?php
// Start the session
session_start();

// if the user is already logged in then redirect user to welcome page
if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] === true) {
    header("location: welcome.php");
    exit;
}
?>