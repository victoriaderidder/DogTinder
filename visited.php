<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    </div>
<?php
    // Initialize the session
    session_start();
    require_once "config.php";
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }elseif(isset($_SESSION["username"]) ){
    $username = $_SESSION["username"];
    
    
    // query to select all information from supplier table
	$query = "SELECT * FROM Dog_Profile WHERE Username='$username'";
	$result = mysqli_query($link, $query);
	if (!$result) {
		die("Query to show fields from table failed");
	}
	if(mysqli_num_rows($result) > 0){

        echo "<h1>Dog_Profile</h1>";  
        while($row = mysqli_fetch_array($result)){
         
            echo "<div>";
            $dog_id = $row['Dog_ID'];
            $queryview = "SELECT * FROM `$dog_id` WHERE 1";
            $resultview = mysqli_query($link, $queryview);
            if (!$resultview) {
                die("Query to show fields from table failed");
            }
            if(mysqli_num_rows($resultview) > 0){
                echo "<h1>Dog_Profile</h1>";  
                while($rowview = mysqli_fetch_array($resultview)){
                    echo "<h2> DogName: ".$rowview['DogName']."</h2>";
                    echo "<p> LocName: ". $rowview['LocName'] ."</p>";
                    echo "<p> State: " . $rowview['State'] . "</p>";
                }

            }   
            // Free result set
            mysqli_free_result($resultview);
        }
        mysqli_free_result($result);
    }else{
            header("location: welcome.php");
            exit;
        } 
    mysqli_close($link);
}else{
    echo("Query failed try again latter.");
    exit;
}
    ?>
            <p>
                <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
            </p>
            <p>
                <a href="portfolio.php" class="btn btn-danger">Sign Out of Your Account</a>
            </p>
            <p>
                <a href="location.php" class="btn btn-danger"> Find a Location </a>
            </p>
            <p>
                <a href="update.php" class="btn btn-danger"> Update Your Account </a>
            </p>
            <p>
                <a href="swipe.php" class="btn btn-danger">Swipe On Dogs</a>
            </p>

            
</body>
</html>

	
