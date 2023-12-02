<?php
include "connect.php";
function user_image($userNickname, $conn)
{
    $sql = "SELECT * FROM users WHERE nickname = '$userNickname'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $userData = mysqli_fetch_assoc($result);
            return $userData['user_image'];
        }
    }

    return 'default_image.jpg';
}


$sessionUserImage = user_image($_SESSION['username'], $conn);
