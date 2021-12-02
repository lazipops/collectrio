<?php

include '../db.php';

session_start();
$query = "CREATE TABLE user".$_SESSION['id']."_roms (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    title TEXT,
    genre TEXT,
    releaseDate DATE,
    developer TEXT,
    platform TEXT, 
    rating INT)";
$result = mysqli_query($con, $query);
header('Location: ../collection.php');