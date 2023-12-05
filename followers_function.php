<?php

include "connect.php";

function getFollowers($conn, $userId) {
    $followersQuery = "SELECT f.follower_id, f.user_id, f.follower_user_id, u.nickname FROM followers f JOIN users u ON f.follower_user_id = u.user_id WHERE f.user_id = ?";
    $stmt = mysqli_prepare($conn, $followersQuery);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $followersResult = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_all($followersResult, MYSQLI_ASSOC);
}

function getFollowing($conn, $userId) {
    $followingQuery = "SELECT f.follower_id, f.user_id, f.follower_user_id, u.nickname FROM followers f JOIN users u ON f.user_id = u.user_id WHERE f.follower_user_id = ?";
    $stmt = mysqli_prepare($conn, $followingQuery);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $followingResult = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_all($followingResult, MYSQLI_ASSOC);
}



function createFollowerRelationship($conn, $userBeingFollowedId, $followerUserId)
{
    $checkQuery = "SELECT * FROM followers WHERE user_id = ? AND follower_user_id = ?";
    $checkStmt = mysqli_prepare($conn, $checkQuery);
    mysqli_stmt_bind_param($checkStmt, "ii", $userBeingFollowedId, $followerUserId);
    mysqli_stmt_execute($checkStmt);
    $checkResult = mysqli_stmt_get_result($checkStmt);

    if (mysqli_num_rows($checkResult) === 0) {
        // Relationship doesn't exist, proceed to insert
        $insertQuery = "INSERT INTO followers (user_id, follower_user_id) VALUES (?, ?)";
        $insertStmt = mysqli_prepare($conn, $insertQuery);
        mysqli_stmt_bind_param($insertStmt, "ii", $userBeingFollowedId, $followerUserId);

        if (mysqli_stmt_execute($insertStmt)) {
            // Insert successful, follower relationship established
            return "Follower relationship created successfully!";
        } else {
            // Insert failed
            return "Error creating follower relationship: " . mysqli_error($conn);
        }
    } else {
        // Relationship already exists
        return "Follower relationship already exists.";
    }
}


function unfollow($conn, $userBeingFollowedId, $followerUserId)
{
    $deleteQuery = "DELETE FROM followers WHERE user_id = ? AND follower_user_id = ?";
    $deleteStmt = mysqli_prepare($conn, $deleteQuery);
    mysqli_stmt_bind_param($deleteStmt, "ii", $userBeingFollowedId, $followerUserId);

    if (mysqli_stmt_execute($deleteStmt)) {
        // Deletion successful, follower relationship removed
        return "Unfollowed successfully!";
    } else {
        // Deletion failed
        return "Error unfollowing: " . mysqli_error($conn);
    }
}





