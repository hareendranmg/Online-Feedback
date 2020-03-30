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
$feedback_submitted = $row['feedback_submitted'];

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
                                    <h2>Student Profile</h2>
                                </div><br />
                                <div class="col-md-3">
                                    <a href="view_students.php" class="btn btn-success">Go back</a>
                                </div>
                            </div>
                        </div>
                        <br />
                        <hr>
                        <div class="row">
                          <div class="container-fluid">
                            <form class="form-horizontal" method="post" action="student_profile_update.php" enctype="multipart/form-data">

                                <div class="col-md-2">
                                    <div class="text-center">
                                        <img src=<?php echo $image ?> class="avatar img-circle" alt="avatar" style="height: 100px; width: 100px;">
                                        <br />
                                        <br />
                                        <div class="form-group">
                                            <label>Upload Photo</label>
                                            <input type="file" name="image">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-10 personal-info">

                                    <?php
                                      if(isset($_GET['status'])) {
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
                                      }
                                    ?>

                                        <input name="student_id" class="form-control" required="required" type="hidden" value="<?php echo $student_id ?>">
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Name:</label>
                                            <div class="col-lg-8">
                                                <input name="name" class="form-control" required="required" type="text" value="<?php echo $name ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Department:</label>
                                            <div class="col-lg-8">
                                                <input name="department" class="form-control" readonly required="required" type="text" value="<?php echo $department ?>">
                                            </div>
                                        </div>
                                      <div class="form-group">
                                        <label class="col-lg-3 control-label">Semester:</label>
                                        <div class="col-lg-8">
                                          <select name="semester_id" class="form-control" required="required">
                                          <?php 
                                            $sql = "select * from semester";
                                            $result = mysqli_query($conn, $sql);
                                            while($row = mysqli_fetch_array($result)) {
                                          ?>
                                                  <option <?php if($semester_id == $row['id']) echo "selected" ?>  value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?> </option>
                                                  <?php
                                            }
                                          ?>
                                          </select>
                                        </div>
                                      </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Email:</label>
                                            <div class="col-lg-8">
                                                <input name="email" class="form-control" required="required" type="email" value="<?php echo $email ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Mobile:</label>
                                            <div class="col-lg-8">
                                                <input name="mobile" class="form-control" required="required" type="text" minlength="10" maxlength="10" onkeypress="return isNumber(event)" value="<?php echo $mobile ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Gender:</label>
                                            <div class="col-lg-8">
                                                <select name="gender" class="form-control" required="required">
                                                <option value="1" <?php if ($gender == 1) echo "selected"; ?>>Male</option>
                                                <option value="2" <?php if ($gender == 2) echo "selected"; ?>>Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Admission No:</label>
                                            <div class="col-md-8">
                                                <input name="regid" class="form-control" required="required" minlength="6" maxlength="6" onkeypress="return isNumber(event)" type="text" value="<?php echo $regid ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">DOB:</label>
                                            <div class="col-md-8">
                                                <input name="dob" class="form-control" required="required" type="date" value=<?php echo $dob ?> > 
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Feedback Submitted:</label>
                                            <div class="col-lg-8">
                                                <select name="feedback_submitted" class="form-control" readonly required="required">
                                                <option value="1" <?php if ($feedback_submitted == 1) echo "selected"; ?>>Submitted</option>
                                                <option value="0" <?php if ($feedback_submitted == 0) echo "selected"; ?>>Not Submitted</option>
                                                </select>
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