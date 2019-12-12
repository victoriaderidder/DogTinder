<?php
    // Initialize the session
    session_start();
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="overall.css">
</head>
<body>
	<center>
    <div id="cent">
    	<?php
    	    function gen_uid(){
        return substr(hexdec(uniqid()),0,9);
    }
 
    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }elseif(isset($_SESSION["username"]) ){
        // Include config file
        $User = $_SESSION["username"];
        require_once "config.php";
        // Processing form data when form is submitted
        if($_SERVER["REQUEST_METHOD"] == "POST"){
                
        // display name of dog to swipe on
        $query = "SELECT Name, Dog_ID FROM Dog_Profile ORDER BY rand() LIMIT 1";
        $result = mysqli_query($link, $query);
        if (!$result) {
            die("Query failed $query");
        }
        while($row = mysqli_fetch_row($result)) {
            $count = count($row);
            foreach($row as $cell){
                if($count == 0)
                    break;
                echo "<h1>".$cell."</h1>";
                $Dog_2 = $cell;	
                $count--;
            }
        }

        mysqli_free_result($result);
        $query = "SELECT Description FROM Dog_Profile WHERE Dog_ID = '$Dog_2'";
        $result = mysqli_query($link, $query);
        while($row = mysqli_fetch_row($result)) {
            $count = count($row);
            foreach($row as $cell){
                if($count == 0)
                    break;
                echo "<p>".$cell."</p>";	
                $count--;
            }
        } 
        mysqli_free_result($result);
        // get ID of OG dog
        $query = "SELECT Dog_ID FROM Dog_Profile WHERE Username = '$User'";
        $result = mysqli_query($link, $query);
        while($row = mysqli_fetch_row($result)) {
            $count = count($row);
            foreach($row as $cell){
                if($count == 0)
                    break;
                $Dog_1 = $cell;	
                $count--;
            }
        }
        mysqli_free_result($result);
        // creates a key that will be used with the Loves and Hates tables
        $key = "$Dog_1" . "$Dog_2";
        // bool that tells you if you can swipe
        $can_swipe = "T";
        // Prepare an insert statement
        $sql = "INSERT INTO `Loves` (`Dog_ID`, `LovesDog_ID_2`, `LoveKey`) VALUES(?, ?, ?);"; 
        if(($_POST["likes"])){
            if ("$can_swipe" == "T") {
                if($stmt = mysqli_prepare($link, $sql)){
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "iii", $param_Dog_1, $param_Dog_2, $param_key);
                    // Set parameters
                    $param_Dog_1 = $Dog_1;
                    $param_Dog_2 = $Dog_2;
                    $param_key = $key;
                    // Attempt to execute the prepared statement
                    mysqli_stmt_execute($stmt);
                    header('Location: '.$_SERVER['REQUEST_URI']);
                }
            }
            mysqli_free_result($stmt);
        }
        // insert into Hates on no click
        $sql2 = "INSERT INTO `Hates` (`Dog_ID`, `HatesDog_ID_2`, `HateKey`) VALUES(?, ?, ?);"; 
        if(($_POST["dislikes"])){
            if ("$can_swipe" == "T") {
                if($stmt = mysqli_prepare($link, $sql2)){
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "iii", $param_Dog_1, $param_Dog_2, $param_key);
                    // Set parameters
                    $param_Dog_1 = $Dog_1;
                    $param_Dog_2 = $Dog_2;
                    $param_key = $key;
                    // Attempt to execute the prepared statement
                    mysqli_stmt_execute($stmt);
                    header('Location: '.$_SERVER['REQUEST_URI']);
                }
            }
            mysqli_free_result($stmt);
        }
        // if key is in Loves tell the user they already love this dog!
        $query = "SELECT LoveKey
                    FROM Loves
                    WHERE LoveKey = '$key'";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_row($result)) {
            $count = count($row);
            foreach($row as $cell){
                if($count == 0)
                    break;
                else {
                    echo "<p> You already love this dog! </P";	
                    $can_swipe = "F";
                }
                $count--;
            }
        }
        mysqli_free_result($result);
        // if key is in Hates tell the user they already hate this dog!
        $query = "SELECT HateKey
                    FROM Hates
                    WHERE HateKey = '$key'";
        $result = mysqli_query($link, $query);
        while($row = mysqli_fetch_row($result)) {
            $count = count($row);
            foreach($row as $cell){
                if($count == 0)
                    break;
                else {
                    echo "You already hate this dog!";	
                    $can_swipe = "F";
                }
                $count--;
            }
        }
        mysqli_free_result($result);
      
    }
        // Close connection
        mysqli_close($link);
    }else{
        echo("Query failed, try again later.");
        exit;
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
             <div class="form-group">
			    <p><input type="submit" class="btn btn-primary" value="yes" name="likes"> <input type="submit" class="btn btn-primary" value="no" name="dislikes"><p>
            </div>

           <div class="form-group>">
                <p><input type="submit" class="btn btn-primary" value="Load Dogs" name="load">
            </div>
            <p>
                <a href="welcome.php" class="btn btn-primary">Return Home</a>
            </p>
        </form>
    </div>
</center>
</body>
</html>