<?php
include '../db.php';
session_start();

if (isset($_POST['delete'])) {

    $id = $_POST['id'];

    $query = "DELETE FROM user" . $_SESSION['id'] . "_roms WHERE id=" . mysqli_real_escape_string($con, $id);
    $result = mysqli_query($con, $query);

    if ($result) {
        $_SESSION['deletedRecord'] = 'Game deleted successfully';
    } else {
        $_SESSION['deletedRecord'] = 'Game wasn\'t deleted';
    }
    header("Location: ../collection.php");
}
