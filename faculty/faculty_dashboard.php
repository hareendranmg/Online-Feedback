<?php
session_start();
if(!isset($_SESSION['login_user'])){
  header("Location: http://localhost/Online-Feedback/index.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap-3.4.1.min.css">
  <style>
    .bg_image {
  background-image: url("../img/student_dahboard.jpg"); /* The image used */
  background-color: #cccccc; /* Used if the image is unavailable */
  height: 800px; /* You must set a specified height */
  background-position: center; /* Center the image */
  background-repeat: no-repeat; /* Do not repeat the image */
  background-size: cover; /* Resize the background image to cover the entire container */
}
h1 {
  color: #fff; /* Used if the image is unavailable */
  margin-top: 400px;
}

    .ml14 {
  font-weight: 200;
  font-size: 3.2em;
}

.ml14 .text-wrapper {
  position: relative;
  display: inline-block;
  padding-top: 0.1em;
  padding-right: 0.05em;
  padding-bottom: 0.15em;
}

.ml14 .line {
  opacity: 0;
  position: absolute;
  left: 0;
  height: 2px;
  width: 100%;
  background-color: #fff;
  transform-origin: 100% 100%;
  bottom: 0;
}

.ml14 .letter {
  display: inline-block;
  line-height: 1em;
}
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

    <div class="col-sm-10 bg_image">
      <div id="dashboard">
        <h1 class="ml14">
        <span class="text-wrapper">
          <span class="letters">Faculty Dashboard</span>
          <span class="line"></span>
        </span>
        </h1>
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
<script src="../js/anime.min.js"></script>
<script>
var textWrapper = document.querySelector('.ml14 .letters');
textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

anime.timeline({loop: true})
  .add({
    targets: '.ml14 .line',
    scaleX: [0,1],
    opacity: [0.5,1],
    easing: "easeInOutExpo",
    duration: 900
  }).add({
    targets: '.ml14 .letter',
    opacity: [0,1],
    translateX: [40,0],
    translateZ: 0,
    scaleX: [0.3, 1],
    easing: "easeOutExpo",
    duration: 800,
    offset: '-=600',
    delay: (el, i) => 150 + 25 * i
  }).add({
    targets: '.ml14',
    opacity: 0,
    duration: 1000,
    easing: "easeOutExpo",
    delay: 1000
  });
</script>

</html>
