<?php
session_start();
if(!isset($_SESSION['login_user'])){
  header("Location: http://localhost/Online-Feedback/index.php");
  exit();
}
include_once '../database/dbconfig.php';

$department_id = $_SESSION['department_id'];
$dep_sql = "SELECT * FROM `department` WHERE `id` = " . $department_id;
$dep_result = mysqli_query($conn, $dep_sql);
$dep_row = mysqli_fetch_array($dep_result);
$department = $dep_row['name'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Add Student</title>
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
        <h3>
          Welcome
          <?php echo ($_SESSION['login_user']); ?>
        </h3>
        <ul class="nav nav-pills nav-stacked">
          <li><a href="faculty_dashboard.php">Home</a></li>
          <li><a href="faculty_profile.php">Profile</a></li>
          <li><a href="view_feedback.php">View Feedback</a></li>
          <li class="active">
              <a href="#stud_sub-menu" data-toggle="collapse" data-parent="#main-menu">Students<span class="caret"></span></a>
              <div class="collapse list-group-level1" id="stud_sub-menu">
                  <a href="add_student.php" class="list-group-item bg" data-parent="#sub-menu2">Add student</a>
                  <a href="view_students.php" class="list-group-item bg" data-parent="#sub-menu2">View students</a>
              </div>
          </li>
          <li><a href="../logout.php">Logout</a></li>
        </ul>
        <br />
      </div>

      <div class="col-sm-10">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-9">
              <h2>Add New Student</h2>
            </div>
            <br/>
          </div>
        </div>
        <br />
  	    <hr>
        
        <div class="row">
            <div class="container-fluid">
            <form class="form-horizontal" method="post"
              action="add_student_controller.php" enctype="multipart/form-data">

              <div class="col-md-2">
                <div class="text-center">
                  <img src="../img/no_image.jpg" class="avatar img-circle" alt="avatar"
                    style="height: 100px; width: 100px;">
                  <br />
                  <br />
                  <div class="form-group">
                    <label>Upload Photo</label>
                    <input type="file" name="image">
                  </div>
                </div>
              </div>

              <div class="col-md-10 personal-info">
                <div class="form-group">
                  <label class="col-lg-3 control-label">Name:</label>
                  <div class="col-lg-8">
                    <input name="name" class="form-control" required="required" type="text">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 control-label">Department:</label>
                  <div class="col-lg-8">
                    <input name="department_id" class="form-control" readonly required="required" type="text" value="<?php echo $department ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 control-label">Semester:</label>
                  <div class="col-lg-8">
                    <select name="semester_id" class="form-control" required="required">
                        <option value="">--Select Semester--</option></option>
                        <option value="1">First Semester</option>
                        <option value="2">Second Semester</option>
                        <option value="3">Third Semester</option>
                        <option value="4">Fourth Semester</option>
                        <option value="5">Fifth Semester</option>
                        <option value="6">Sixth Semester</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 control-label">Email:</label>
                  <div class="col-lg-8">
                    <input name="email" class="form-control" required="required" type="email">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 control-label">Mobile:</label>
                  <div class="col-lg-8">
                    <input name="mobile" class="form-control" required="required" type="text" maxlength ="10" minlength ="10" onkeypress="return isNumber(event)">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 control-label">Gender:</label>
                  <div class="col-lg-8">
                    <select name="gender" class="form-control" required="required">
                        <option value="">--Select Gender--</option></option>
                        <option value="1">Male</option>
                       <option value="2">Female</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">Admission No:</label>
                  <div class="col-md-8">
                  <input name="regid" class="form-control" required="required" type="text" minlength="6" maxlength ="6" onkeypress="return isNumber(event)">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">DOB:</label>
                  <div class="col-md-8">
                    <input name="dob" class="form-control" required="required" type="date">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label"></label>
                  <div class="col-md-8">
                    <input type="submit" class="btn btn-primary" value="Create Student">
                    <span></span>
                    <input type="reset" class="btn btn-dark" value="Cancel">
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
<script>
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>

</html>
