<?php
include '../connect.php';

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
            // Password is correct, perform login actions
            echo "Login successful!";
        } else {
            echo "Incorrect password. Please try again.";
        }
    } else {
        echo "User not found. Please check your username.";
    }
}

