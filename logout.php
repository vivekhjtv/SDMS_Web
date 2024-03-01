<?php
ini_set("session.cache_limiter", "must-revalidate");
session_start();

if ($_SESSION["logged"] == "true") {

    $_SESSION["user"] = "1";
    $_SESSION["logged"] = "false";
    $_SESSION["student_enroll"] = "";

    header("Location: index.php");
}
