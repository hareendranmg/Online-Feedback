<?php
session_start();
include_once '../database/dbconfig.php';
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
                        <?php echo ($_SESSION['login_user']); ?>
                    </h3>
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="admin_dashboard.php">Home</a></li>
                        <li><a href="view_questions.php">Question</a></li>
                        <li>
                            <a href="#stud_sub-menu" data-toggle="collapse" data-parent="#main-menu">Student<span class="caret"></span></a>
                            <div class="collapse list-group-level1" id="stud_sub-menu">
                                <a href="add_student.php" class="list-group-item bg" data-parent="#sub-menu2">Add student</a>
                                <a href="view_students.php" class="list-group-item bg" data-parent="#sub-menu2">View all students</a>
                                <a href="view_dep_students.php" class="list-group-item bg" data-parent="#sub-menu2">View students by department</a>
                            </div>
                        </li>
                        <li class="active">
                            <a href="#fac_sub-menu" data-toggle="collapse" data-parent="#main-menu">Faculty<span class="caret"></span></a>
                            <div class="collapse list-group-level1" id="fac_sub-menu">
                                <a href="add_faculty.php" class="list-group-item bg" data-parent="#sub-menu2">Add faculty</a>
                                <a href="view_faculty.php" class="list-group-item bg" data-parent="#sub-menu2">View all faculty</a>
                                <a href="view_faculty_dep.php" class="list-group-item bg" data-parent="#sub-menu2">View by department</a>
                            </div>
                        </li>
                        <li>
                            <a href="#feedsub-menu" data-toggle="collapse" data-parent="#main-menu">Feedback<span class="caret"></span></a>
                            <div class="collapse list-group-level1" id="feedsub-menu">
                                <a href="view_dep_feedback.php" class="list-group-item bg" data-parent="#sub-menu">View department feedback</a>
                                <a href="view_fac_feedback.php" class="list-group-item bg" data-parent="#sub-menu">View faculty faculty</a>
                            </div>
                        </li>
                        <li><a href="../logout.php">Logout</a></li>
                    </ul><br>
                </div>

      <div class="col-sm-10">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-9"><h2>Add Faculty</h2></div><br />
            <div class="col-md-3">
              <a href="view_faculty.php" class="btn btn-success">Go back</a>
            </div>
          </div>
        </div>
        <br />
  	    <hr>
          <div class="row">
            <div class="container-fluid">
            <form class="form-horizontal" method="post"
              action="add_faculty_controller.php" enctype="multipart/form-data">

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
                  <label class="col-md-3 control-label">Employee Code:</label>
                  <div class="col-md-8">
                    <input name="emp_code" class="form-control" required="required" minlength="6" maxlength="6" type="text" onkeypress="return isNumber(event)">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Department:</label>
                  <div class="col-lg-8">
                    <select name="department_id" class="form-control" required="required">
                        <option value="">--Select Department--</option></option>
                      <?php
                        $sql = "select * from department";
                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_array($result)) {
                            ?>
                          <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?> </option>
                      <?php
                        }
                      ?>
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
                    <input name="mobile" class="form-control" required="required" minlength="10" maxlength="10" type="text" onkeypress="return isNumber(event)">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label"></label>
                  <div class="col-md-8">
                    <input type="submit" class="btn btn-primary" value="Create Faculty">
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