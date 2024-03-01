<?php
ini_set("session.cache_limiter", "must-revalidate");
session_start();
$enrollErr = "";
$enroll = "";
$done = 0;
//because only admin and faculty can perform this action
if ((($_SESSION["user"] == "admin") || ($_SESSION["user"] == "faculty")) || $_SESSION["user"] == "student") {


  //security checks for inserted data
  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    if (empty($_POST["enroll"])) {
      $enrollErr = "Enroll is required";
    } else {
      $enroll = test_input($_POST["enroll"]);
      // check if name only contains letters and whitespace
      if (strlen($enroll) != 5) {
        $enrollErr = "It should be 5 character long";
      }
      if (!preg_match("/^[1-9][0-9][0-9][0-9][0-9]*$/", $enroll)) {
        $enrollErr = "Only digits are allowed";
      }
    }
    if ($enrollErr == "") {

      $_SERVER = "localhost";
      $username = "root";
      $password = "";

      $con = mysqli_connect($_SERVER, $username, $password);
      $sql = "SELECT * FROM `student_info`.`students` WHERE `enroll`=$enroll;";
      $result = $con->query($sql);
      $num_rows = mysqli_num_rows($result);
      if ($num_rows == 1) {
        $done = 1;
      } else {
        echo '<script>alert("Record not found")</script>';
      }
      $con->close();
    } else {
      echo "<script>alert('" . $enrollErr . "')</script>";
    }
  }
} else {
  echo '<script>alert("You dont have permission to access")</script>';
}

?>

<?php
if ($_SESSION["user"] == "admin" || $_SESSION["user"] == "faculty") : ?>

  <html lang="en">

  <head>
    <title>Search Student</title>
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
    </style>
  </head>

  <body>

    <div class="limiter">
      <div class="container-login100">
        <div class="wrap-login100">
          <div class="login100-form-title" style="background-image: url(images/bg-01.jpg);">
            <span class="login100-form-title-1">
              Search Student
            </span>
          </div>

          <form method="post" action="#" class="login100-form validate-form" style="display: flex; flex-wrap: wrap; width: 100%; justify-content:space-around; padding: 43px 20px 93px 20px;">

            <div style="display: flex; flex-wrap: wrap; width: 100%; justify-content:space-around;">
              <div style="width: 100%; display:flex; justify-content:space-around;">
                <div style="border-bottom: 1px solid #989898; color:black;"><input style="height: 100%; border-bottom: 1px solid #989898; color:black;" class="" type="text" name="enroll" placeholder="Enter Enroll"></div>
                <div><button type="submit" class="login100-form-btn">Search</button></div>
              </div>

            </div>
          </form>
          <div id="content">
            <?php

            if ($done == 1) {

              $_SERVER = "localhost";
              $username = "root";
              $password = "";

              $con = mysqli_connect($_SERVER, $username, $password);
              $sql = "SELECT * FROM `student_info`.`students` WHERE `enroll`=$enroll;";
              $result = $con->query($sql);
              $num_rows = mysqli_num_rows($result);
              $row = $result->fetch_assoc();
              echo "<div><p class='xyz'>" . "<strong>Enroll: </strong> " . $row["enroll"] . " <br><br> <strong>Name: </strong> " . $row["name"] . "<br><br> <strong>Email:</strong> " . $row["email"] . "<br><br> <strong>Mobile:</strong> " . $row["mobile"] . "<br><br> <strong>Father's Occupation:</strong> " . $row["occupation"] . "<br><br> <strong>Resident City:</strong> " . $row["city"] . "<br><br> <strong>Semester: </strong>" . $row["semester"] . "<br><br> <strong>Gender:</strong> " . $row["gender"] . "<br><br></p></div>";
            }


            ?>
          </div>
        </div>
      </div>
    </div>
  </body>

  </html>
<?php endif; ?>