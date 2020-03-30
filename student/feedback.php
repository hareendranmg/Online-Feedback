<?php
session_start();
include_once '../database/dbconfig.php';
$department_id = $_SESSION['department_id'];
$student_id = $_SESSION['login_user_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Feedback</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../css/bootstrap-3.4.1.min.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">

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
                    <?php echo($_SESSION['login_user']); ?> </h3>
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="student_dashboard.php">Home</a></li>
                    <li class="active"><a href="feedback.php">Feedback</a></li>
                    <li><a href="student_profile.php">Profile</a></li>
                    <li><a href="../logout.php">Logout</a></li>
                </ul><br>
            </div>

            <div class="col-sm-10">
                <br>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-5">
                            <h2>Feedback Form</h2>
                        </div>
                        <br>
                        <div class="col-md-7">
                            <div class="pull-right">
                                <form class="form-inline" method="get" action="">
                                    <div class="container-fluid ">
                                        <div class="form-group">
                                            <select name="faculty_id" class="form-control" required="required">
                                                <option value="">--Select Faculty--</option>
                                                <?php
                                                        $sql = "select * from faculty 
                                                                where department_id = ".$department_id." and id not in( 
                                                                    SELECT faculty_id FROM faculty 
                                                                    inner join answers on answers.faculty_id=faculty.id 
                                                                    where faculty.department_id = ".$department_id." and student_id=".$student_id." 
                                                                    )";
                                                        $result = mysqli_query($conn, $sql);

                                                        while ($row = mysqli_fetch_array($result)) {
                                                        ?>
                                                <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?>
                                                </option>
                                                <?php
                                                        }
                                                        ?>
                                            </select>
                                                                                        
                                            <input type="submit" class="btn btn-primary" value="Select">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <?php
                    if(isset($_GET['faculty_id'])) {
                        $sql = "select name from faculty where id=".$_GET['faculty_id'];
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_array($result);

                        echo('
                                <div class="table100 ver6 m-b-110">
                                <input type="hidden" id="faculty_id" value="'.$_GET['faculty_id'].'" />
                                <h4 style="color: white; margin: 30px; padding-left: 300px;">Selected Faculty: '.$row['name'].'</h4>
                                </div>
                            ');
                    }
                ?>
                <br>
                <div class="table100 ver6 m-b-110">
                    <!-- <form> -->
                    <table data-vertable="ver6" id="feedback">
                        <thead>
                            <tr class="row100 head">
                                <th class="column100 column1" data-column="column1">
                                    Qn No
                                </th>
                                <th class="column100 column2" data-column="column2">
                                    Question
                                </th>
                                <th class="column100 column3" data-column="column3">
                                    Mark
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(isset($_GET['faculty_id'])) {
                                        $sql = 'SELECT * FROM `questions`';
                                        $result = mysqli_query($conn, $sql);
                                        $count = 0;
                                        while ($rows = mysqli_fetch_array($result)) {
                                            $count++;
                                    ?>
                            <tr class="row100 data">
                                <input type="hidden" class="value" value="<?php echo $rows['qn_id']; ?>">
                                <td class="column100 column1 value" data-column="column1">
                                    <?php echo $count; ?>
                                    <!-- <?php echo $rows['qn_id']; ?> -->
                                </td>
                                <td class="column100 column2 value" data-column="column2">
                                    <?php echo $rows['qn_name']; ?>
                                </td>
                                <td class="column100 column3" data-column="column3">
                                    <select class="form-control value" required="required">
                                        <option value="0">Select one</option>
                                        <option value='5'>Excellent</option>
                                        <option value='4'>Very Good</option>
                                        <option value='3'>Good</option>
                                        <option value='2'>Average</option>
                                        <option value='1'>Poor</option>
                                    </select>
                                </td>
                            </tr>
                            <?php
                                            }
                                        ?>
                            <tr class="row100">
                                <td class="column100 column1" data-column="column1"></td>
                                <td class="column100 column1" data-column="column1"></td>
                                <td class="column100 column1" data-column="column1">
                                    <Button id="submit" class="btn btn-info btn-block" type="submit">Submit</Button>
                                </td>
                            </tr>
                        </tbody>
                        <?php
                            }
                        ?>
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
<script>
    $("#submit").on('click', function (e) {
        // e.preventDefault();
        var faculty_id = $("#faculty_id").val();
        var arrays = [];
        $("#feedback tr.data").map(function (index, elem) {
            var ret = [];
            $('.value', this).each(function () {
                var d = $(this).val() || $(this).html();
                ret.push(d);
            });
            arrays.push(ret);
        });
        
        $.ajax({
            type: "POST",
            data: {arrays: arrays, faculty_id: faculty_id},
            url: "feedback_submit.php",
            success: function (msg) {
                if (msg == 'invalid') {
                    alert("Please answer all questions")
                    location.reload();
                }
                if (msg == 'success') {
                    alert("Successfully submitted feedback");
                    location.replace("http://localhost/Online-Feedback/student/feedback.php");
                }
                if (msg == 'failed') {
                    alert("Failed to submit feedback");
                    location.replace("http://localhost/Online-Feedback/student/feedback.php");
                }
            }
        });
    });
</script>

</html>