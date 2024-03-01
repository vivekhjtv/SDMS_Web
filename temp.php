<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    echo "Hello";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="UTF-8">
</head>

<body>
    <form method="post" action="<?php $_PHP_SELF ?>">
        <input type="text" name="userid" placeholder="Enter username">
        <button type="submit">Login</button>
    </form>
</body>

</html>