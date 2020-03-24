<?php

session_start();
include_once '../database/dbconfig.php';

$faculty_id = $_GET['faculty_id'];

$name = $_POST['name'];
$emp_code = $_POST['emp_code'];
$department_id = $_POST['department_id'];
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
    $sql = "UPDATE faculty SET
        name   = '$name',
        emp_code   = '$emp_code',
        department_id   = '$department_id',
        email  = '$email',
        mobile = $mobile
        WHERE id = $faculty_id";
} else {
    $sql = "UPDATE faculty SET
        name   = '$name',
        emp_code   = '$emp_code',
        department_id   = '$department_id',
        email  = '$email',
        mobile = $mobile,
        image  = '$image'
        WHERE id = $faculty_id";
}

$result = mysqli_query($conn, $sql);

if ($result) {
    header("Location: view_faculty_profile.php?status=success&faculty_id=".$faculty_id);
} else {
    header("Location: view_faculty_profile.php?status=failed&faculty_id=".$faculty_id);
}

