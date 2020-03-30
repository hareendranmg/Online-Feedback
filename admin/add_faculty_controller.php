<?php

session_start();
include_once '../database/dbconfig.php';

$name = $_POST['name'];
$emp_code = $_POST['emp_code'];
$department_id = $_POST['department_id'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];

$image_path = '';

if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {
    $org_image_name = $_FILES['image']['name'];
    $ext = pathinfo($org_image_name, PATHINFO_EXTENSION);
    $image_name = $emp_code.'.'.$ext;

    $directory_self = str_replace(basename($_SERVER['PHP_SELF']),
        '', $_SERVER['PHP_SELF']);
    $uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . "/Online-Feedback/img/";
    $uploadDirectory .= $image_name;
    move_uploaded_file($_FILES['image']['tmp_name'], $uploadDirectory);
    $image_path = '../img/' . $image_name;
}

if ($image_path == '') {
    $sql = "insert into faculty (name,emp_code,department_id,email,mobile) 
                        values('$name',$emp_code,$department_id,'$email',$mobile)";
} else {
    $sql = "insert into faculty (name,emp_code,department_id,email,mobile,image)
                        values('$name',$emp_code,$department_id,'$email',$mobile,'$image_path')";
}

$result = mysqli_query($conn, $sql);

if ($result) {
    header("Location: view_faculty.php?status=success");
} else {
    header("Location: view_faculty.php?status=failed");
}
