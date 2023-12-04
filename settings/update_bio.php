
<?php
session_start();


include "../userInfo.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userBio = mysqli_real_escape_string($conn, $_POST['userBio']);
    $userGender = mysqli_real_escape_string($conn, $_POST['gender']);
    $updateBioQuery = "UPDATE users SET bio = '$userBio', gender = '$userGender' WHERE nickname = '$currenUser'";

    if (mysqli_query($conn, $updateBioQuery)) {
        header("Location: settings-main.php"); // Redirect to the user's profile page
        exit();
    } else {
        // Error updating bio
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // If the form is not submitted, redirect to the appropriate page
    header("Location: profile.php"); // Redirect to the user's profile page
    exit();
}


