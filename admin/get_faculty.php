<?php
require_once '../database/dbconfig.php';

$department_id = $_POST['department_id'];

$myArray = array();

$fac_sql = "select id, name from faculty where department_id=".$department_id;
$fac_res = mysqli_query($conn, $fac_sql);
while($row = $fac_res->fetch_array(MYSQLI_ASSOC)) {
    $myArray[] = $row;
}
echo json_encode($myArray);

