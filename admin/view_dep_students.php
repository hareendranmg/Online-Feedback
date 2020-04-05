<?php
session_start();
include_once '../database/dbconfig.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Feedback</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="stylesheet" href="../css/bootstrap-3.4.1.min.css">
  <link rel="stylesheet" type="text/css" href="../css/main.css" />

  <style>
    .row.content {
      height: 800px;
    }

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
                    <h3>Welcome
                        <?php echo ($_SESSION['login_user']); ?>
                    </h3>
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="admin_dashboard.php">Home</a></li>
                        <li><a href="view_questions.php">Question</a></li>
                        <li class="active">
                            <a href="#stud_sub-menu" data-toggle="collapse" data-parent="#main-menu">Student<span class="caret"></span></a>
                            <div class="collapse list-group-level1" id="stud_sub-menu">
                                <a href="add_student.php" class="list-group-item bg" data-parent="#sub-menu2">Add student</a>
                                <a href="view_students.php" class="list-group-item bg" data-parent="#sub-menu2">View all students</a>
                                <a href="view_dep_students.php" class="list-group-item bg" data-parent="#sub-menu2">View students by department</a>
                            </div>
                        </li>
                        <li>
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
        <br />
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-5"><h2>Students by Department</h2></div><br />
            <div class="col-md-7">
            <div class="pull-right">
          <form class="form-inline" method="get" action="view_dep_students.php">
              <div class="container-fluid ">
                <div class="form-group">
                  <select name="department_id" class="form-control" required="required">
                    <option value="">--Select Department--</option>
                      <?php
                        $sql = "SELECT department.name, count(*) as count, department.id FROM `student` inner join department on student.department_id=department.id GROUP by department_id ";
                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_array($result)) {
                          ?>
                    <option value="<?php echo $row['id'] ?>"><?php echo $row['name'].'('.$row['count'].')' ?> </option>
                       <?php
                        }
                        ?>
                  </select>
                  <input type="submit" class="btn btn-primary" value="View Result">
                </div>
            </div>
          </form>
        </div>

            </div>
          </div>
        </div>
        <br />

        <div class="table100 ver6 m-b-110">
          <!-- <form> -->

          <table data-vertable="ver6" id="students">
            <thead>
              <tr class="row100 head">
                <th class="column100 column1" data-column="column1">
                  Sl No
                </th>
                <th class="column100 column2" data-column="column2">
                  Student Name
                </th>
                <th class="column100 column2" data-column="column2">
                  Department
                </th>
                <th class="column100 column3" data-column="column3">
                  Action
                </th>
              </tr>
            </thead>
            <tbody>
            <?php
            if(isset($_GET['department_id'])) {
                $sql = "SELECT * FROM student where department_id = ".$_GET['department_id'];
                $result = mysqli_query($conn, $sql);
                $count = 0;
                while ($rows = mysqli_fetch_array($result)) {
                    $count++;
            ?>
                <tr class="row100 data">
                    <td class="column100 column1 value" data-column="column1">
                    <?php echo $count; ?>
                    </td>
                    <td class="column100 column2 value" data-column="column2">
                    <?php echo $rows['name']; ?>
                    </td>
                    <td class="column100 column2 value" data-column="column2">
                    <?php 
                            $dep_sql = "select * from department where id = " . $rows['department_id'];
                            $dep_result = mysqli_query($conn, $dep_sql);
                            $dep_row = mysqli_fetch_array($dep_result);
                            echo $dep_row['name']; ?>
                    </td>

                    <td class="column100 column3" data-column="column3">
                    <a class="btn btn-block btn-info"
                        href="view_student_profile.php?student_id=<?php echo $rows['id'] ?>">View Profile</a>
                    </td>
                </tr>
            <?php
                }
            }
            ?>
            </tbody>
          </table>
          <!-- </form> -->
        </div>
      </div>
    </div>
  </div>

  <footer class="container-fluid" style="margin-top: 50px">
    <center>
      <p>Online Feedback</p>
    </center>
  </footer>
</body>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

</html>