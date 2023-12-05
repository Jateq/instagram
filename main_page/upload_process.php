<?php
session_start();
if (isset($_POST['submit']) && isset($_FILES['my_image']) && isset($_POST['image_description'])) {
    include "../connect.php";

    $img_name = $_FILES['my_image']['name'];
    $img_size = $_FILES['my_image']['size'];
    $tmp_name = $_FILES['my_image']['tmp_name'];
    $error = $_FILES['my_image']['error'];
    $description = mysqli_real_escape_string($conn, $_POST['image_description']);

    if ($error === 0) {
        if ($img_size > 4525000) {
            $em = "Sorry, your file is too large.";
            header("Location: ../main_page/upload.php?error=$em");
            exit();
        } else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png", "heic", "webp");

            if (in_array($img_ex_lc, $allowed_exs)) {
                $currentDateTime = date("Y-m-d H:i:s");
                $userName = $_SESSION['username'];
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                $img_upload_path = 'uploads/' . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                // Insert into Database
                include '../userInfo.php';
                $sql = "INSERT INTO posts(image_url, created_at, user, description, user_image)
				        VALUES('$new_img_name', '$currentDateTime', '$userName', '$description', '$userImage')";
                mysqli_query($conn, $sql);
                header("Location:../main_page/main-page.php");
                exit();
            } else {
                $em = "You can't upload files of this type";
                header("Location: ../main_page/upload.php?error=$em");
                exit();
            }
        }
    } else {
        $em = "Unknown error occurred!";
        header("Location: ../main_page/upload.php?error=$em");
        exit();
    }

} else {
    header("Location: ../main_page/upload.php");
    exit();
}

