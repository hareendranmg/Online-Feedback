<?php
session_start();
if(!isset($_SESSION['login_user'])){
  header("Location: http://localhost/Online-Feedback/index.php");
  exit();
}
include_once '../database/dbconfig.php';

$user_id = $_SESSION['login_user_id'];
$sql = "SELECT * FROM `student` WHERE `id` = ".$user_id;
$result_query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result_query);

$name = $row['name'];

$department_id = $row['department_id'];
$dep_sql = "SELECT * FROM `department` WHERE `id` = " . $department_id;
$dep_result = mysqli_query($conn, $dep_sql);
$dep_row = mysqli_fetch_array($dep_result);
$department = $dep_row['name'];

$semester_id = $row['semester_id'];
$sem_sql = "SELECT * FROM `semester` WHERE `id` = " . $semester_id;
$sem_result = mysqli_query($conn, $sem_sql);
$sem_row = mysqli_fetch_array($sem_result);
$semester = $sem_row['name'];

$email = $row['email'];
$mobile = $row['mobile'];
$gender = $row['gender'];
$regid = $row['regid'];
$dob = $row['dob'];
$image = $row['image'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Profile</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap-3.4.1.min.css">
  <style>
    .row.content {
      height: 800px
    }

    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }

    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
  </style>
</head>

<body>

  <div class="container-fluid">
    <div class="row content">
      <div class="col-sm-2 sidenav">
        <h3>Welcome <?php echo $name; ?></h3>
        <ul class="nav nav-pills nav-stacked">
          <li><a href="student_dashboard.php">Home</a></li>
          <li><a href="feedback.php">Feedback</a></li>
          <li class="active"><a href="student_profile.php">Profile</a></li>
          <li><a href="../logout.php">Logout</a></li>
        </ul><br>
      </div>

      <div class="col-sm-10">
        <h2>Profile</h2>
        <hr>
        <div class="row">
          <form class="form-horizontal" method="post" action="profile_update.php" enctype="multipart/form-data">

            <div class="col-md-2">
              <div class="text-center">
                <img src=<?php echo $image ?> class="avatar img-circle" alt="avatar"
                  style="height: 100px; width: 100px;">
              </div>
            </div>

            <div class="col-md-10 personal-info">

              <h3>Personal info</h3>

              <div class="form-group">
                <label class="col-lg-3 control-label">Name:</label>
                <div class="col-lg-8">
                  <input name="name" class="form-control" readonly required="required" type="text" value="<?php echo $name ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-3 control-label">Department:</label>
                <div class="col-lg-8">
                  <input name="department" class="form-control" readonly required="required" type="text"
                    value="<?php echo $department ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-3 control-label">Semester:</label>
                <div class="col-lg-8">
                  <input name="semester" class="form-control" readonly required="required" type="text"
                    value="<?php echo $semester ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-3 control-label">Email:</label>
                <div class="col-lg-8">
                  <input name="email" class="form-control" readonly required="required" type="email"
                    value="<?php echo $email ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-3 control-label">Mobile:</label>
                <div class="col-lg-8">
                  <input name="mobile" class="form-control" readonly required="required" type="text"
                    value="<?php echo $mobile ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-3 control-label">Gender:</label>
                <div class="col-lg-8">
                  <input name="gender" class="form-control" readonly required="required" type="text"
                    value="<?php
                             if($gender == 1) echo "Male";
                             else echo "Female"; 
                            ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Admission No:</label>
                <div class="col-md-8">
                  <input name="regid" class="form-control" readonly required="required" type="text"
                    value="<?php echo $regid ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">DOB:</label>
                <div class="col-md-8">
                  <input name="dob" class="form-control" readonly required="required" type="date" value=<?php echo $dob ?>>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
    <hr>
  </div>
  </div>
  </div>
  </div>

  <footer class="container-fluid">
    <center>
      <p>Online Feedback</p>
    </center>
  </footer>

</body>

<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

</html>
