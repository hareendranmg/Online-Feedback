<?php
session_start();

require_once '../database/dbconfig.php';

$student_regid = $_SESSION['student_regid'];
$student_id = $_SESSION['login_user_id'];
$department_id = $_SESSION['department_id'];
$data = $_POST['arrays'];
$faculty_id = $_POST['faculty_id'];
$status = 0;

foreach ($data as $key) {
    $qn_answer = $key[3];
    if ($qn_answer == 0) {
        echo ('invalid'); die;
    }
}

foreach ($data as $key) {
    $qn_id = $key[0];
    $qn_answer = $key[3];
    $sql = "INSERT INTO answers (student_id,  department_id, faculty_id, qn_id, answer)
            VALUES (".$student_id.",".$department_id.",".$faculty_id.",".$qn_id.",".$qn_answer.")";
    $result_query_ans = mysqli_query($conn, $sql);
    if ($result_query_ans) {
        $status = 1;
    }
}

if ($status == 1) {
    echo ('success');
} else {
    echo ('failed');
}
