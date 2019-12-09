<?php
    // Initialize the session
    session_start();
 
    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }else{
     // Include config file
    require_once "config.php";
     
    // Define variables and initialize with empty values
    $phone_number = $name = $gender  = $description = $fixed = $username ="";
    $username_err = $phone_number_err = $name_err = $gender_err = $description_err = $fixed_err ="";
    $username = trim($_SESSION["username"]);

    // Processing form data when form is submitted
    if($_SESSION["REQUEST_METHOD"] == "POST"){
     
        // Validate username'
            // Validate password
            if(empty(trim($_POST["phone_number_err"]))){
                $phone_number = "Please enter a phone_number.";     
            } else{
                $valid_number = filter_var($phone_number, FILTER_SANITIZE_NUMBER_INT);
                $valid_number = str_replace("-", "", $valid_number);
                if(preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $valid_number)) {
                        $valid_number = trim($_POST["phone_number_err"]);
                }else{
                    $phone_number = "Please enter valid a phone_number.";            
                }
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
            } elseif(strlen(trim($_POST["gender"])) < 2){
                $gender_err = "gender must have 2 characters.";
            } else{
                $gender = trim($_POST["gender"]);
            }

            if( $bit & (1 << $n) ) {
                // do something
              }

            if(empty(trim($_POST["fixed"]))){
                $fixed_err = "Please select if the dog is fixed.";     
            } elseif($_POST["fixed"] == '0'){
                $fixed = false;
            }else{
                $fixed = true;
            }
    
            if(empty(trim($_POST["description"]))){
                 $description = NULL; 
            } elseif(strlen(trim($_POST["description"])) > 500){
                $description_err = "The description has to many characters.";
            } else{
                $description = trim($_POST["description"]);
            }

        // Check input errors before inserting in database
        if(empty($name_err) && empty($gender_err) && empty($phone_number_err) && empty($fixed_err) ){
            
            // Prepare an insert statement
            $sql ="INSERT INTO `Dog_Profile` (`Phone_Number`, `Name`, `Gender`, `Fixed`, `Description`, `Username`) VALUES (?, ?, ?, ?, ?, ?);"; 
             
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ississ", $phone_number, $name, $gender, $fixed, $description, $param_username, );
                
                // Set parameters
                $param_username = $username;                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Redirect to login page
                    header("location: portfolio.php");
                } else{
                    echo "Something went wrong. Please try again later.";
                }
            }
             
            // Close statement
            mysqli_stmt_close($stmt);
        }
        
        // Close connection
        mysqli_close($link);
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
    <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                <span class="help-block"><?php echo $name_err; ?></span>
            </div>   
            <div class="form-group <?php echo (!empty($phone_number_err)) ? 'has-error' : ''; ?>">
                <label>Phone_Number</label>
                <input type="number" name="phone_number" class="form-control" value="<?php echo $phone_number; ?>">
                <span class="help-block"><?php echo $phone_number_err; ?></span>
            </div>     
            <div class="form-group <?php echo (!empty($gender_err)) ? 'has-error' : ''; ?>">
                <label>Gender</label>
                <input type="text" name="gender" class="form-control" value="<?php echo $gender; ?>">
                <span class="help-block"><?php echo $gender_err; ?></span>
            </div>
            <div class="form-group">
                <label>Description"</label>
                <input type="text" name="description" class="form-control" value="<?php echo $description; ?>">
                <span class="help-block"><?php echo $description_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($fixed_err)) ? 'has-error' : ''; ?>">
                <label>Fixed</label>
                <input type="hidden" name="fixed" value="0" />
                <input type="checkbox" name="fixed" value="1"> 
                <span class="help-block"><?php echo $fixed_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>
                <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
            </p>
        </form>
</body>
</html>