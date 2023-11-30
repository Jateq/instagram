<?php

include '../connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate and sanitize input (you may want to improve this)
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $username = htmlspecialchars($username);
    $password = password_hash($password, PASSWORD_DEFAULT); // Hash the password

    // Insert the user into the database
    $query = "INSERT INTO Users (nickname, email, password) VALUES ('$username', '$email', '$password')";

    // Execute the query (you should use prepared statements to prevent SQL injection)
    $result = mysqli_query($conn, $query);

    if ($result) {
        $_SESSION["login"]="1";
        header("location:../main_page/main-page.php");
    } else {
        include 'registration.php';
        $error_message = "Incorrect password. Please try again.";
    }
}


echo "<script>document.getElementById('error').innerHTML = '<p class=\"auth-error\">$error_message</p>';</script>";
