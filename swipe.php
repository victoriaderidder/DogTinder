<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Swipe</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
	<center>
    <div class="swipe_on_me">
        <?php
        	include 'config.php';
        	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			if (!$conn) {
				die('Could not connect: ' . mysql_error());
			}

			// display name of dog to swipe on
			$query = "SELECT Name
						FROM Dog_Profile
						ORDER BY rand()
						LIMIT 1";

			$result = mysqli_query($conn, $query);
			if (!$result) {
				die("Query failed $query");
			}

			while($row = mysqli_fetch_row($result)) {
				$count = count($row);
				foreach($row as $cell){
					if($count == 0)
						break;
					echo "<h1>$cell</h1>";
					$Dog_name = $cell;	
					$count--;
				}
			}

			// display description of dog to swipe on
			$query = "SELECT Description
						FROM Dog_Profile
						WHERE Name = '$Dog_name'";

			$result = mysqli_query($conn, $query);
			if (!$result) {
				die("Query failed $query");
			}

			while($row = mysqli_fetch_row($result)) {
				$count = count($row);
				foreach($row as $cell){
					if($count == 0)
						break;
					echo "$cell<br>";
					$count--;
				}
			}

			// get ID of dog to swipe on
			$query = "SELECT Dog_ID
						FROM Dog_Profile
						WHERE Name = '$Dog_name'";
			$result = mysqli_query($conn, $query);
			if (!$result) {
				die("Query failed $query");
			}
			while($row = mysqli_fetch_row($result)) {
			$count = count($row);
			foreach($row as $cell){
				if($count == 0)
					break;
				$Dog_2 = $cell;	
				$count--;
				}
			}

			// get ID of OG dog
			$User = $_SESSION['username'];
			$query = "SELECT Dog_ID
						FROM Dog_Profile
						WHERE Username = '$User'";
			$result = mysqli_query($conn, $query);
			while($row = mysqli_fetch_row($result)) {
				$count = count($row);
				foreach($row as $cell){
					if($count == 0)
						break;
					$Dog_1 = $cell;	
					$count--;
				}
			}

			// creates a key that will be used with the Loves and Hates tables
			$key = "$Dog_1" . "$Dog_2";

			// bool that tells you if you can swipe
			$can_swipe = "T";
			?>

		<p><form method="POST">
			<input type="submit" class="btn btn-primary" value="yes" name="yes">
			<?php
				// insert into Loves on yes click
				if(isset($_POST['submit'])){
				    $id = $_POST['submit'];
				    $removeQuery = "INSERT INTO Loves ('$Dog_1', '$Dog_2', '$key')";
				    $result = mysql_query($removeQuery);
				    if($result) {
				        header('Location: '.$_SERVER['REQUEST_URI']);
				    }
				}
			?>
		</form>
		<form method="POST">
			<input type="submit" class="btn btn-primary" value="no" name="no">
			<?php
				// insert into Hates on no click
				if(isset($_POST['submit'])){
					if ("$can_swipe" == "T") {
						$query = "INSERT INTO Hates ('$Dog_1', '$Dog_2', '$key')";
						$result = mysqli_query($query);
					}
				}
			?>
		</form></p>

		<?php

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
						echo "You already love this dog!";	
						$can_swipe = "F";
					}
					$count--;
				}
			}

			// if key is in Hates tell the user they already hate this dog!
			$query = "SELECT HateKey
						FROM Hates
						WHERE HateKey = '$key'";
			$result = mysqli_query($conn, $query);
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

		?>
    </div>  
    </center>  
</body>
</html>