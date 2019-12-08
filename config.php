<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_HOST', 'classmysql.engr.oregonstate.edu');
  define('DB_USER', 'cs340_massonit');
  define('DB_PASSWORD', 'Hakashia7');
  define('DB_NAME', 'cs340_massonit');
  define('CON_STRING', 'mysql:host=classmysql.engr.oregonstate.edu;dname=cs340_massonit');

 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>