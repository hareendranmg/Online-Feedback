<?php
session_start();
include_once '../database/dbconfig.php';

$department_id = $_SESSION['department_id'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Feedback</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
    />
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
          <h3>
            Welcome
            <?php echo ($_SESSION['login_user']); ?>
          </h3>
          <ul class="nav nav-pills nav-stacked">
            <li><a href="faculty_dashboard.php">Home</a></li>
            <li><a href="faculty_profile.php">Profile</a></li>
            <li class="active"><a href="view_feedback.php">View Feedback</a></li>
            <li>
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
          <div>
            <h2>Feedback</h2>
          </div>
          <div class="table100 ver6 m-b-110">
            <!-- <form> -->

            <table data-vertable="ver6" id="students">
              <thead>
                <tr class="row100 head">
                  <th class="column100 column1" data-column="column1">
                    Qn No
                  </th>
                  <th class="column100 column2" data-column="column2">
                    Question
                  </th>
                  <th class="column100 column3" data-column="column3">
                    Average
                  </th>
                  <th class="column100 column4" data-column="column4">
                    Grade
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php
                    $ans_sql = "select qn_name,avg(answer) as avg from answers inner join questions on questions.qn_id = answers.qn_id where department_id = " . $department_id . " group by questions.qn_id";
                    $ans_result = mysqli_query($conn, $ans_sql);

                    
                    $count = 0;
                    while ($ans_rows = mysqli_fetch_assoc($ans_result)) {
                        $avg = ($ans_rows['avg'] * 100) / 5;
                        $avg_round = round($ans_rows['avg']);
                        $grades_sql = "select * from grades where id = ".$avg_round;
                        $grades_sql_result = mysqli_query($conn, $grades_sql);
                        $grades_row = mysqli_fetch_assoc($grades_sql_result);

                        $count++;
                ?>
                    <tr class="row100 data">
                      <td class="column100 column1 value" data-column="column1">
                        <?php echo $count; ?>
                      </td>
                      <td class="column100 column2 value" data-column="column2">
                        <?php echo $ans_rows['qn_name']; ?>
                      </td>
                      <td class="column100 column3 value" data-column="column3">
                        <div class="progress" style=" height: 20px;width:100%;margin-bottom:0%;">
                            <div class="progress-bar progress-bar-striped  active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $avg."%"; ?>">
                                 <?php echo $avg."%"; ?>  
                            </div>
                        </div>
                      </td>
                      <td class="column100 column4 value" data-column="column4" style="color: white">
                        <?php echo $grades_row['name']; ?>
                      </td>
                    </tr>
                <?php
                    }
                ?>
              </tbody>
            </table>
            <!-- </form> -->
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
