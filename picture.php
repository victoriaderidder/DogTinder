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
        $name = $username = $dog_id ="";
        $username_err = $name_err ="";
        $username = trim($_SESSION["username"]);
        // Processing form data when form is submitted
        if($_SERVER["REQUEST_METHOD"] == "POST"){
        
            // Validate username'
                // Validate password
                $file = $_FILES['file'];
                $fileName = $_FILES['file']['name'];
                $fileTmpName = $_FILES['file']['tmp_name'];
                $fileSize = $_FILES['file']['size'];
                $file_err = $_FILES['file']['error'];
                $fileType = $_FILES['file']['type'];
                $fileExt = explode('.',$fileName);
                $fileActExt = strtolower(end($fileExt));
                $allowed = array('jpg', 'jpeg', 'png');
                $fileNameNew = 0;
                if(in_array($fileActExt, $allowed)){
                    if($file_err == 00){
                        if($fileSize  < 500000){
    
                            $query = "SELECT * FROM Dog_Profile WHERE Username='$username'";
                            $result = mysqli_query($link, $query);
                            if (!$result) {
                                die("Query to show fields from table failed");
                            }
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_array($result)){
                                    $dog_id =  $row['Dog_ID'];
                                }
                                $query = "SELECT * FROM ImgUpload WHERE Dog_ID='$dog_id'";
                                $result = mysqli_query($link, $query);
                                if (!$result) {
                                    die("Query to show fields from table failed");
                                }
                                if(mysqli_num_rows($result) > 0){
                                    echo "you have already uploaded an image";
                                }else{
                                    $l = "";
                                    $k = false;
                                    while($k !== true){
                                        $files = gen_uid();
                                        // Prepare a select statement
                                        $sql = "SELECT ImgName FROM `ImgUpload` WHERE ImgName=?";
                                        if($stmt = mysqli_prepare($link, $sql)){
                                                // Bind variables to the prepared statement as parameters
                                                mysqli_stmt_bind_param($stmt, "s", $param_files);
                                                    // Set parameters
                                                    $param_files = $files;
                                                    
                                                    // Attempt to execute the prepared statement
                                                    if(mysqli_stmt_execute($stmt)){
                                                        /* store result */
                                                        mysqli_stmt_store_result($stmt);
                                                        
                                                        if(mysqli_stmt_num_rows($stmt) == 1){
                                                            $files_err = "This dog_id is already taken.";
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
                                    $fileNameNew = $files.".".$fileActExt;
                                    $fileDestination = 'uploads/'.$fileNameNew;
                                    move_uploaded_file($fileTmpName, $fileDestination);
                                }
                                mysqli_free_result($result);
                                $sql ="INSERT INTO `ImgUpload` (`Dog_ID`, `ImgName`) VALUES (?, ?);"; 
                
                                if($stmt = mysqli_prepare($link, $sql)){
                                    // Bind variables to the prepared statement as parameters
                                    mysqli_stmt_bind_param($stmt, "is", $param_dog_id, $param_ImgName);
                                    $param_dog_id= $dog_id;
                                    $param_ImgName = $fileNameNew;      
                                    // Attempt to execute the prepared statement
                                    if(mysqli_stmt_execute($stmt)){
                                        header("location: portfolio.php");
                                    }
                                }
                                    mysqli_stmt_close($stmt); 
                                    mysqli_free_result($result);
                                }else{
                                    echo "You cannot upload a picture you don't have a dog";
                                }
                        }else{
                            echo "The file is to big";
                        }
                    }else{
                        echo "You cannot upload files of this type";
                    }
                }else{
                    echo "You cannot upload files of this type";
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
        <h1>Upload a Dog Photo.</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                <label>File</label>
                <input type="file" name="file" class="form-control" value="<?php echo $file; ?>">
                <span class="help-block"><?php echo $file_err; ?></span>
            </div>   
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-primary" value="Reset">
            </div>
            <p>
                <a href="welcome.php"><input type="home" class="btn btn-primary" value="Return Home"></a>
            </p>
        </form>
    </div>
    </div>
</body>
</html>