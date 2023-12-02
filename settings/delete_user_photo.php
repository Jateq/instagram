<?php
session_start();
include "../connect.php";

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $updateSql = "UPDATE users SET user_image = 'default.png' WHERE nickname = '$username'";
    mysqli_query($conn, $updateSql);
    header("Location:./upload_user_photo.php");
    exit();
}else{
    header("Location:./upload_user_photo.php");
    exit();
}