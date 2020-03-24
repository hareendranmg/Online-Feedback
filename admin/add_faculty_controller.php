<?php

session_start();
include_once '../database/dbconfig.php';

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
    $sql = "insert into faculty (name,emp_code,department_id,email,mobile) 
                        values('$name','$emp_code',$department_id,'$email',$mobile)";
} else {
    $sql = "insert into faculty (name,emp_code,department_id,email,mobile,image)
                        values('$name','$emp_code',$department_id,'$email',$mobile,'$image')";
}

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result); 

if ($result) {
    header("Location: view_faculty.php?status=success");
} else {
    header("Location: view_faculty.php?status=failed");
}
