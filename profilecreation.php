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
        // Processing form data when form is submitted
        if($_SERVER["REQUEST_METHOD"] == "POST"){
        
            // Validate username'
                // Validate password
                if(empty(trim($_POST["phone_number"]))){
                    $phone_number_err = "Please enter a phone_number.";     
                } else{
                    $phone_number = trim($_POST["phone_number"]);
                }   
                // Validate password
                if(empty(trim($_POST["name"]))){
                    $name_err = "Please enter a name.";     
                } else{
                    $name = trim($_POST["name"]);
                }
                // Validate password
                if(empty(trim($_POST["gender"]))){
                    $gender_err = "Please enter a gender.";     
                } elseif(strlen(trim($_POST["gender"])) > 2){
                    $gender_err = "gender must have 2 or less characters.";
                } else{
                    $gender = trim($_POST["gender"]);
                }
                if(isset($_GET['option1'])) { 
                    $fixed = true;
                }else{
                    $fixed = false;   
                }
        
                if(empty(trim($_POST["description"]))){
                    $description = NULL; 
                } elseif(strlen(trim($_POST["description"])) > 500){
                    $description_err = "The description has to many characters.";
                } else{
                    $description = trim($_POST["description"]);
                }
            // Check input errors before inserting in database
            if(empty($name_err) && empty($gender_err) && empty($phone_number_err)){
                
                    $l = "";
                    $k = false;
                    while($k !== true){
                        $dog_id = gen_uid();
                        // Prepare a select statement
                        $sql = "SELECT Dog_ID FROM `Dog_Profile` WHERE Dog_ID=?";
                        if($stmt = mysqli_prepare($link, $sql)){
                                // Bind variables to the prepared statement as parameters
                                mysqli_stmt_bind_param($stmt, "s", $param_dog_id);
                                    // Set parameters
                                    $param_dog_id = $dog_id;
                                    
                                    // Attempt to execute the prepared statement
                                    if(mysqli_stmt_execute($stmt)){
                                        /* store result */
                                        mysqli_stmt_store_result($stmt);
                                        
                                        if(mysqli_stmt_num_rows($stmt) == 1){
                                            $dog_id_err = "This dog_id is already taken.";
                                        } else{
                                            $k = true;
                                        }
                                    } else{
                                        echo "Oops! Something went wrong. Please try again later.";
                                    }
                        }
                        // Close statement
                        mysqli_stmt_close($stmt);
                    }
                // Prepare an insert statement
                $sql ="INSERT INTO `Dog_Profile` (`Phone_Number`, `Name`, `Gender`, `Fixed`, `Description`, `Dog_ID`, `Username`) VALUES (?, ?, ?, ?, ?, ?, ?);"; 
                
                if($stmt = mysqli_prepare($link, $sql)){
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "issisis", $param_phone_number, $param_name, $param_gender, $fixed, $param_description, $param_dog_id, $param_username);
                    $param_dog_id= $dog_id;
                    $param_phone_number = $phone_number;
                    $param_name = $name;
                    $param_gender = $gender;
                    $param_username = $username;
                    $param_description = $description;              
                    // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
      
                        $sql = "SELECT * FROM `Dog_Profile` WHERE Username=?";
        
                        if($stmt = mysqli_prepare($link, $sql)){
                            // Bind variables to the prepared statement as parameters
                            mysqli_stmt_bind_param($stmt, "s", $param_username);
                            
                            // Set parameters
                            $param_username = $username;
                            
                            // Attempt to execute the prepared statement
                            if(mysqli_stmt_execute($stmt)){
                                // Store result
                                mysqli_stmt_store_result($stmt);
                                
                                // Check if username exists, if yes then verify password
                                if(mysqli_stmt_num_rows($stmt) == 1){                    
                                    // Bind result variables
                                    mysqli_stmt_bind_result($stmt, $username);
                                    if(mysqli_stmt_fetch($stmt)){
                                        header("location: portfolio.php");
                                        exit;
                                    }
                                }else{
                                    header("location: welcome.php");
                                    exit;
                                }
                            }
                        }    
                    }
                } 
                // Close statement
                mysqli_stmt_close($stmt);
            }else{
                echo "Something was empty. Please try again later.";
                header("location: welcome.php");
                exit;
            }
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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="overall.css">
</head>
<body>
    <div id="cent">
        <div id="cent2">
            <h1>Please create a dog.</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err; ?></span>
                        </div>   
                        <div class="form-group <?php echo (!empty($phone_number_err)) ? 'has-error' : ''; ?>">
                            <label>Phone_Number</label>
                            <input type="number" name="phone_number" min="0000000000" max="9999999999" class="form-control" value="<?php echo $phone_number; ?>">
                            <span class="help-block"><?php echo $phone_number_err; ?></span>
                        </div>     
                        <div class="form-group <?php echo (!empty($gender_err)) ? 'has-error' : ''; ?>">
                            <label>Gender</label>
                            <input type="text" name="gender" class="form-control" value="<?php echo $gender; ?>">
                            <span class="help-block"><?php echo $gender_err; ?></span>
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
                            <input type="reset" class="btn btn-primary" value="Reset">
                        </div>
                </form>
                <a href="welcome.php"><input class="btn btn-primary" value="Cancel"></a>
        </div>
    </div>
</body>
</html>