<?php
include '../db.php';
session_start();

if (isset($_POST['changeRec'])) { //check for specific post request
    $id = $_POST['id'];
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $releaseDate = $_POST['releaseDate'];
    $developer = $_POST['developer'];
    $platform = $_POST['platform'];
    $rating = $_POST['rating'];

    if ($rating > 100) { //change rating to either 100 if it is over 100 or 0 if it is lower than 0
        $rating = 100;
    } else if ($rating < 0) {
        $rating = 0;
    }

    $result = mysqli_query($con, "UPDATE user" . $_SESSION['id'] . "_roms SET title='$title', genre='$genre', 
    releaseDate='$releaseDate', developer='$developer', platform='$platform', rating='$rating' WHERE id='$id'");
    if ($result) {
        $_SESSION['updateGame'] = "Game record updated!";
    } else {
        $_SESSION['updateGame'] = "Game record not updated";
    }
    header('location: ../collection.php');
}
