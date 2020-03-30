<?php

session_start();
include_once '../database/dbconfig.php';

$student_id = $_GET['student_id'];


$name = $_POST['name'];
$department_id = $_POST['department_id'];
$semester_id = $_POST['semester_id'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$gender = $_POST['gender'];
$regid = $_POST['regid'];
$dob = $_POST['dob'];
$feedback_submitted = $_POST['feedback_submitted'];

$sql = "SELECT * FROM `student` WHERE `id` = " . $student_id;
$result_query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result_query);

$stud_sem = $row['semester_id'];
$stud_feed = $row['feedback_submitted'];

if($stud_sem == $semester_id) {
    $feedback_submitted = (isset($_POST['feedback_submitted']))? $feedback_submitted: $stud_feed;
}
else{
    $feedback_submitted = (isset($_POST['feedback_submitted']))? 0: $feedback_submitted;
}

$image_path = '';

if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {
    $org_image_name = $_FILES['image']['name'];
    $ext = pathinfo($org_image_name, PATHINFO_EXTENSION);
    $image_name = $regid.'.'.$ext;

    $directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
    $uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . "/Online-Feedback/img/";
    $uploadDirectory .= $image_name;
    move_uploaded_file($_FILES['image']['tmp_name'], $uploadDirectory);
    $image_path = '../img/' . $image_name;
}

if ($image_path == '') {
    $sql = "UPDATE student SET
        name   = '$name',
        department_id = $department_id,
        semester_id = $semester_id,
        gender = $gender,
        regid = $regid,
        email  = '$email',
        mobile = $mobile,
        dob    = '$dob',
        feedback_submitted = $feedback_submitted
        WHERE id = $student_id";
} else {
    $sql = "UPDATE student SET
        name   = '$name',
        department_id = $department_id,
        semester_id = $semester_id,
        gender = $gender,
        regid = $regid,
        email  = '$email',
        mobile = $mobile,
        image  = '$image_path',
        dob    = '$dob',
        feedback_submitted = $feedback_submitted
        WHERE id = $student_id";
}

$result = mysqli_query($conn, $sql);


if ($result) {
    header("Location: view_student_profile.php?status=success&student_id=".$student_id);
} else {
    header("Location: view_student_profile.php?status=failed&student_id=".$student_id);
}
