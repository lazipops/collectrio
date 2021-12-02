<?php
include '../db.php';
session_start();

if (isset($_POST['newUsr'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = md5(mysqli_real_escape_string($con, $_POST['password']));

    $result = mysqli_query($con, "INSERT INTO users (username, email, passhash) 
    VALUES ('$username', '$email', '$password')");

    if ($result) {
        $_SESSION['createUser'] = 'User successfully made!';
    } else {
        $_SESSION['createUser'] = 'User was not made';
    }

    header('Location: ../userList.php');
}