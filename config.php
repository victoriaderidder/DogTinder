<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_HOST', 'classmysql.engr.oregonstate.edu');
  define('DB_USER', 'cs340_onid');
  define('DB_PASSWORD', 'password');
  define('DB_NAME', 'cs340_onid');
  define('CON_STRING', 'mysql:host=classmysql.engr.oregonstate.edu;dname=cs340_onid');

 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
