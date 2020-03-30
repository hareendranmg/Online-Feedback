<?php

session_start();
include_once '../database/dbconfig.php';

$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$department_id = $_SESSION['department_id'];
$semester_id = $_POST['semester_id'];
$gender = $_POST['gender'];
$regid = $_POST['regid'];
$dob = $_POST['dob'];

$image_path = '';

if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {
    $org_image_name = $_FILES['image']['name'];
    $ext = pathinfo($org_image_name, PATHINFO_EXTENSION);
    $image_name = $regid.'.'.$ext;

    $directory_self = str_replace(basename($_SERVER['PHP_SELF']),
        '', $_SERVER['PHP_SELF']);
    $uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . "/Online-Feedback/img/";
    $uploadDirectory .= $image_name;
    move_uploaded_file($_FILES['image']['tmp_name'], $uploadDirectory);
    $image_path = '../img/' . $image_name;
}

if ($image_path == '') {
    $sql = "insert into student (name,department_id,semester_id,gender,regid,email,mobile,dob)
                         values ('$name', $department_id, $semester_id, $gender, $regid, '$email', $mobile,'$dob')";
} else {
$sql = "insert into student (name,department_id,semester_id,gender,regid,email,mobile,dob,image)
                         values ('$name', $department_id, $semester_id, $gender, $regid, '$email', $mobile,'$dob', '$image_path')";
}
// print_r($sql); exit;
$result = mysqli_query($conn, $sql);


if ($result) {
    header("Location: view_students.php?status=success");
} else {
    header("Location: view_students.php?status=failed");
}
