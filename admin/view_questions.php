<?php
session_start();
include_once '../database/dbconfig.php';

$type = $_GET['type'];
if($type == 'edit') {
  $qn_name = $_GET['qn_name'];
  $qn_id = $_GET['qn_id'];
  $sql = "update questions set qn_name = '".$qn_name."' where qn_id = ".$qn_id;
  $sql_res = mysqli_query($conn, $sql);
  if ($sql_res) {
      header("Location: view_questions.php?status=edited");
  } else {
      header("Location: view_questions.php?status=failed");
  }
} elseif($type == 'add') {
  $qn_name = $_GET['qn_name'];
  $sql = "insert into questions(qn_name) values('".$qn_name."')";
  $sql_res = mysqli_query($conn, $sql);
  if ($sql_res) {
      header("Location: view_questions.php?status=added");
  } else {
      header("Location: view_questions.php?status=failed");
  }
} elseif($type == 'delete') {
  $qn_name = $_GET['qn_name'];
  $qn_id = $_GET['qn_id'];
  $sql = "delete from questions where qn_id= ".$qn_id;
  $sql_res = mysqli_query($conn, $sql);
  if ($sql_res) {
      header("Location: view_questions.php?status=deleted");
  } else {
      header("Location: view_questions.php?status=failed");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>View Questions</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
      <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
    />
    <link rel="stylesheet" type="text/css" href="../css/main.css" />

  <style>

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  top: 300px;
  left: 50%;
  transform: translate(-50%, -50%);
  /* width: 50%; */
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 800px;
  padding: 10px;
  background-color: #7E57C2;
}

/* Full-width input fields */
textarea {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}

    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {
      height: 800px
    }

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
        <li><a href="admin_dashboard.php">Home</a></li>
        <li><a href="view_feedback.php">View Feedback</a></li>
        <li class="active"><a href="view_questions.php">Questions</a></li>
        <li><a href="view_faculty.php">Faculty</a></li>
        <li><a href="view_students.php">Students</a></li>
        <li><a href="../logout.php">Logout</a></li>
      </ul><br>
    </div>

      <div class="col-sm-10">
        <br />
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-9"><h2>Questions</h2></div><br />
            <div class="col-md-3">
              <button class="open-button btn btn-success" onclick="openAddForm()">Add Question</button>
            </div>
          </div>
        </div>
        <br />

                        <?php
if ($_GET['status'] == 'edited') {
    echo ('<div class="alert text-center alert-success alert-dismissible">
                                          <a class="panel-close close" data-dismiss="alert">×</a>
                                          <strong>Successfully updated question.</strong>
                                         </div>');
} elseif ($_GET['status'] == 'added') {
    echo ('<div class="alert text-center alert-success alert-dismissible">
                                          <a class="panel-close close" data-dismiss="alert">×</a>
                                          <strong>Successfully added question.</strong>
                                         </div>');
} elseif ($_GET['status'] == 'deleted') {
    echo ('<div class="alert text-center alert-success alert-dismissible">
                                          <a class="panel-close close" data-dismiss="alert">×</a>
                                          <strong>Successfully deleted question.</strong>
                                         </div>');
} elseif ($_GET['status'] == 'failed') {
    echo ('<div class="alert text-center alert-danger alert-dismissible">
                                          <a class="panel-close close" data-dismiss="alert">×</a>
                                          <strong>Failed to perform action.</strong>
                                         </div>');
}
?>

        <div class="table100 ver6 m-b-110">
          <!-- <form> -->

          <table data-vertable="ver6" id="questions">
            <thead>
              <tr class="row100 head">
                <th class="column100 column1" data-column="column1">
                  Qn No
                </th>
                <th class="column100 column2" data-column="column2">
                  Question
                </th>
                <th class="column100 column3" data-column="column3">
                  Action
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
$sql = 'SELECT * FROM `questions`';
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
                  <?php echo $rows['qn_name']; ?>
                </td>
                <td class="column100 column3 row" data-column="column3">
                <button class="open-button btn btn-success" onclick="openForm('<?php echo $rows['qn_id'] ?>', '<?php echo $rows['qn_name'] ?>')">Edit Question</button>
                <button class="open-button btn btn-danger" onclick="openDelForm('<?php echo $rows['qn_id'] ?>', '<?php echo $rows['qn_name'] ?>')">Delete Question</button>
                </td>
              </tr>
              <?php
}
?>
            </tbody>
          </table>
          <!-- </form> -->
        </div>
          <div class="form-popup" id="myForm">
            <form action="view_questions.php" method="get" class="form-container">
              <h3 class="text-center" style="color: white">Edit Question</h3>
          
              <label for="qn_name"><b style="color: white">Question</b></label>
              <textarea  name="qn_name" id="qn_name" required rows="6" cols="60"></textarea>
              <input type="hidden" name="qn_id" id="qn_id" value="" />
              <input type="hidden" name="type" id="type" value="edit" />
          
              <button type="submit" class="btn">Change</button>
              <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
            </form>
          </div>

          <div class="form-popup" id="addForm">
            <form action="view_questions.php" method="get" class="form-container">
              <h3 class="text-center" style="color: white">Add Question</h3>

              <label for="qn_name"><b style="color: white">Question</b></label>
              <textarea  name="qn_name" id="qn_name" required rows="6" cols="60"></textarea>
              <input type="hidden" name="type" id="type" value="add" />

              <button type="submit" class="btn">Add Question</button>
              <button type="button" class="btn cancel" onclick="closeAddForm()">Close</button>
            </form>
          </div>
          <div class="form-popup" id="delForm">
            <form action="view_questions.php" method="get" class="form-container">
              <h3 class="text-center" style="color: white">Delete Question</h3>

              <label for="qn_name"><b style="color: white">Question</b></label>
              <textarea  name="qn_name" id="del_qn_name" readonly required rows="6" cols="60"></textarea>
              <input type="hidden" name="qn_id" id="del_qn_id" value="" />
              <input type="hidden" name="type" id="type" value="delete" />

              <button type="submit" class="btn">Delete Question</button>
              <button type="button" class="btn cancel" onclick="closeDelForm()">Close</button>
            </form>
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
  <script src="../js/jquery-3.4.1.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>

<script>
function openForm(id, name) {
  document.getElementById("myForm").style.display = "block";
  $("#qn_id").val(id);
  $("#qn_name").val(name);
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
function openAddForm() {
  document.getElementById("addForm").style.display = "block";
}

function closeAddForm() {
  document.getElementById("addForm").style.display = "none";
}
function openDelForm(id, name) {
  document.getElementById("delForm").style.display = "block";
  $("#del_qn_id").val(id);
  $("#del_qn_name").val(name);
}

function closeDelForm() {
  document.getElementById("delForm").style.display = "none";
}
</script>
</html>