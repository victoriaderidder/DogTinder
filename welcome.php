<?php
session_start();
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="overall.css">
</head>
<body>
    <div id="cent">
        <center><h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
        <p><a href="profilecreation.php" class="btn btn-primary">Create New Dog</a><p><p>
        <a href="swipe.php" class="btn btn-primary">Swipe On Dogs</a><p>
        <a href="loves.php" class="btn btn-primary">Dogs You Love</a><p>
        <a href="logout.php" class="btn btn-primary">Sign Out of Your Account</a></center>
    </div>
</body>
</html>