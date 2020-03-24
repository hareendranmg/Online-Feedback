<?php

session_start();
include_once '../database/dbconfig.php';

$user_id = $_SESSION['login_user_id'];

$name = $_POST['name'];
$department = $_POST['department'];
$semester = $_POST['semester'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$gender = $_POST['gender'];
$regid = $_POST['regid'];
$dob = $_POST['dob'];

$image = '';

if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {
    $image = $_FILES['image']['name'];
    $image = str_replace(" ", "", $image);
    $directory_self = str_replace(basename($_SERVER['PHP_SELF']),
     '', $_SERVER['PHP_SELF']);
    $uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . "/login_main/img/";
    $uploadDirectory .= $image;
    move_uploaded_file($_FILES['image']['tmp_name'], $uploadDirectory);
    $image = '../img/' . $image;
}

if($image == '') {
    $sql = "UPDATE student SET 
        name   = '$name', 
        email  = '$email',
        mobile = $mobile,
        dob    = '$dob'
        WHERE id = $user_id";
} else {
    $sql = "UPDATE student SET 
        name   = '$name', 
        email  = '$email',
        mobile = $mobile,
        image  = '$image',
        dob    = '$dob'
        WHERE id = $user_id";
}

$result = mysqli_query($conn, $sql);

if($result) {
    $_SESSION['login_user'] = $name;
    header("Location: student_profile.php?status=success");
} else {
    header("Location: student_profile.php?status=failed");
}

