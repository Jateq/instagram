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
        echo "Registration successful!";
    } else {
        echo "Registration failed. Please try again.";
    }
}
?>