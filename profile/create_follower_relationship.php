<?php

include "../connect.php";
include '../userInfo.php';
include "../followers_function.php";

$userIdToFollow = (int)$_GET['userIdToFollow'];
$currentUserId = (int)$_GET['currentUserId'];

$resultMessage = createFollowerRelationship($conn, $userIdToFollow, $currentUserId);

// Return a JSON response
header('Content-Type: application/json');
echo json_encode(['message' => $resultMessage]);
exit();


