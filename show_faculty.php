<?php
ini_set("session.cache_limiter", "must-revalidate");
session_start();
$_SERVER = "localhost";
$username = "root";
$password = "";
$done = 0;
//because only admin and faculty can perform this action
if ($_SESSION["user"] == "admin") {
  $con = mysqli_connect($_SERVER, $username, $password);
  $sql = "SELECT * FROM `student_info`.`faculty`";
  $result = $con->query($sql);
  $num_rows = mysqli_num_rows($result);
  if ($num_rows >= 1) {
    $done = 1;
  } else {
    echo '<script>alert("Record not found")</script>';
  }
  $con->close();
} else {
  echo '<script>alert("You dont have permission to access")</script>';
}

?>




<?php
if ($_SESSION["user"] == "admin") : ?>

  <html lang="en">

  <head>
    <title>Faculty Records</title>
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

      #content div {
        width: 100%;
      }

      table,
      th,
      td {
        border: 1px solid black;
      }

      table tr td,
      table tr th {
        padding: 10px;
      }
    </style>
  </head>

  <body>

    <div class="limiter">
      <div class="container-login100">
        <div class="wrap-login100" style="width:90%;">
          <div class="login100-form-title" style="background-image: url(images/bg-01.jpg);">
            <span class="login100-form-title-1">
              Faculty Records
            </span>
          </div>
          <br><br>

          <div id="content">
            <table style="width:100%;">
              <tr>
                <th>USer ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Gender</th>
              </tr>


              <?php

              if ($done == 1) {

                $_SERVER = "localhost";
                $username = "root";
                $password = "";

                $con = mysqli_connect($_SERVER, $username, $password);
                $sql = "SELECT * FROM `student_info`.`faculty`";
                $result = $con->query($sql);
                $num_rows = mysqli_num_rows($result);
                while ($row = $result->fetch_assoc()) {

                  echo "<tr>
                  <td>" . $row["userid"] . "</td>
                  <td>" . $row["name"] . "</td>
                  <td>" . $row["email"] . "</td>
                  <td>" . $row["mobile"] . "</td>
                  <td>" . $row["gender"] . "</td>
                </tr>";
                }

                $con->close();
              }


              ?>

            </table>
            <p><br><br></p>
          </div>
        </div>
      </div>
    </div>
  </body>

  </html>
<?php endif; ?>