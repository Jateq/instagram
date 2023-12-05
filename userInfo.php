<?php
include "connect.php";


function getAllUsers($conn) {
    $sql = "SELECT nickname FROM users";
    $result = mysqli_query($conn, $sql);

    $userList = [];

    if ($result) {
        while ($userData = mysqli_fetch_assoc($result)) {
            $userList[] = $userData['nickname'];
        }
    }

    return $userList;
}
function getUserNickname($conn, $userId) {
    $sql = "SELECT nickname FROM users WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $userData = mysqli_fetch_assoc($result);
        return $userData['nickname'];
    }

    return null; // User not found
}

function getUserId($conn, $userNickname) {
    $sql = "SELECT user_id FROM users WHERE nickname = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $userNickname);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $userData = mysqli_fetch_assoc($result);
        return $userData['user_id'];
    }

    return null; // User not found
}

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

function user_bio($userNickname, $conn)
{
    $sql = "SELECT * FROM users WHERE nickname = '$userNickname'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $userData = mysqli_fetch_assoc($result);
            return $userData['bio'];
        }
    }

    return 'no bio';
}



function timeAgo($timestamp) {
    $currentTime = strtotime(date("Y-m-d H:i:s"));
    $commentTime = strtotime($timestamp);
    $timeDifference = $currentTime - $commentTime - 1701625514;

    $seconds = $timeDifference;
    $minutes = round($seconds / 60);           // value 60 is seconds
    $hours = round($seconds / 3600);           // value 3600 is 60 minutes * 60 sec
    $days = round($seconds / 86400);           // value 86400 is 24 hours * 60 minutes * 60 sec
    $weeks = round($seconds / 604800);         // value 604800 is 7 days * 24 hours * 60 minutes * 60 sec
    $months = round($seconds / 2629440);       // value 2629440 is ((365+365+365+365+366)/5/12) days * 24 hours * 60 minutes * 60 sec

    if ($seconds <= 60) {
        return "Just Now";
    } elseif ($minutes <= 60) {
        return ($minutes == 1) ? "1m" : "$minutes m";
    } elseif ($hours <= 24) {
        return ($hours == 1) ? "1h" : "$hours h";
    } elseif ($days <= 7) {
        return ($days == 1) ? "1d" : "$days d";
    } else {
        return ($weeks == 1) ? "1 w" : "$weeks w";
    }
}

$currenUser = $_SESSION['username'];
$sessionUserImage = user_image($_SESSION['username'], $conn);
$sessionUserImage = str_replace("'", '', $sessionUserImage);
