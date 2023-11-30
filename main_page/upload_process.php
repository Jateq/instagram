<?php

if (isset($_POST['submit']) && isset($_FILES['my_image'])) {
    include "../connect.php";

    echo "<pre>";
    print_r($_FILES['my_image']);
    echo "</pre>";

    $img_name = $_FILES['my_image']['name'];
    $img_size = $_FILES['my_image']['size'];
    $tmp_name = $_FILES['my_image']['tmp_name'];
    $error = $_FILES['my_image']['error'];

    if ($error === 0) {
        if ($img_size > 125000) {
            $em = "Sorry, your file is too large.";
            header("Location: ../main_page/upload.php?error=$em");
            exit();

        }else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                $img_upload_path = 'uploads/'.$new_img_name;


            }else {
                $em = "You can't upload files of this type";
                header("Location: ../main_page/upload.php?error=$em");
                exit();

            }
        }
    }else {
        $em = "unknown error occurred!";
        header("Location: ../main_page/upload.php?error=$em");
        exit();
    }

}else {
    header("Location: ../main_page/upload.php");
    exit();
}