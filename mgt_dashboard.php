<?php  
session_start();  
  
if(!$_SESSION['username']) {
  header("Location: login.php");//redirect to the login page to secure the welcome page without login access.  
}  
  
?>  
  
<!DOCTYPE html>
<html lang="en">
<head>
  <title>PSOV-DTS</title>
  <meta charset="utf-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" type="text/css" href="./resources/css/user.css">
        <link rel="apple-touch-icon" sizes="76x76" href="./resources/img/apple-icon.png">
        <link rel="icon" type="image/png" href="./resources/img/PRDP-LOGO.png">
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  
  <!-- CSS Files -->

  <link href="./resources/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />

  <!--Style-->
  <style>
    * {
      box-sizing: border-box;
    }
    
    input[type=text], select, textarea {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 4px;
      resize: vertical;
    }
    
    label {
      padding: 12px 12px 12px 0;
      display: inline-block;
    }
    
    input[type=submit] {
      background-color: #4CAF50;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      float: right;
    }

    .modal {
      height: 100%;

    }
    
    input[type=submit]:hover {
      background-color: #45a049;
    }
    
    .container {
      border-radius: 5px;
      background-color: #f2f2f2;
      padding: 20px;
    }
    
    .col-25 {
      float: left;
      width: 25%;
      margin-top: 6px;
    }
    
    .col-75 {
      float: left;
      width: 75%;
      margin-top: 6px;
    }
    
    /* Clear floats after the columns */
    .row:after {
      content: "";
      display: table;
      clear: both;
    }
    
    /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
    @media screen and (max-width: 600px) {
      .col-25, .col-75, input[type=submit] {
        width: 100%;
        margin-top: 0;
      }
    }
    </style>  
  
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
          document.getElementById('txt').innerHTML=(("0"+(dt.getMonth()+1)).slice(-2)) +"-"+ (("0"+dt.getDate()).slice(-2)) +"-"+ (dt.getFullYear()) +" "+ h+":"+min+":"+s;
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
  <!--Page Banner-->
  <div class="container p-2 my-2 bg-dark text-white">
    <div class="row">
      <div class="col-sm-9">
        <img class="img-fluid" src="./resources/images/Web-Banner.png" alt="prdp-logo" height="300" width="600">
      </div>
      <div class="col-sm-3 pl-1">
        <h4 name="date_time" id="txt"></h4>
      </div>
    </div>
  </div>

  <!--NavBar Section-->
  <div class="container p-2 border">
    <ul class="nav nav-tabs" role="tablist">
     <li class="nav-item">
        <a class="nav-link active" href="mgt_dashboard.php">DASHBOARD</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="user.php">USERS</a>
      </li>
      <li class="nav-item">
        <a type="text" id="user_name" name="user_name" class="nav-link" data-bs-toggle="dropdown"><?php echo $_SESSION['username']; ?></a>
        <ul class="dropdown-menu">
          <li>
            <a class="dropdown-item" href="logout.php" name="LO" id="LO">Logout</a>
          </li>
        </ul>
      </li> 
    </ul>
    
    <!-- Tab panes-->
    <!--Dashboard-->
    <div id="dashboard" class="container tab-pane active"><br>
      <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-body ">
              <div class="row">
                <div class="col-5 col-md-4">
                  <div class="icon-big text-center icon-warning">
                    <i data-bs-toggle="collapse" data-bs-target="#sTable" class="nc-icon nc-single-copy-04 text-warning"></i>
                  </div>
                </div>
                <div class="col-7 col-md-8">
                  <div class="numbers">
                    <p class="card-category">System Documents</p>
                    <?php
                    $con = mysqli_connect("localhost","root","","dts_dbase");
                    // SQL query to display row count
                    $sql = "SELECT * from document_logs";
                    if ($result = mysqli_query($con, $sql)) {
                    // Return the number of rows in result set
                      $rowcount = mysqli_num_rows( $result );
                      // Display result
                      printf("<p class='card-title'> %d", $rowcount , "</p>");
                    }
                    // Close the connection
                    mysqli_close($con);
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer ">
              
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-body ">
              <div class="row">
                <div class="col-5 col-md-4">
                  <div class="icon-big text-center icon-warning">
                    <i data-bs-toggle="collapse" data-bs-target="#uTable" class="nc-icon nc-single-02 text-success"></i>
                  </div>
                </div>
                <div class="col-7 col-md-8">
                  <div class="numbers">
                    <p class="card-category">Users Logs</p>
                    <?php
                    $con = mysqli_connect("localhost","root","","dts_dbase");
                    // SQL query to display row count
                    $user=$_SESSION['username'];
                    $sql = "SELECT * FROM user_logs";
                    if ($result = mysqli_query($con, $sql)) {
                    // Return the number of rows in result set
                      $rowcount = mysqli_num_rows( $result );
                      // Display result
                      printf("<p class='card-title'> %d", $rowcount , "</p>");
                    } else {
                      Echo "0";
                    }
                    // Close the connection
                    mysqli_close($con);
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              
            </div>
          </div>
        </div>
          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i data-bs-toggle="collapse" data-bs-target="#dTable" class="nc-icon nc-paper text-danger"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Document Logs</p>
                      <?php
                      $con = mysqli_connect("localhost","root","","dts_dbase");
                      // SQL query to display row count
                      $user=$_SESSION['username'];
                      $sql = "SELECT * FROM docu_query";
                      if ($result = mysqli_query($con, $sql)) {
                      // Return the number of rows in result set
                      $rowcount = mysqli_num_rows( $result );
                      // Display result
                      printf("<p class='card-title'> %d", $rowcount , "</p>");
                      }
                      // Close the connection
                      mysqli_close($con);
                      ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                
              </div>
            </div>
          </div>
        </div>

<!--##################################################################################################################################################-->
 <div class="row">
          <div class="col-md-12">
            <div class="card collapse" id="sTable">
              <div class="card-header">
                <h5 class="card-title">System Documents</h5>
                <div class="card-body">
                  <?php
                  $user=$_SESSION['username'];
              include ("db_connection.php");
              $selectQuery = "SELECT * FROM document_logs";
              $query_run = mysqli_query($dbcon,$selectQuery);
              ?>
                  <div class="table-responsive">
                  <table id="sysTable" class="table table-striped table-bordered">
                    <thead>
                      <tr class="text-center">
                        <th>ID</th>
                        <th>Component</th>
                        <th>Category</th>
                        <th>Particulars</th>
                        <th>Remarks</th>
                        <th>Date Created</th>
                        <th>Date Completed</th>
                        <th>Number of Days</th>
                      </tr>
                    </thead>
                                  <?php
              if($query_run) {
                foreach ($query_run as $row) {
                  ?>
                      <tr class="text-center">
                        <td><?php echo $row['docu_id']; ?></td>
                        <td><?php echo $row['component']; ?></td>
                        <td><?php echo $row['category']; ?></td>
                        <td><?php echo $row['particulars']; ?></td>
                        <td><?php echo $row['remarks']; ?></td>
                        <td><?php echo $row['date_created']; ?></td>
                        <td><?php echo $row['date_completed']; ?></td>
                        <td><?php echo $row['no_of_days']; ?></td>
                      </tr>
                <?php
                }
              }
              else {
                echo "No Records Found";
              }
              ?>
                  </table>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
<!--##################################################################################################################################################-->
 <div class="row">
          <div class="col-md-12">
            <div class="card collapse" id="uTable">
              <div class="card-header">
                <h5 class="card-title">User's Logs</h5>
                <div class="card-body">
                  <?php
                  $user=$_SESSION['username'];
              include ("db_connection.php");
              $selectQuery = "SELECT * FROM user_logs";
              $query_run = mysqli_query($dbcon,$selectQuery);
              ?>
                  <div class="table-responsive">
                  <table id="usTable" class="table table-striped table-bordered">
                    <thead>
                      <tr class="text-center">
                        <th>ID</th>
                        <th>Component</th>
                        <th>Login Date</th>
                        <th>Login Time</th>
                        <th>Logout Date</th>
                        <th>Logout Time</th>
                        <th>Duration</th>
                      </tr>
                    </thead>
                                  <?php
              if($query_run) {
                foreach ($query_run as $row) {
                  $time1 = $row["login_time"];
                  $time2 = $row["logout_time"];
                  $loginTime = strtotime($time1);
                  $logoutTime = strtotime($time2);
                  $timeDiff = $logoutTime-$loginTime;
                  $hours = ($timeDiff/3600);
                  $minutes = ($timeDiff/60%60);
                  $seconds = ($timeDiff%60);
                  ?>
                      <tr class="text-center">
                        <td><?php echo $row['user_id']; ?></td>
                        <td><?php echo $row['component']; ?></td>
                        <td><?php echo $row['login_date']; ?></td>
                        <td><?php echo $row['login_time']; ?></td>
                        <td><?php echo $row['logout_date']; ?></td>
                        <td><?php echo $row['logout_time']; ?></td>
                        <td><?php echo sprintf("%02d",$hours).":".sprintf("%02d",$minutes).":".sprintf("%02d",$seconds); ?></td>
                      </tr>
                <?php
                }
              }
              else {
                echo "No Records Found";
              }
              ?>
                  </table>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
<!--##################################################################################################################################################-->
 <div class="row">
          <div class="col-md-12">
            <div class="card collapse" id="dTable">
              <div class="card-header">
                <h5 class="card-title">Document Logs</h5>
                <div class="card-body">
                  <?php
                  $user=$_SESSION['username'];
              include ("db_connection.php");
              $selectQuery = "SELECT * FROM docu_query";
              $query_run = mysqli_query($dbcon,$selectQuery);
              ?>
              <div class="table-responsive">
                  <table id="dlTable" class="table table-striped table-bordered">
                    <thead>
                      <tr class="text-center">
                        <th>ID</th>
                        <th>Component</th>
                        <th>Category</th>
                        <th>Particulars</th>
                        <th>Date Received</th>
                        <th>Time Received</th>
                        <th>Date Released</th>
                        <th>Time Released</th>
                        <th>Status</th>
                        <th>Duration</th>
                      </tr>
                    </thead>
                                  <?php
              if($query_run) {
                foreach ($query_run as $row) {
                  $time1 = $row["time_received"];
                  $time2 = $row["time_released"];
                  $date1 = $row["date_received"];
                  $date2 = $row["date_released"];
                  $dt1 = $date1 . " " . $time1;
                  $dt2 = $date2 . " " . $time2;
                  $str = strtotime($dt1);
                  $end = strtotime($dt2);
                  $diff = $end-$str;
                  $hours = ($diff/3600);
                  $minutes = ($diff/60%60);
                  $seconds = ($diff%60);
                  $days = ($hours/24);
                  $hours = ($hours % 24);
                  if($date1=="0000-00-00"){
                    if($time1=="00:00:00"){
                      $days = abs(floor($diff*0));
                      $hours = abs(floor($diff*0));
                      $minutes = abs(floor($diff*0));
                      $seconds = abs(floor($diff*0));
                    }
                    
                  }
                  ?>
                      <tr class="text-center">
                        <td><?php echo $row['docu_id']; ?></td>
                        <td><?php echo $row['from_component']; ?></td>
                        <td><?php echo $row['category']; ?></td>
                        <td><?php echo $row['particulars']; ?></td>
                        <td><?php echo $row['date_received']; ?></td>
                        <td><?php echo $row['time_received']; ?></td>
                        <td><?php echo $row['date_released']; ?></td>
                        <td><?php echo $row['time_released']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td><?php

                        if ($days<0) {
                          echo ceil($days). " days and ";
                        }
                        else {
                          echo floor($days). " days and ";
                        }

                        echo sprintf("%02d",$hours).":".sprintf("%02d",$minutes).":".sprintf("%02d",$seconds);

                      ?></td>
                      </tr>
                <?php
                }
              }
              else {
                echo "No Records Found";
              }
              ?>
                  </table>
                </div>
              </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</body>
</html>

 <script>  
 $(document).ready(function(){  
      $('#sysTable').DataTable();  
 });  
 </script>

  <script>  
 $(document).ready(function(){  
      $('#usTable').DataTable();  
 });  
 </script>

  <script>  
 $(document).ready(function(){  
      $('#dlTable').DataTable();  
 });  
 </script> 
     