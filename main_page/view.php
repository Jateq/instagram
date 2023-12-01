<?php include "../connect.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>View</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            min-height: 100vh;
        }
        .alb {
            width: 300px;
            padding: 10px;
            margin: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }
        .alb img {
            width: 100%;
            height: auto;
        }
        a {
            text-decoration: none;
            color: black;
        }
    </style>
</head>
<body>
<a href="main-page.php">&#8592;</a>
<?php
$sql = "SELECT * FROM posts ORDER BY id DESC";
$res = mysqli_query($conn,  $sql);

if (mysqli_num_rows($res) > 0) {
    while ($images = mysqli_fetch_assoc($res)) {  ?>

        <div class="alb">
            <img src="uploads/<?=$images['image_url']?>" alt="Image">
            <p>User: <?=$images['user']?></p>
            <p>Description: <?=$images['description']?></p>
            <p>Created At: <?=$images['created_at']?></p>
        </div>

    <?php } }?>
</body>
</html>
