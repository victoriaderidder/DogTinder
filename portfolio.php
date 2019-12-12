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
        <div id="cent2">
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
        while($row = mysqli_fetch_array($result)){
         
            echo "<div>";
            $dog_id = $row['Dog_ID'];
            echo "<h1>".$row['Name']." is a good dog.</h1>";
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
            echo "<p class='title'><b>Phone Number:</b> ". $row['Phone_Number'] ."</p>";
            echo "<p><b>Description: </b>". $row['Description'] ."</p>";
            echo "<p><b>Gender: </b>" . $row['Gender'] . "</p>";
            if($row['Fixed'] == 0){
                echo "<p> <b>Fixed: </b> Yes </p>";
            }else{
                echo "<p> <b>Fixed: </b> No </p>";
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
            <p><center>
                <a href="picture.php" class="btn btn-primary">Add a Photo to Your Account</a>
            </p>
            <p>
                <a href="welcome.php" class="btn btn-primary">Return Home</a>
            </p></center>
</div>
</div>     
</body>
</html>