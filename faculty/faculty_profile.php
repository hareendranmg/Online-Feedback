<?php
session_start();
include_once '../database/dbconfig.php';

$user_id = $_SESSION['login_user_id'];
$sql = "SELECT * FROM `faculty` WHERE `id` = " . $user_id;
$result_query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result_query);

$name = $row['name'];
$emp_code = $row['emp_code'];
$department_id = $row['department_id'];
$dep_sql = "SELECT * FROM `department` WHERE `id` = " . $department_id;
$dep_result = mysqli_query($conn, $dep_sql);
$dep_row = mysqli_fetch_array($dep_result);
$department = $dep_row['name'];

$email = $row['email'];
$mobile = $row['mobile'];
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
                    <h3>Welcome
                        <?php echo $name; ?>
                    </h3>
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="faculty_dashboard.php">Home</a></li>
                        <li class="active"><a href="faculty_profile.php">Profile</a></li>
                        <li><a href="view_feedback.php">View Feedback</a></li>
                        <li>
                            <a href="#stud_sub-menu" data-toggle="collapse" data-parent="#main-menu">Students<span class="caret"></span></a>
                            <div class="collapse list-group-level1" id="stud_sub-menu">
                                <a href="add_student.php" class="list-group-item bg" data-parent="#sub-menu2">Add student</a>
                                <a href="view_students.php" class="list-group-item bg" data-parent="#sub-menu2">View students</a>
                            </div>
                        </li>
                        <li><a href="../logout.php">Logout</a></li>
                    </ul><br>
                </div>

                <div class="col-sm-10">
                  <div class="container-fluid">
                    <div class="row">
                        <h2>Profile</h2>
                        <br>
                        <hr>
                            <form class="form-horizontal" method="post" action="profile_update.php" enctype="multipart/form-data">
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
                                if(isset($_GET['status']))
                                  if ($_GET['status'] == 'success') {
                                      echo ('<div class="alert text-center alert-success alert-dismissible">
                                                <a class="panel-close close" data-dismiss="alert">×</a>
                                                <strong>Successfully updated profile.</strong>
                                              </div>');
                                  } elseif ($_GET['status'] == 'failed') {
                                      echo ('<div class="alert text-center alert-danger alert-dismissible">
                                              <a class="panel-close close" data-dismiss="alert">×</a>
                                              <strong>Failed to update profile.</strong>
                                            </div>');
                                  }
                                ?>
                                        <h3>Personal info</h3>

                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Name:</label>
                                            <div class="col-lg-8">
                                                <input name="name" class="form-control" required="required" type="text" value="<?php echo $name ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Department:</label>
                                            <div class="col-lg-8">
                                                <input name="department_id" class="form-control" readonly required="required" type="text" value="<?php echo $department ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Employee Code:</label>
                                            <div class="col-lg-8">
                                                <input name="emp_code" class="form-control" readonly required="required" type="text" value="<?php echo $emp_code ?>">
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