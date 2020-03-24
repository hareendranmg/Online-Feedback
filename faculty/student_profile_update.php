<?php

session_start();
include_once '../database/dbconfig.php';

$student_id = $_POST['student_id'];

$regid = $_POST['regid'];
$name = $_POST['name'];
$semester_id = $_POST['semester_id'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];

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

if ($image == '') {
    $sql = "UPDATE student SET
        name   = '$name',
        semester_id = $semester_id,
        email  = '$email',
        mobile = $mobile
        WHERE id = $student_id";
} else {
    $sql = "UPDATE student SET
        name   = '$name',
        semester_id = $semester_id,
        email  = '$email',
        mobile = $mobile,
        image  = '$image'
        WHERE id = $student_id";
}


// print_r($sql); exit;
$result = mysqli_query($conn, $sql);


if ($result) {
    header("Location: view_student_profile.php?status=success&student_id=".$student_id);
} else {
    header("Location: view_student_profile.php?status=failed&student_id=".$student_id);
}
