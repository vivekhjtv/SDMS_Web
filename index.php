<?php
ini_set("session.cache_limiter", "must-revalidate");
session_start();

$_SESSION["user"] = "1";
$_SESSION["confirm_delete"] = "0";

$passwordErr = $useridErr = "";
$user = $password = $userid = "";

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $_SERVER = "localhost";
    $username = "root";
    $password = "";

    $con = mysqli_connect($_SERVER, $username, $password);



    $user = test_input($_POST["user"]);
    // check if name only contains letters and whitespace

    if (empty($_POST["userid"])) {
        $useridErr = "userid is required";
    } else {
        $userid = test_input($_POST["userid"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[0-9]*$/", $userid)) {
            $useridErr = "Only digits allowed";
        }
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {

        $password = test_input($_POST["password"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-0-9' ]*$/", $password)) {
            $passwordErr = "Only letters and digits allowed";
        }
    }

    if ($useridErr == $passwordErr) {
        if ($user == "student") {

            $sql = "SELECT * FROM `student_info`.`students` WHERE  `enroll`=$userid ;";
            $result = $con->query($sql);
            $num_rows = mysqli_num_rows($result);

            if ($num_rows == 1) {

                $row = $result->fetch_assoc();
                if ($password == $row["password"]) {
                    //echo "Record Found <br>";
                    $_SESSION["user"] = "student";
                    $_SESSION["logged"] = "true";
                    $_SESSION["student_enroll"] = $userid;
                    $con->close();
                    echo '<script type="text/javascript">window.open("http://localhost/sdms/student.php","_self");</script>';
                } else {
                    $passwordErr =  "Password Incorrect";
                }
            } else {
                $useridErr =  "Invalid userid";
            }
        } else if ($user == "admin") {
            $sql = "SELECT * FROM `student_info`.`admin` WHERE  `userid`=$userid ;";
            $result = $con->query($sql);
            $num_rows = mysqli_num_rows($result);

            if ($num_rows == 1) {

                $row = $result->fetch_assoc();
                if ($password == $row["password"]) {
                    //echo "Record Found <br>";
                    $_SESSION["user"] = "admin";
                    $_SESSION["logged"] = "true";
                    $con->close();
                    echo '<script type="text/javascript">window.open("http://localhost/sdms/admin.php","_self");</script>';
                } else {
                    $passwordErr = "Password Incorrect <br>";
                }
            } else {
                $useridErr =  "Invalid userid <br>";
            }
        } else {

            $sql = "SELECT * FROM `student_info`.`faculty` WHERE  `userid`=$userid ;";
            $result = $con->query($sql);
            $num_rows = mysqli_num_rows($result);

            if ($num_rows == 1) {

                $row = $result->fetch_assoc();
                if ($password == $row["password"]) {
                    //echo "Record Found <br>";
                    $_SESSION["user"] = "faculty";
                    $_SESSION["logged"] = "true";
                    $con->close();
                    echo '<script type="text/javascript">window.open("http://localhost/sdms/faculty.php","_self");</script>';
                } else {
                    $passwordErr = "Password Incorrect <br>";
                }
            } else {
                $useridErr =  "Invalid userid <br>";
            }
        }
    }
}

?> 


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
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
    
</head>

<body >

    <div class="limiter" style="background: #ebeeef;">
    
        <div class="container-login100">
        
            <div class="wrap-login100">
            
                <div class="login100-form-title" style="background-image: url(images/bg-01.jpg);">
                    <span class="login100-form-title-1">
                        Enter Log In Details
                    </span>
                </div>

                <form method="post" action="<?php $_PHP_SELF ?>" class="login100-form validate-form">
                    <div class="wrap-input100 validate-input m-b-26" style="border-bottom: 0px;" data-validate="Username is required">
                        <span class="label-input100">User type</span>

                        <select name="user" class="browser-default custom-select">
                            <option value="faculty">Faculty</option>
                            <option value="student">Student</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100">Username</span>
                        <input class="input100" type="text" name="userid" placeholder="Enter username">
                        <span class="focus-input100"></span>
                        <span class="phperror" style="font-family: Poppins-Regular;
  font-size: 10px; color: #808080 ; line-height: 1.2 ; text-align: right;"><?php echo $useridErr; ?></span>

                    </div>

                    <div class="wrap-input100 validate-input m-b-18" data-validate="Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="password" placeholder="Enter password">
                        <span class="focus-input100"></span>
                        <span class="phperror" style="font-family: Poppins-Regular;
  font-size: 10px; color: #808080 ; line-height: 1.2 ; text-align: right;"><?php echo $passwordErr; ?></span>
                    </div>

                    <div class="container-login100-form-btn" style="justify-content: center;">
                        <button type="submit" class="login100-form-btn">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>




</body>

</html>