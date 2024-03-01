<?php
ini_set("session.cache_limiter", "must-revalidate");
session_start();

if ($_SESSION["user"] == "faculty") : ?>
    <html lang="en">

    <head>
        <title>Faculty</title>
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
        <style>
            .hel {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-around !important;
                align-items: center;
                width: 100%;
            }

            .row {
                display: flex;
                flex-wrap: nowrap;
                justify-content: space-around !important;
                width: 100%;
                align-items: center;
                padding-top: 20px;
                padding-bottom: 10px;
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
        </style>
    </head>

    <body>

        <div class="limiter">
        <!--<button type="submit" onclick="window.open('http://localhost/sdms/index.php','_self');" class="back-btn">Back</button>
--><div class="container-login100">
                <div class="wrap-login100 hel" style="width: 800px;">
                    <div class="login100-form-title" style="background-image: url(images/bg-01.jpg);">
                        <span class="login100-form-title-1">
                            Choose Operation
                        </span>
                    </div>
                    <div class="row">
                        <button class="login100-form-btn" onclick="window.open('http://localhost/sdms/search_student.php','_self');">Search Student</button>
                        <button class="login100-form-btn" onclick="window.open('http://localhost/sdms/delete_student.php','_self');">Delete Student</button>

                    </div>
                    <div class="row">
                        <button class="login100-form-btn" onclick="window.open('http://localhost/sdms/add_student.php','_self');">Add Student</button>
                        <button class="login100-form-btn" onclick="window.open('http://localhost/sdms/show_student.php','_self');">All Student</button>


                    </div>
                    <div class="row">
                        <div>
                            <button class="login100-form-btn" onclick="window.open('http://localhost/sdms/logout.php','_self');">logout</button>
                        </div>


                    </div>
                </div>



            </div>
    </body>

    </html>

<?php endif; ?>