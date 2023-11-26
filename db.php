<?php
$db = mysqli_connect("localhost", "root", "", "chatroom");

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
?>