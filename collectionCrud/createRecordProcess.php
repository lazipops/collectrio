<?php
include '../db.php';
session_start();

if (isset($_POST['recordSubmit'])) {
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $releaseDate = $_POST['releaseDate'];
    $developer = $_POST['developer'];
    $platform = $_POST['platform'];

    $result = mysqli_query($con, "INSERT INTO user" . $_SESSION['id'] . "_roms (title, genre, releaseDate, developer, platform) 
    VALUES ('$title', '$genre', '$releaseDate', '$developer', '$platform')");

    if ($result) {
        $_SESSION['createRecord'] = 'Record successfully made!';
    } else {
        $_SESSION['createRecord'] = 'Record was not made';
    }

    header('Location: ../collection.php');
}
