<?php
session_start();
include_once '../database/dbconfig.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <title>Feedback</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/main.css">

        <style>
                .row.content {
                        height: 800px
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
                                <h3>Welcome <?php echo($_SESSION['login_user']); ?> </h3>

                                <ul class="nav nav-pills nav-stacked">
                                        <li><a href="student_dashboard.php">Home</a></li>
                                        <li class="active"><a href="feedback.php">Feedback</a></li>
                                        <li><a href="student_profile.php">Profile</a></li>
                                        <li><a href="../logout.php">Logout</a></li>
                                </ul><br>
                        </div>

                        <div class="col-sm-10">
                                <div>
                                        <h2>Feedback Form</h2>
                                </div>
                                <div id="success_div" style="display: none">
                                        <div class="alert text-center alert-success alert-dismissible">
                                          <a href="#" class="close success_close" aria-label="close">&times;</a>
                                          <strong>Successfully submitted feedback.</strong>
                                        </div>
                                </div>
                                <div id="failed_div" style="display: none">
                                        <div class="alert text-center alert-danger alert-dismissible">
                                          <a href="#" class="close failed_close" aria-label="close">&times;</a>
                                          <strong>Failed to submitted feedback.</strong>
                                        </div>
                                </div>
                                <div id="submitted_div" style="display: none">
                                        <div class="alert text-center alert-warning alert-dismissible">
                                          <a href="#" class="close submitted_close" aria-label="close">&times;</a>
                                          <strong>You already submitted feedback.</strong>
                                        </div>
                                </div>
                                <div id="invalid_div" style="display: none">
                                        <div class="alert text-center alert-danger alert-dismissible">
                                          <a href="#" class="close invalid_close" aria-label="close">&times;</a>
                                          <strong>Please answer all questions.</strong>
                                        </div>
                                </div>
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
$sql = 'SELECT * FROM `questions`';
$result = mysqli_query($conn, $sql);
while ($rows = mysqli_fetch_array($result)) {
    ?>
                                                        <tr class="row100 data">
                                                                <td class="column100 column1 value" data-column="column1"><?php echo $rows['qn_id']; ?></td>
                                                                <td class="column100 column2 value" data-column="column2"><?php echo $rows['qn_name']; ?></td>
                                                                <td class="column100 column3" data-column="column3">
                                                                           <select class="form-control value" name="" id="">
                                                                             <option value='0'>Select one</option>
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
<script src="../js/jquery-3.4.1.min.js" ></script>
  <script src="../js/bootstrap.min.js"></script>
<script>
$('.success_close').click(function() {
   $('#success_div').hide();
})
$('.failed_close').click(function() {
   $('#failed_div').hide();
})
$('.invalid_close').click(function() {
   $('#invalid_div').hide();
})
$('.submitted_close').click(function() {
   $('#submitted_div').hide();
})
$("#submit").on('click', function (e) {
        // e.preventDefault();
        var arrays = [];
        $("#feedback tr.data").map(function (index, elem) {
                var ret = [];
                $('.value', this).each(function () {
                        var d = $(this).val()||$(this).html();
                        ret.push(d);    
                });
                arrays.push(ret)
        });
        $.ajax({
           type: "POST",
           data: {data: arrays},
           url: "feedback_submit.php",
           success: function(msg){
                if(msg == 'submitted') {
                        $('#submitted_div').show();
                        // alert("You already submitted feedback for current semester.")
                }
                if(msg == 'invalid') {
                        $('#invalid_div').show();
                        // alert("Please answer all questions")
                }
                if(msg == 'success') {
                        $('#success_div').show();
                } 
                if(msg == 'failed') {
                        $('#failed_div').show();
                }
           }
        });
});
</script>
</html>