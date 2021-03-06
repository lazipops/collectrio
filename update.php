<?php

session_start();
require('db.php');

if (isset($_SESSION['username'])) { //check if user is logged in
    if ($_POST['password'] != '') { //check if certain request fields are not empty
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password =  mysqli_real_escape_string($con, $_POST['password']);
        $email =  mysqli_real_escape_string($con, $_POST['email']);
        $id = $_SESSION['id'];

        $query = "UPDATE users SET username = '$username', email = '$email', passhash = '" . md5($password) . "' WHERE id = '$id'";
        if ($con->query($query) === TRUE) {
            $_SESSION['flash_message'] = 'Your account details have been changed';
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['email'] = $_POST['email'];
            header("Location: profile.php");
        } else {
            $_SESSION['flash_message'] = 'Error updating: ' . $con->error;
            header("Location: profile.php");
        }
    } elseif ($_POST['username'] != '' && $_POST['email'] != '') {
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $email =  mysqli_real_escape_string($con, $_POST['email']);
        $id = $_SESSION['id'];

        $query = "UPDATE users SET username = '$username', email = '$email' WHERE id = '$id'";
        if ($con->query($query) === TRUE) {
            $_SESSION['flash_message'] = 'Your account details have been changed';
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['email'] = $_POST['email'];
            header("Location: profile.php");
        } else {
            $_SESSION['flash_message'] = 'Error updating: ' . $con->error;
            header("Location: profile.php");
        }
    } else {
        $_SESSION['flash_message'] = 'Make sure any of these fields are not empty before updating';
    }
} else {
    header("Location: login.php");
}