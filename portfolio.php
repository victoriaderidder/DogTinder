

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
    }
    $username = $_SESSION["username"];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // query to select all information from supplier table
	$query = "SELECT * FROM Dog_Profile WHERE Username=?";
	
    // Get results from query
	$result = mysqli_query($link, $query);
	if (!$result) {
		die("Query to show fields from table failed");
	}

	if(mysqli_num_rows($result) > 0){
        echo "<h1>Dog_Profile</h1>";  
		echo "<table id='t01' border='1'>";
        echo "<thead>";
			echo "<tr>";
			echo "<th>Phone Number</th>";
			echo "<th>Name</th>";
            echo "<th>Gender</th>";
            echo "<th>Fixed</th>";
            echo "<th>Description</th>";
			echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
		
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td>" . $row['Phone_Number'] . "</td>";
			echo "<td>" . $row['Name'] . "</td>";
            echo "<td>" . $row['Gender'] . "</td>";
            echo "<td>" . $row['Fixed'] . "</td>";
            echo "<td>" . $row['Description'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";                            
        echo "</table>";
		// Free result set
        mysqli_free_result($result);
    } else{
        header("location: welcome.php");
        exit;
    } 
	mysqli_close($conn);
    ?>
            <p>
                <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
            </p>
</body>
</html>

	
