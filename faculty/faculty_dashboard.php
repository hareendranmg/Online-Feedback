<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {height: 800px}

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
        <li class="active"><a href="faculty_dashboard.php">Home</a></li>
        <li><a href="faculty_profile.php">Profile</a></li>
        <li><a href="view_feedback.php">View Feedback</a></li>
        <li><a href="view_students.php">Students</a></li>
        <li><a href="../logout.php">Logout</a></li>
      </ul><br>
    </div>

    <div class="col-sm-9">
        <div id="dashboard">
                <h3>Dashboard</h3>
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
