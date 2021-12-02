<?php
session_start();
if(!isset($_SESSION["username"])){ //check if user is logged in via session
header("Location: login.php");
exit(); }
