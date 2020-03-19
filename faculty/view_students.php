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
            <li><a href="view_feedback.php">View Feedback</a></li>
            <li class="active"><a href="view_students.php">Students</a></li>
            <li><a href="../logout.php">Logout</a></li>
          </ul>
          <br />
        </div>

        <div class="col-sm-10">
          <div>
            <h2>Students</h2>
          </div>
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
                  <th class="column100 column3" data-column="column3">
                    Action
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php
                    $department_id = $_SESSION['department_id'];
                    $sql = 'SELECT * FROM `student` where department_id = '.$department_id;
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
                      <td class="column100 column3" data-column="column3">
                        <a class="btn btn-block btn-info" href="view_student_profile.php?student_id=<?php echo $rows['id'] ?>">View Profile</a>
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
  <script src="../js/jquery-3.4.1.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
</html>
