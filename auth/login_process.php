<?php
include '../connect.php';
session_start ();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate and sanitize input (you may want to improve this)
    $username = htmlspecialchars($username);

    // Retrieve the user from the database
    $query = "SELECT * FROM Users WHERE nickname = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        // Verify the password
        if (password_verify($password, $user['password'])) {
            $_SESSION["login"]="1";
            $_SESSION['username'] = $username;
            header("location:../main_page/main-page.php");
        } else {
            include 'login.html';
            $error_message = "Incorrect password. Please try again.";
        }
    } else {
        include 'login.html';
        $error_message = "User not found. Please check your username.";
    }

}

echo "<script>document.getElementById('error').innerHTML = '<p class=\"auth-error\">$error_message</p>';</script>";
