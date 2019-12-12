<?php
    // Initialize the session
    session_start();

    function gen_uid(){
        return substr(hexdec(uniqid()),0,9);
    }
 
    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }elseif(isset($_SESSION["username"]) ){
        // Include config file
        require_once "config.php";
        
        // Define variables and initialize with empty values
        $phone_number = $name = $gender  = $description = $fixed = $username ="";
        $username_err = $phone_number_err = $name_err = $gender_err = $description_err = $fixed_err ="";
        $username = trim($_SESSION["username"]);
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
                echo "<p>" . $row['Gender'] . "</p>";
                $phone_number2 =  $row['Phone_Number'];
                $fixed2 = $row['Fixed'];
                $description2 = $row['Description'];
            }
                // Free result set
                mysqli_free_result($result);
        }
        // Processing form data when form is submitted
        if($_SERVER["REQUEST_METHOD"] == "POST"){
        
            // Validate username'
                // Validate password
                if(empty(trim($_POST["phone_number"]))){
                    $phone_number = $phone_number2;     
                } else{
                    $phone_number = trim($_POST["phone_number"]);
                }   

                if(isset($_GET['option1'])) { 
                    $fixed = true;
                }else{
                    $fixed = false;   
                    if($fixed2 !== $fixed){
                        $fixed = $fixed2;
                    }
                }
        
                if(empty(trim($_POST["description"]))){
                    $description = $description2; 
                }else{
                    $description = trim($_POST["description"]);
                }
                // Prepare an insert statement
                $sql =" UPDATE `Dog_Profile` SET `Phone_Number`=?, `Fixed`=?, `Description`=? WHERE Username=?"; 
                
                if($stmt = mysqli_prepare($link, $sql)){
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "iiss", $param_phone_number, $fixed, $param_description, $param_username);
                    $param_phone_number = $phone_number;
                    $param_username = $username;
                    $param_description = $description;              
                    // Attempt to execute the prepared statement
                    mysqli_stmt_execute($stmt);  
                    header("location: portfolio.php");
                }else{
                    echo"something went wrong please try again";
                } 
                // Close statement
                mysqli_stmt_close($stmt);
        }      
            // Close connection
            mysqli_close($link);
    }else{
        echo("Query failed try again latter.");
        exit;
    }
    ?>
 
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
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($phone_number_err)) ? 'has-error' : ''; ?>">
                <label>Phone_Number</label>
                <input type="number" name="phone_number" min="0000000000" max="9999999999" class="form-control" value="<?php echo $phone_number; ?>">
                <span class="help-block"><?php echo $phone_number_err; ?></span>
            </div>     
            <div class="form-group">
                <label>Description</label>
                <input type="text" name="description" class="form-control" value="<?php echo $description; ?>">
                <span class="help-block"><?php echo $description_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($fixed_err)) ? 'has-error' : ''; ?>">
                <label>Fixed</label>
                <input type="checkbox" name = "option1" class = "form-contro" value="Option 1"/>
                <span class="help-block"><?php echo $fixed_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>
                <a href="portfolio.php" class="btn btn-danger">Sign Out of Your Account</a>
            </p>
        </form>
</body>
</html>