<?php
session_start();
include_once '../database/dbconfig.php';

$student_id = $_GET['student_id'];
$sql = "SELECT * FROM `student` WHERE `id` = " . $student_id;
$result_query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result_query);

$name = $row['name'];

$department_id = $row['department_id'];
$dep_sql = "SELECT * FROM `department` WHERE `id` = " . $department_id;
$dep_result = mysqli_query($conn, $dep_sql);
$dep_row = mysqli_fetch_array($dep_result);
$department = $dep_row['name'];

$semester = $row['semester'];
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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {
      height: 800px
    }

    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }

    /* Set black background color, white text and some padding */
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
      <h3>Welcome <?php echo ($_SESSION['login_user']); ?></h3>
      <ul class="nav nav-pills nav-stacked">
        <li><a href="admin_dashboard.php">Home</a></li>
        <li><a href="view_feedback.php">View Feedback</a></li>
        <li><a href="view_faculty.php">Faculty</a></li>
        <li class="active"><a href="view_students.php">Students</a></li>
        <li><a href="../logout.php">Logout</a></li>
      </ul><br>
    </div>

      <div class="col-sm-10">
        <div>
          <h2>Student Profile</h2>
          <hr>
          <div class="row">
            <form class="form-horizontal" method="post"
              action="student_profile_update.php?student_id=<?php echo $student_id; ?>" enctype="multipart/form-data">

              <div class="col-md-2">
                <div class="text-center">
                  <img src=<?php echo $image ?> class="avatar img-circle" alt="avatar"
                    style="height: 100px; width: 100px;">
                  <h6>Upload a different photo...</h6>
                  <input type="file" name="image" class="form-control">
                </div>
              </div>

              <div class="col-md-10 personal-info">

                <?php
                  if ($_GET['status'] == 'success') {
                      echo ('<div class="alert text-center alert-success alert-dismissible">
                                          <a class="panel-close close" data-dismiss="alert">×</a>
                                          <strong>Successfully updated student profile.</strong>
                                         </div>');
                  } elseif ($_GET['status'] == 'failed') {
                      echo ('<div class="alert text-center alert-danger alert-dismissible">
                                          <a class="panel-close close" data-dismiss="alert">×</a>
                                          <strong>Failed to update student profile.</strong>
                                         </div>');
                  }
                ?>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Name:</label>
                  <div class="col-lg-8">
                    <input name="name" class="form-control" required="required" type="text" value="<?php echo $name ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 control-label">Department:</label>
                  <div class="col-lg-8">
                    <select name="department_id" class="form-control" required="required">
                        <option value="<?php echo $department_id; ?>"><?php echo $department ?> </option>
                        <option>====================</option></option>
                      <?php 
                $sql = "select * from department";
                $result = mysqli_query($conn, $sql);

                while($row = mysqli_fetch_array($result)) {
              ?>
                      <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?> </option>
                      <?php
                }
              ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 control-label">Semester:</label>
                  <div class="col-lg-8">
                    <input name="semester" class="form-control" required="required" type="text"
                      value="<?php echo $semester ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 control-label">Email:</label>
                  <div class="col-lg-8">
                    <input name="email" class="form-control" required="required" type="email"
                      value="<?php echo $email ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 control-label">Mobile:</label>
                  <div class="col-lg-8">
                    <input name="mobile" class="form-control" required="required" type="text"
                      value="<?php echo $mobile ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 control-label">Gender:</label>
                  <div class="col-lg-8">
                    <input name="gender" class="form-control" required="required" type="text"
                      value="<?php echo $gender ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">Admission No:</label>
                  <div class="col-md-8">
                    <input name="regid" class="form-control" required="required" type="text"
                      value="<?php echo $regid ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">DOB:</label>
                  <div class="col-md-8">
                    <input name="dob" class="form-control" required="required" type="date" value=<?php echo $dob ?>>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label"></label>
                  <div class="col-md-8">
                    <input type="submit" class="btn btn-primary" value="Save Changes">
                    <span></span>
                    <input type="reset" class="btn btn-default" value="Cancel">
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
    </center>>
  </footer>

</body>

</html>