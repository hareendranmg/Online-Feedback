<?php
  session_start();
  require './database/dbconfig.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Online Feedback System</title>
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css'>
  <link rel="stylesheet" href="./css/index.style.css">

</head>

<body>
  <div ng-app="bootstrpConf">

    <nav class="top-nav m-b-3 p-t-1 animated fadeInDown clearfix">
      <div class="container">
        <ul class="list-unstyled list-inline">
          <li class="list-inline-item m-r-1"><a href="#" class="js-scroll" data-scroll-to="#home">Home</a></li>

          <li class="list-inline-item m-r-1"><a href="#" class="js-scroll" data-scroll-to="#about">About</a></li>
          <li class="list-inline-item m-r-0"><a href="#" class="js-scroll btn signup-btn btn-danger btn-sm"
              data-scroll-to="#login">Login</a></li>
        </ul>
      </div>
    </nav>

    <!-- jumbotron -->
    <header id="home" class="top-hero jumbotron-fluid p-b-3 bg-faded">
      <div class="container animated fadeInUp">
        <h1 class="display-3">Online Feedback System</h1>
        <p class="lead m-t-1 m-b-2">Web based solution to rate faculties and college .</p>
        <button type="button" class="js-scroll btn btn-lg btn-danger m-t-1" data-scroll-to="#login">Login</button>
        <button type="button" class="js-scroll btn btn-lg btn-default m-t-1" data-scroll-to="#about">Learn More</button>
      </div>
    </header>

    <section id="about" class="banner about p-b-3">
      <div class="container animated fadeInUp">
        <h1 class="display-3">Online Feedback System</h1>

        <p class="lead m-t-1 m-b-2">This is a online web based software to give feedback about faculties and college.
        </p>
      </div>
    </section>

    <section id="login" class="banner learn p-y-3">
      <div class="wrapper">
        <h2 class="m-b-2 display-5">Login To Your Account</h2>

        <form method="post" action="login.php">
          <div class="form-group row">
            <div class="col-sm-10">
              <select class="form-control" name="type" id="type">
                <option selected value="none">Select Type</option>
                <option value="student">Student</option>
                <option value="faculty">Faculty</option>
                <option value="admin">Admin</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-10">
              <input type="text" name="username" class="form-control" placeholder="Username">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-10">
              <input type="text" name="password" class="form-control" placeholder="Password">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-danger btn-lg btn-block">Login</button>
            </div>
          </div>
        </form>

      </div>
    </section>

    <footer class="p-y-2">
      <p class="copyright"> H M G</p>
    </footer>
  </div>
  <!-- partial -->
  <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
  <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js'></script>
  <script src="./js/index.script.js"></script>

</body>

</html>