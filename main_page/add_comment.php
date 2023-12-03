<?php
session_start();
include "../connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postId = $_POST['post_id'];
    $user = $_SESSION['username'];
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);

    $insertCommentQuery = "INSERT INTO comments (post_id, user, comment) VALUES ($postId, '$user', '$comment')";
    mysqli_query($conn, $insertCommentQuery);

    header("Location: post_page.php?post_id=$postId");
    exit();
}