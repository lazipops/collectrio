<?php
include '../db.php';
session_start();

if (isset($_POST['changeRec'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $releaseDate = $_POST['releaseDate'];
    $developer = $_POST['developer'];
    $platform = $_POST['platform'];
    $rating = $_POST['rating'];

    $result = mysqli_query($con, "UPDATE user" . $_SESSION['id'] . "_roms SET title='$title', genre='$genre', 
    releaseDate='$releaseDate', developer='$developer', platform='$platform', rating='$rating' WHERE id='$id'");
    if ($result) {
        $_SESSION['updateGame'] = "Game record updated!";
    } else {
        $_SESSION['updateGame'] = "Game record not updated";
    }
    header('location: ../collection.php');
}
