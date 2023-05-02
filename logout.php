<?php  
/** 
 * Created by PhpStorm. 
 * User: Ehtesham Mehmood 
 * Date: 11/21/2014 
 * Time: 2:46 AM 
 */  
require_once('db_connection.php');
session_start();//session is a way to store information (in variables) to be used across multiple pages.
date_default_timezone_set("Asia/Manila");
$time = date("H:i:s");
$date = date("Y-m-d");
$user=$_SESSION["username"];
$log="UPDATE users_logs_dummy SET logout_date = '$date', logout_time = '$time' WHERE component = '$user';

INSERT INTO user_logs (user_id, component, login_date, login_time, logout_date, logout_time, duration) SELECT * from users_logs_dummy where component='$user';

DELETE FROM users_logs_dummy";
  if(mysqli_multi_query($dbcon,$log))  {  
    session_unset();
    session_destroy();
    header("Location: login.php");//use for the redirection to some page  
  }
?>