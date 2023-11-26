<?php
session_start();
include "db.php";

$msg = $_GET["msg"];
$uname = $_SESSION["userName"]; // Assuming $_SESSION["userName"] contains the username

$q = "INSERT INTO `msg`(`uname`, `msg`) VALUES ('$uname','$msg')";
$rq = mysqli_query($db, $q);

if (!$rq) {
  // Handle the query error, e.g., display an error message
  echo "Error: " . mysqli_error($db);
}
?>