

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
            echo "<h2>".$row['Name']."</h2>";
            $sqlImg = "SELECT * FROM ImgUpload WHERE Dog_ID='$dog_id'";
            $resultImg = mysqli_query($link, $sqlImg);
            if (!$resultImg) {
                die("Query to show fields from table failed");
            }
            if(mysqli_num_rows($resultImg) > 0){
                While($rowImg = mysqli_fetch_array($resultImg)){ 
                    $image = $rowImg['ImgName'];
                    echo "<img src='uploads/".$image."' style='width:100%height:200px;' />";
                }
            }
            echo "<p class='title'>Phone Number: ". $row['Phone_Number'] ."</p>";
            echo "<p>". $row['Description'] ."</p>";
            echo "<p>" . $row['Gender'] . "</p>";
            if($row['Fixed'] == 0){
                echo "<p> Fixed: True </p>";
            }else{
                echo "<p> Not Fixed </p>";

            }
        }
		// Free result set
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
                <a href="picture.php" class="btn btn-danger">Add a Photo to Your Account</a>
            </p>
            <p>
                <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
            </p>
            <p>
                <a href="swipe.php" class="btn btn-danger">Swipe On Dogs</a>
            </p>

            
</body>
</html>

	
