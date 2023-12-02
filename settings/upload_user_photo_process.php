<?php
session_start();
if (isset($_POST['submit']) && isset($_FILES['my_image'])) {
    include "../connect.php";

    $img_name = $_FILES['my_image']['name'];
    $img_size = $_FILES['my_image']['size'];
    $tmp_name = $_FILES['my_image']['tmp_name'];
    $error = $_FILES['my_image']['error'];

    if ($error === 0) {
        if ($img_size > 525000) {
            $em = "Sorry, your file is too large.";
            header("Location: ../settings/upload_user_photo.php?error=$em");
            exit();
        } else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($img_ex_lc, $allowed_exs)) {
                $username = $_SESSION['username'];
                $new_img_name = $username . '.' . $img_ex_lc;
                $img_upload_path = '../images/users/' . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                $updateSql = "UPDATE users SET user_image = '$new_img_name' WHERE nickname = '$username'";
                mysqli_query($conn, $updateSql);
                header("Location:./upload_user_photo.php");
                exit();
            } else {
                $em = "You can't upload files of this type";
                header("Location: ../settings/upload_user_photo.php?error=$em");
                exit();
            }
        }
    } else {
        $em = "Unknown error occurred!";
        header("Location: ../settings/upload_user_photo.php?error=$em");
        exit();
    }

} else {
    header("Location: ../settings/upload_user_photo.php");
    exit();
}

