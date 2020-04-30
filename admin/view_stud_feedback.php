<?php
session_start();
if(!isset($_SESSION['login_user'])){
  header("Location: http://localhost/Online-Feedback/index.php");
  exit();
}
include_once '../database/dbconfig.php';
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
      <div class="row content">
      <div class="col-sm-2 sidenav">
        <h3>Welcome <?php echo ($_SESSION['login_user']); ?></h3>
        <ul class="nav nav-pills nav-stacked">
          <li><a href="admin_dashboard.php">Home</a></li>
          <li class="active"><a href="view_feedback.php">View Feedback</a></li>
          <li><a href="view_questions.php">Questions</a></li>
          <li><a href="view_faculty.php">Faculty</a></li>
          <li><a href="view_students.php">Students</a></li>
          <li><a href="../logout.php">Logout</a></li>
        </ul><br>
      </div>

        <div class="col-sm-10">
        <br />
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-9"><h2>Student wise Feedback</h2></div><br />
            <div class="col-md-3">
              <a href="view_feedback.php" class="btn btn-success">Go Back</a>
            </div>
          </div>
        </div>
        <br />

        <div class="pull-right">
          <form class="form-inline" method="get" action="view_stud_feedback.php">
              <div class="container-fluid ">
                <div class="form-group">
                  <select name="student_id" class="form-control" required="required">
                    <option>--Select student--</option>
                      <?php
$sql = "select * from student";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($result)) {
    ?>
                    <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?> </option>
                       <?php
}
?>
                  </select>
                  <input type="submit" class="btn btn-primary" value="View Result">
                </div>
            </div>
          </form>
        </div>

          <br>
          <br>
          <br>

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
                    Student
                  </th>
                  <th class="column100 column4" data-column="column4">
                    Grade
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php
$student_id = $_GET['student_id'];
$ans_sql = "select student.name as name, qn_name,grades.name as grade from questions inner join answers on questions.qn_id = answers.qn_id inner join grades on grades.id = answers.answer inner join student on student.id = answers.student_id where student_id =".$student_id;
$ans_result = mysqli_query($conn, $ans_sql);

// print_r($ans_sql);

$count = 0;
while ($ans_rows = mysqli_fetch_assoc($ans_result)) {
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
                        <?php echo $ans_rows['name']; ?>
                      </td>
                      <td class="column100 column4 value" data-column="column4" style="color: white">
                        <?php echo $ans_rows['grade']; ?>
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
