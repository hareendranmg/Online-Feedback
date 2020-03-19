<?php

session_start();
include_once '../database/dbconfig.php';

$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$department_id = $_POST['department_id'];
$semester = $_POST['semester'];
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

if ($image == '') {
    $sql = "insert into student (name,department_id,semester,gender,regid,email,mobile,dob)
                         values ('$name',$department_id,'$semester', '$gender','$regid','$email',$mobile,'$dob')";
} else {
$sql = "insert into student (name,department_id,semester,gender,regid,email,mobile,dob,image)
                         values ('$name',$department_id,'$semester', '$gender','$regid','$email',$mobile,'$dob','$image')";
}

$result = mysqli_query($conn, $sql);

if ($result) {
    header("Location: view_students.php?status=success");
} else {
    header("Location: view_students.php?status=failed");
}
