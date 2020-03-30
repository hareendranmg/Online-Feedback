<?php

session_start();
include_once '../database/dbconfig.php';

$user_id = $_SESSION['login_user_id'];

$name = $_POST['name'];
$emp_code = $_POST['emp_code'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];

$image_path = '';

if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {
    $org_image_name = $_FILES['image']['name'];
    $ext = pathinfo($org_image_name, PATHINFO_EXTENSION);
    $image_name = $emp_code.'_faculty.'.$ext;

    $directory_self = str_replace(basename($_SERVER['PHP_SELF']),'', $_SERVER['PHP_SELF']);
    $uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . "/Online-Feedback/img/";
    $uploadDirectory .= $image_name;
    move_uploaded_file($_FILES['image']['tmp_name'], $uploadDirectory);
    $image_path = '../img/' . $image_name;
}

if ($image_path == '') {
    $sql = "UPDATE faculty SET 
            name   = '$name', 
            email  = '$email',
            mobile = $mobile
            WHERE id = $user_id";
} else {
    $sql = "UPDATE faculty SET 
            name   = '$name', 
            email  = '$email',
            mobile = $mobile,
            image  = '$image_path'
            WHERE id = $user_id";
}

$result = mysqli_query($conn, $sql);

if($result) {
    $_SESSION['login_user'] = $name;
    header("Location: faculty_profile.php?status=success");
} else {
    header("Location: faculty_profile.php?status=failed");
}

