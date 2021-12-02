<?php
include '../db.php';
session_start();

if (isset($_POST['edit'])) {
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $username = mysqli_real_escape_string($con, $_POST['username']);

    $query = "UPDATE users SET username='$username' WHERE id='$id'";
    $result = mysqli_query($con, $query);
    if ($result) {
        $_SESSION['updateUser'] = "User updated!"; 
    } else {
        $_SESSION['updateUser'] = "User was not updated"; 
    }
    header('location: ../userList.php');
}