<?php
include '../db.php';
session_start();

if (isset($_POST['delete'])) {

    $id = $_POST['id'];

    $query = "DELETE FROM users WHERE id=". mysqli_real_escape_string($con, $id);
    $dropTable = "DROP TABLE user".mysqli_real_escape_string($con, $id)."_roms";
    $result = mysqli_query($con, $query);
    $dropTableResult = mysqli_query($con, $dropTable);

    if ($result && $dropTableResult) {
        $_SESSION['deletedUser'] = 'User and their collection has been deleted successfully';
    } else {
        if ($result){
            $_SESSION['deletedUser'] = 'User with empty collection has been deleted successfully';
        }
        $_SESSION['deletedUser'] = 'User was not deleted';
    }
    header("Location: ../userList.php");
}