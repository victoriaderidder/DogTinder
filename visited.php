<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <meta charset="UTF-8">
	<title>Locations you Visited</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	<link rel="stylesheet" href="overall.css">
</head>
<body>
	<div id = "cent">
	<center>
	<h1>Locations you Visited:</h1>
	<?php
		include 'config.php';
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if (!$conn) {
			die('Could not connect: ' . mysql_error());
		}
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
					$Dog = $cell;	
					$count--;
				}
			}
        $query = "SELECT * FROM `$Dog`";
        echo "<p>".$Dog."</p>";
		$result = mysqli_query($conn, $query);
		echo "<h1>$table</h1>";
		echo '<table class = "loves_table"><tr>';
		echo "<th><b>Dog ID</b></th>";
		echo "<th style='padding-right:10px'><b>Dog Name</b></th>";
		echo "<th style='padding-right:10px'><b>Dog Description</b></th>";
		while($row = mysqli_fetch_row($result)) {
			$parameter = $row[0];	
			echo "<tr class='not-first' onclick=\"location.href='objectPage.php?param=$parameter'\">";
			$count = count($row);
			foreach($row as $cell){
				if($count == 0)
					break;
				echo "<td style='padding-right:10px'>$cell</td>";
				$count--;
			}
			echo "</tr>\n";
		}
		echo "</table><p>";
	?>
	<p><a href="location.php" class="btn btn-primary">Visit a New Location</a><p>
	<p><a href="welcome.php" class="btn btn-primary">Return Home</a><p>
</center>
</div>
</body>
</html>