<?php
// Enter your Host, username, password, database below.
// I left password empty because i do not set password on localhost.
$con = mysqli_connect("us-cdbr-east-04.cleardb.com","b8f58dfe527c69","22df3725","heroku_2994517943e6d2b");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
  }
?>