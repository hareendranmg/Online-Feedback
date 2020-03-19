<?php
session_start();

require_once '../database/dbconfig.php';

$student_regid = $_SESSION['student_regid'];
$data = $_POST['data'];
$status = 0;

$sql = "select feedback_submitted from student where regid = ".$student_regid;
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

if($row['feedback_submitted'] == 1) {
    echo('submitted'); die;
}

foreach ($data as $key) {
    $qn_name = $key[1];
    $qn_answer = $key[2];
    if ($qn_answer == 0) {
        echo ('invalid'); die;
    }
}
foreach ($data as $key) {
    $qn_name = $key[1];
    $qn_answer = $key[2];
        $sql = "SELECT qn_id FROM `questions`
            WHERE qn_name='" . $qn_name . "'";
        $result_query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result_query);

        $sql = "INSERT INTO `answers` (`student_regid`, `qn_id`, `answer`)
            VALUES (" . $student_regid . "," . $row['qn_id'] . "," . $key[2] . ")";
        $result_query_ans = mysqli_query($conn, $sql);

        $sql = "update student set feedback_submitted = 1 where regid = ".$student_regid;
        $result_query_updt = mysqli_query($conn, $sql);

        if ($result_query_ans && $result_query_updt) {
            $status = 1;
        }
}

if ($status == 1) {
    echo ('success');
} else {
    echo ('failed');
}
