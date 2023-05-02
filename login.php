<?php  
session_start();//session starts here  
  
?>  
  
<!DOCTYPE html>
<html lang="en">
<head>
  <title>PSOV-DTS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="./resources/css/user.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <link rel="apple-touch-icon" sizes="76x76" href="./resources/img/apple-icon.png">

  <link rel="icon" type="image/png" href="./resources/img/PRDP-LOGO.png">

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="./resources/css/bootstrap.min.css" rel="stylesheet" />
  <link href="./resources/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="./resources/demo/demo.css" rel="stylesheet" />

  <!--System Stylesheet-->
  <style>
    input[type=text], select, textarea {
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 4px;
      resize: vertical;
    }

    input[type=password], select, textarea {
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 4px;
      resize: vertical;
    }

    .col-33 {
      float: center;
      width: 33.33%;
      margin-top: 6px;
    }
    
    .col-50 {
      float: left;
      width: 50%;
      margin-top: 6px;
    }
  </style>
    <!--System Stylesheet End-->

  <!--Time Script Start-->
  <script type="text/javascript">
    function startTime() {
      var today=new Date();
      var h=today.getHours();
      var min=today.getMinutes();
      var s=today.getSeconds();
      var dt = new Date();

      // add a zero in front of numbers<10
      min=checkTime(min);
      s=checkTime(s);
      document.getElementById('txt').innerHTML=(dt.getFullYear()) +"-"+ (("0"+dt.getDate()).slice(-2))+"-"+(("0"+(dt.getMonth()+1)).slice(-2)) +" "+ h+":"+min+":"+s;
      t=setTimeout('startTime()',500);
    }
    function checkTime(i) {
      if (i<10) {
        i="0" + i;
      }
      return i;
    }
  </script>
  <!--End-->

</head>
<body onload="startTime()">

  <!--Banner-->
  <div class="container p-2 my-2 bg-dark text-white">
    <img class="img-fluid" src="./resources/images/Web-Banner.png" alt="prdp-logo" height="300" width="600">
  </div>

  <!--Body Container-->
  <div class="container p-5 my-2 border">
    <h1 class="text-center">Log In to DTS</h1><br>
    <h5 class="text-center" id="txt" name="txt"></h5>

    <!--Login Container-->
    <div class="container mt-3">
      <form method="POST" action="login.php">
        <div class="mb-3 mt-3">
          <div class="row">
            <div class="col-33"></div>
            <div class="col-33">
              <label for="username"><strong>Component/Unit:</strong></label>
              <input type="text" class="form-control" id="username" placeholder="Enter User Name" name="username">
            </div>
            <div class="col-33"></div>
          </div>
          <div class="row">
            <div class="col-33"></div>
            <div class="col-33">
              <label for="pswd"><strong>Password:</strong></label>
              <input type="password" class="form-control" id="pswd" placeholder="Enter password" name="pswd">
            </div>
            <div class="col-33"></div>
          </div>
        </div>
        <div class="mb-3">
          <div class="row">
            <div class="col-33"></div>
            <div class="col-33">
              <button type="submit" class="btn btn-primary" name="login" id="login">Login</button>
            </div>
            <div class="col-33"></div>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>
</html>

<!--PHP Corner-->

<?php
include("db_connection.php");

if(isset($_POST['login'])) {
  $user_name=$_POST['username']; 
  $user_pass=$_POST['pswd'];
  date_default_timezone_set("Asia/Manila");
$time = date("H:i:s");
$date = date("Y-m-d");

  $check_user="SELECT * from users WHERE user_id='$user_pass' AND component='$user_name'";

  $mgmtQ=mysqli_query($dbcon,$check_user);

  $run=mysqli_query($dbcon,$check_user);
  if(mysqli_num_rows($run)) {
    echo "<script>window.open('dashboard.php','_self')</script>";  
    $_SESSION['username']=$user_name;//here session is used and value of $user_email store in $_SESSION.
  }
  elseif($_POST['username']=="MANAGEMENT"){
    if($_POST['pswd']=="161915") {
      echo "<script>window.open('mgt_dashboard.php','_self')</script>";  
    $_SESSION['username']=$user_name;//here session is used and value of $user_email store in $_SESSION.
    }
  }
  else {
    echo "<script>alert('Username or password is incorrect!')</script>";
  }

  //insert the user into the database.
  $insert_user="INSERT INTO users_logs_dummy (user_id, component, login_date, login_time, logout_date, logout_time, duration) VALUE ('$user_pass', '$user_name', '$date', '$time', '?','?','?')";
  if(mysqli_query($dbcon,$insert_user)) {  
    echo"<script>window.open('dashboard.php','_self')</script>";
  }
}  
?>  