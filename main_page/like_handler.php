<?php
session_start();

include '../connect.php';

$currentUserId = $_SESSION['username']; // Replace this with the actual user ID


// Check if the user has clicked the like button
if (isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
    $postId = $_POST['post_id']; // Assuming you're passing the post_id in the AJAX request

    // Check if the action is 'like' or 'unlike'
    if ($action == 'like') {
        // Check if the user has already liked the post
        $checkLikedQuery = "SELECT * FROM post_likes WHERE user = '$currentUserId' AND post_id = $postId";
        $checkLikedResult = $conn->query($checkLikedQuery);

        if ($checkLikedResult->num_rows == 0) {
            // If the user hasn't liked the post, insert a new like
            $insertLikeQuery = "INSERT INTO post_likes (user, post_id) VALUES ('$currentUserId', $postId)";
            $conn->query($insertLikeQuery);

            // Update the likes count in the posts table
            $updateLikesQuery = "UPDATE posts SET likes = likes + 1 WHERE id = $postId";
            $conn->query($updateLikesQuery);
        }
    } elseif ($action == 'unlike') {
        // Delete the like from the post_likes table
        $deleteLikeQuery = "DELETE FROM post_likes WHERE user = '$currentUserId' AND post_id = $postId";
        $conn->query($deleteLikeQuery);

        $updateLikesQuery = "UPDATE posts SET likes = likes - 1 WHERE id = $postId";
        $conn->query($updateLikesQuery);

    }
}

$conn->close();
