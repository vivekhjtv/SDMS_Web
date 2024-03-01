<?php
ini_set("session.cache_limiter", "must-revalidate"); 
session_start();

// define variables and set to empty values
$useridErr = $nameErr = $emailErr = $genderErr = $passwordErr = $mobileErr =  "";
$userid = $name = $email = $gender = $passwords = $mobile = "";

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
      $useridErr = "Userid Is Required";
    } else {
      $userid = test_input($_POST["userid"]);

      if (strlen($userid) != 5) {
        $useridErr = "It Should Be 5 Character Long";
      }

      if (!preg_match("/^[1-9][0-9][0-9][0-9][0-9]*$/", $userid)) {
        $useridErr = "Only Digits are Allowed";
      }
    }

    if (empty($_POST["name"])) {
      $nameErr = "Name Is Required";
    } else {
      $name = test_input($_POST["name"]);

      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        $nameErr = "Only letters And White Space Allowed";
      }
    }



    if (empty($_POST["email"])) {
      $emailErr = "Email Is Required";
    } else {
      $email = test_input($_POST["email"]);

      // check if e-mail address is well-formed
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid Email Format";
      }
    }

    if (empty($_POST["mobile"])) {
      $mobileErr = "Enroll is required";
    } else {
      $mobile = test_input($_POST["mobile"]);

      if (strlen($mobile) != 10) {
        $mobileErr = "It should be 10 character long";
      }

      if (!preg_match("/^[1-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]*$/", $mobile)) {
        $mobileErr = "Only digits are allowed";
      }
    }

    if (empty($_POST["gender"])) {
      $genderErr = "Gender Is Required";
    } else {
      $gender = test_input($_POST["gender"]);
    }


    if (empty($_POST["password"])) {
      $passwordErr = "password is required";
    } else {
      $passwords = test_input($_POST["password"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z-' ]*$/", $passwords)) {
        $passwordErr = "Only letters and white space allowed";
      }
    }

    if ((($nameErr == $useridErr) && ($emailErr == $genderErr)) && ($mobileErr == $passwordErr)) {

      $_SERVER = "localhost";
      $username = "root";
      $password = "";

      $con = mysqli_connect($_SERVER, $username, $password);

      $sql = "INSERT INTO `student_info`.`faculty` (`userid`,`name`,`email`,`mobile`,`gender`,`password`) VALUES ('$userid','$name','$email','$mobile','$gender','$passwords'); ";
      $result = $con->query($sql);
      $con->close();
      if ($result) {
        echo '<script>alert("Successfully Inserted")</script>';
      } else {
        echo '<script>alert("Insertion Failed because This UserID Is Already Inserted")</script>';
      }
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
    <title>Add Faculty</title>
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

    <link rel="stylesheet" href="style.css">

  </head>

  <body>

    <div class="limiter">
      <div class="container-login100">
        <div class="wrap-login100" style="width: 800px;">
          <div class="login100-form-title" style="background-image: url(images/bg-01.jpg); padding: 30px 15px 30px 15px;">
            <span class="login100-form-title-1">
              Add Details
            </span>
          </div>

          <form method="post" action="#" class="login100-form validate-form" style="padding: 43px 88px 93px 88px;">
            <div class="row my-4">
              <div class="col-md-6"> <label>User ID:</label> <input type="text" name="userid" placeholder="eg. 12345">
                <span class="error"> <?php echo $useridErr; ?></span>
              </div>
              <div class="col-md-6 pt-md-0 pt-4"> <label>Name</label> <input name="name" type="text" placeholder="eg. John"> <span class="error"> <?php echo $nameErr; ?></span></div>
            </div>
            <div class="row my-4">
              <div class="col-md-6"> <label>User's Mail </label> <input type="text" name="email" placeholder="eg. jhon19@mail.com">
                <span class="error"> <?php echo $emailErr; ?></span></div>
              <div class="col-md-6 pt-md-0 pt-4"> <label>Phone</label> <input name="mobile" type="text" placeholder="eg. 9898989898"> <span class="error"> <?php echo $mobileErr; ?></span></div>
            </div>
            <div class="row my-4">
              <div class="col-md-6 pt-md-0 pt-4"> <label>Password</label> <input name="password" type="password" placeholder="Enter Password"><span class="error"> <?php echo $passwordErr; ?></span> </div>
            </div>
            <div class="row my-4">
              <div class="col-md-6">
                <select name="gender" class="browser-default custom-select" style="width: 40%;">
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                  <option value="other">Other</option>
                </select>
                <span class="error"> <?php echo $genderErr; ?></span>
              </div>
              <div class="d-flex justify-content-end col-md-6 pt-md-0 pt-4"> <button class="btn" name="submit">Register Details</button></div>

            </div>




        </div>
        </form>
      </div>
    </div>




  </body>

  </html>

<?php endif; ?>