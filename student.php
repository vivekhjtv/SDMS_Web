<?php
ini_set("session.cache_limiter", "must-revalidate");
session_start();
$enrollErr = "";
$enroll = "";
$done = 0;

if ($_SESSION["student_enroll"] != "") {
  $enroll = $_SESSION["student_enroll"];
  $done = 1;
} 
else {
  echo '<script>alert("You dont have permission to access")</script>';
}

?>

<html lang="en">

<head>
  <title>Student Portal</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" type="image/png" href="images/icons/favicon.ico" />

  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">

  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">

  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">

  <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">

  <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">

  <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">

  <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">

  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <style>
    #content {
      display: flex;
      flex-wrap: wrap;
      width: 80%;
      margin-left: 10%;
      justify-content: start;
      align-content: center;
      align-items: center;

    }
    .back-btn{
        border-radius: 20px;
        width: 80px;
        height: 40px;
        background-color: #2780bb;
        color: white;
        position: absolute;
        margin: 20px;
    }
    .xyz{
      display: flex;
      flex-wrap: nowrap;
      width: 100%;
    }
    .btn{
      display: flex;
      width: 100%;
      justify-content: center;
      margin-left: -80px;
    }
  </style>
</head>

<body>

  <div class="limiter">
  <!--<button type="submit" onclick="window.open('http://localhost/sdms/index.php','_self');" class="back-btn">Back</button>
  --><div class="container-login100">
      <div class="wrap-login100">
        <div class="login100-form-title" style="background-image: url(images/bg-01.jpg);">
          <span class="login100-form-title-1">
            Welcome!
          </span>
        </div>
        <div id="content" style="width:100%;">
          <?php

          if ($done == 1) {


            $_SERVER = "localhost";
            $username = "root";
            $password = "";

            $enroll = $_SESSION["student_enroll"];
            $con = mysqli_connect($_SERVER, $username, $password);
            $sql = "SELECT * FROM `student_info`.`students` WHERE `enroll`=$enroll;";
            $result = $con->query($sql);
            $num_rows = mysqli_num_rows($result);
            $row = $result->fetch_assoc();

            echo "<div class='xyz'><p  >" . "<br><br><strong>Enroll: </strong> " . $row["enroll"] . " <br><br> <strong>Name: </strong> " . $row["name"] . "<br><br> <strong>Email:</strong> " . $row["email"] . "<br><br> <strong>Mobile:</strong> " . $row["mobile"] . "<br><br> <strong>Father's Occupation:</strong> " . $row["occupation"] . "<br><br> <strong>Resident City:</strong> " . $row["city"] . "<br><br> <strong>Semester: </strong>" . $row["semester"] . "<br><br> <strong>Gender:</strong> " . $row["gender"] . "<br><br></p></div>";

            echo "<br>";
            $con->close();
          }




          ?>
          <div class="btn">
          <button class="login100-form-btn" style="display:block;" onclick="window.open('http://localhost/sdms/logout.php','_self');">logout</button>
           </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>