<?php
include "db.php";
session_start();

if(isset($_POST["name"]) && isset($_POST["password"])){
  
  $name = mysqli_real_escape_string($db, $_POST["name"]);
  $password = mysqli_real_escape_string($db, $_POST["password"]);

  // Check if 'uname' column exists in 'users' table
  $checkColumnQuery = "SHOW COLUMNS FROM `users` LIKE 'uname'";
  $columnResult = mysqli_query($db, $checkColumnQuery);

  if (!$columnResult || mysqli_num_rows($columnResult) == 0) {
    // 'uname' column doesn't exist, add it
    $addColumnQuery = "ALTER TABLE `users` ADD COLUMN `uname` VARCHAR(255)";
    mysqli_query($db, $addColumnQuery);
  }

  // Check if the user exists
  $q = "SELECT * FROM `users` WHERE uname='$name' AND password='$password'";
  $result = mysqli_query($db, $q);

  if ($result && mysqli_num_rows($result) == 1) {
    // User exists, set session variables and redirect
    $_SESSION["userName"] = $name;
    $_SESSION["password"] = $password;
    header("Location: index.php");
  } else {
    // User does not exist, insert a new user
    $insertQuery = "INSERT INTO `users`(`uname`, `password`) VALUES ('$name','$password')";
    $insertResult = mysqli_query($db, $insertQuery);

    if ($insertResult) {
      // New user inserted successfully, set session variables and redirect
      $_SESSION["userName"] = $name;
      $_SESSION["password"] = $password;
      header("Location: index.php");
    } else {
      // Insert failed, handle the error (e.g., display an error message)
      echo "Error: " . mysqli_error($db);
    }
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ChatRoom</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/login.css">
</head>
<body>
  <h1>ChatRoom</h1>
  <div class="login">
    <h2>Login</h2>
    <p>This ChatRoom is the best example to demonstrate the concept of ChatBot and it's completely for begginners.</p>
    <form action="" method="post">

    <form action="" method="post">
  <h3>UserName</h3>
  <input type="text" placeholder="Short Name" name="name">

  <h3>Password:</h3>
  <input type="password" placeholder="Password" name="password">

  <button>Login / Register</button>
</form>
  </div>
</body>
</html>