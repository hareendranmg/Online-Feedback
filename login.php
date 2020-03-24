<?php
session_start();
require './database/dbconfig.php';

$type = $_POST['type'];
$username = $_POST['username'];
$password = $_POST['password'];

if ($type == 'none' || $username == '' || $password == '') {
    echo '<script>alert("Incorrect Credentials Entered"); location.replace(document.referrer);</script>';
} else if ($type == 'student') {
    $query = "SELECT * FROM `student` WHERE `regid` = '$username' AND `dob` = '$password'";
    $result_query = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result_query);
    $count_query = mysqli_num_rows($result_query);

    if ($count_query != 0) {
        $_SESSION['login'] = true;
        $_SESSION['login_user'] = $row['name'];
        $_SESSION['login_user_id'] = $row['id'];
        $_SESSION['student_regid'] = $row['regid'];
        $_SESSION['department_id'] = $row['department_id'];
        header("Location: ./student/student_dashboard.php");
        exit();
    } else {
        echo '<script>alert("Incorrect Student Credentials Entered"); location.replace(document.referrer);</script>';
    }
} else if ($type == 'faculty') {
    $query = "SELECT * FROM `faculty` WHERE `name` = '$username' AND `emp_code` = '$password'";
    $result_query = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result_query);
    $count_query = mysqli_num_rows($result_query);

    if ($count_query != 0) {
        $_SESSION['login_user'] = $row['name'];
        $_SESSION['login_user_id'] = $row['id'];
        $_SESSION['department_id'] = $row['department_id'];
        header("Location: ./faculty/faculty_dashboard.php");
        exit();
    } else {
        echo '<script>alert("Incorrect Faculty Credentials Entered"); location.replace(document.referrer);</script>';
    }
} else if ($type == 'admin') {
    $query = "SELECT * FROM `admin` WHERE `username` = '$username' AND `password` = '$password'";
    $result_query = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result_query);
    $count_query = mysqli_num_rows($result_query);

    if ($count_query != 0) {
        $_SESSION['login_user'] = $row['username'];
        header("Location: ./admin/admin_dashboard.php");
        exit();
    } else {
        echo '<script>alert("Incorrect Admin Credentials Entered"); location.replace(document.referrer);</script>';
    }
}

