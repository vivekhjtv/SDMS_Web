<?php
ini_set("session.cache_limiter", "must-revalidate");
session_start();
$useridErr = "";
$userid = "";
$done = 0;

//checks that admin is logged in or not because only admin can perform this action
if ($_SESSION["user"] == "admin") {


  //security checks for inserted data
  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["userid"])) {
      $useridErr = "userid is required";
    } else {
      $userid = test_input($_POST["userid"]);
      // check if name only contains letters and whitespace
      if (strlen($userid) != 5) {
        $useridErr = "It should be 5 character long";
      }
      if (!preg_match("/^[1-9][0-9][0-9][0-9][0-9]*$/", $userid)) {
        $useridErr = "Only digits are allowed";
      }
    }
    if ($useridErr == "") {

      $_SERVER = "localhost";
      $username = "root";
      $password = "";

      $con = mysqli_connect($_SERVER, $username, $password);
      $sql = "SELECT * FROM `student_info`.`faculty` WHERE `userid`=$userid;";
      $result = $con->query($sql);

      $num_rows = mysqli_num_rows($result);
      if ($num_rows == 1) {
        $done = 1;
      } else {
        echo '<script>alert("Record not found")</script>';
      }
      $con->close();
    } else {
      echo "<script>alert('" . $useridErr . "')</script>";
    }
  }
} else {
  echo '<script>alert("You dont have permission to access")</script>';
}

?>

<?php
if ($_SESSION["user"] == "admin") : ?>

  <html lang="en">

  <head>
    <title>Search Faculty</title>
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
              Search Faculty
            </span>
          </div>

          <form method="post" action="#" class="login100-form validate-form" style="display: flex; flex-wrap: wrap; width: 100%; justify-content:space-around; padding: 43px 20px 93px 20px;">

            <div style="display: flex; flex-wrap: wrap; width: 100%; justify-content:space-around;">
              <div style="width: 100%; display:flex; justify-content:space-around;">
                <div style="border-bottom: 1px solid #989898; color:black;"><input style="height: 100%; border-bottom: 1px solid #989898; color:black;" class="" type="text" name="userid" placeholder="Enter User ID"></div>
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
              $sql = "SELECT * FROM `student_info`.`faculty` WHERE `userid`=$userid;";
              $result = $con->query($sql);
              $num_rows = mysqli_num_rows($result);
              $row = $result->fetch_assoc();
              echo "<div><p class='xyz'>" . "<strong>userid:</strong> " . $row["userid"] . " <br> <br><strong>Name:</strong> " . $row["name"] . "<br><br><strong> Email: </strong>" . $row["email"] . "<br><br> <strong>Mobile:</strong> " . $row["mobile"] . "<br> <br><strong>Gender:</strong> " . $row["gender"] . "</p><div><br><br>";
            }


            ?>
          </div>
        </div>
      </div>
    </div>
  </body>

  </html>
<?php endif; ?>