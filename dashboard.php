<?php  
session_start();  
  
if(!$_SESSION['username']) {
  header("Location: login.php");//redirect to the login page to secure the welcome page without login access.  
}  
  
?>  
  
<!DOCTYPE html>
<html lang="en">
<head>
  <title>PSOV-DTS Dashboard</title>
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

                    <!--Date Calculator-->
        <script type="text/javascript">
        function GetDays(){
          var dropdt = new Date(document.getElementById("comDC").value);
          var pickdt = new Date(document.getElementById("comDate").value);
          return parseInt((pickdt - dropdt) / (24 * 3600 * 1000));
        }

        function cal(){
        if(document.getElementById("comDC")){
            document.getElementById("daysNo").value=GetDays();
        }
      }
    </script>

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
        <a class="nav-link active" href="#dashboard">DASHBOARD</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="newDocs.php">NEW DOCUMENT</a>
      </li>
      <li class="nav-item">
        <a class="nav-link"  href="./queryDoc.php">DOCUMENT QUERY</a>
      </li>
      <li class="nav-item">
        <a type="text" id="user_name" name="user_name" class="nav-link" data-bs-toggle="dropdown"><?php echo $_SESSION['username']; ?></a>
        <ul class="dropdown-menu">
          <li>
            <form>
            <a class="dropdown-item" href="logout.php" name="LO" id="LO">Logout</a>
            </form>
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
                    <i data-bs-toggle="collapse" data-bs-target="#rTable" class="nc-icon nc-cloud-download-93 text-success"></i>
                  </div>
                </div>
                <div class="col-7 col-md-8">
                  <div class="numbers">
                    <p class="card-category">Receiving Documents</p>
                    <?php
                    $con = mysqli_connect("localhost","root","","dts_dbase");
                    // SQL query to display row count
                    $user=$_SESSION['username'];
                    $sql = "SELECT * FROM pending_docs where for_component = '$user'";
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
                      <i data-bs-toggle="collapse" data-bs-target="#pTable" class="nc-icon nc-refresh-69 text-danger"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Pending Documents</p>
                      <?php
                      $con = mysqli_connect("localhost","root","","dts_dbase");
                      // SQL query to display row count
                      $user=$_SESSION['username'];
                      $sql = "SELECT * FROM received_docs where for_component = '$user'";
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
                      <i data-bs-toggle="collapse" data-bs-target="#rlTable" class="nc-icon nc-send text-primary"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Released Documents</p>
                      <?php
                      $con = mysqli_connect("localhost","root","","dts_dbase");
                      // SQL query to display row count
                      $user=$_SESSION['username'];
                      $sql = "SELECT * FROM release_docs where from_component = '$user'";
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
            <div class="card collapse" id="rTable">
              <div class="card-header">
                <h5 class="card-title">RECEIVING DOCUMENTS</h5>
                <div class="card-body">
                  <?php
                  $user=$_SESSION['username'];
              include ("db_connection.php");
              $selectQuery = "SELECT * FROM pending_docs where for_component='$user'";
              $query_run = mysqli_query($dbcon,$selectQuery);
              ?>
                  <div class="table-responsive">
                  <table id="rcTable" class="table table-striped table-bordered">
                    <thead>
                      <tr class="text-center">
                        <th>ID</th>
                        <th>Date Created</th>
                        <th>Component (Origin)</th>
                        <th>Created by:</th>
                        <th>Document Type</th>
                        <th>Particulars</th>
                        <th>Action Requested</th>
                        <th>Options</th>
                      </tr>
                    </thead>
                                  <?php
              if($query_run) {
                foreach ($query_run as $row) {
                  ?>
                      <tr class="text-center">
                        <td><?php echo $row['docu_id']; ?></td>
                        <td><?php echo $row['date_created']; ?></td>
                        <td><?php echo $row['from_component']; ?></td>
                        <td><?php echo $row['created_by']; ?></td>
                        <td><?php echo $row['category']; ?></td>
                        <td><?php echo $row['particulars']; ?></td>
                        <td><?php echo $row['remarks']; ?></td>
                        <td><div class="btn-group-vertical">
                          <button type="button" class="btn btn-warning btnReceive">Receive</button>
                        </div></td>
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

<!--###################################################################################################################################################-->

<div class="row">
          <div class="col-md-12">
            <div class="card collapse" id="pTable">
              <div class="card-header">
                <h5 class="card-title">PENDING DOCUMENTS</h5>
                <div class="card-body">
                  <?php
                  $user=$_SESSION['username'];
              include ("db_connection.php");
              $selectQuery = "SELECT * FROM received_docs where for_component='$user'";
              $query_run = mysqli_query($dbcon,$selectQuery);
              ?>
                  <div class="table-responsive">
                  <table id="pdTable" class="table table-striped table-bordered">
                    <thead>
                      <tr class="text-center">
                        <th>ID</th>
                        <th>Date Created</th>
                        <th>Component (Origin)</th>
                        <th>Received by:</th>
                        <th>Document Type</th>
                        <th>Particulars</th>
                        <th>Status</th>
                        <th>Options</th>
                      </tr>
                    </thead>
                                  <?php
              if($query_run) {
                foreach ($query_run as $row) {
                  ?>
                      <tr class="text-center">
                        <td><?php echo $row['docu_id']; ?></td>
                        <td><?php echo $row['date_created']; ?></td>
                        <td><?php echo $row['from_component']; ?></td>
                        <td><?php echo $row['received_by']; ?></td>
                        <td><?php echo $row['category']; ?></td>
                        <td><?php echo $row['particulars']; ?></td>
                        <td><?php echo $row['remarks']; ?></td>
                        <td><div class="btn-group-vertical">
                          <button type="button" class="btn btn-info btnUpdate">Update</button>
                        <button type="button" class="btn btn-primary  btnRelease">Release</button>
                          <button onclick="cal()" type="button" class="btn btn-success  btnComplete">Completed</button></div></td>
                      </tr>
                   <?php
                }
              }
              else {
                echo "No Records Found";
              }
              ?>
                  </table>
                  <div>
                </div>
              </div>
            </div>
          </div>
        </div>
        


<!--###################################################################################################################################################-->

<div class="row">
          <div class="col-md-12">
            <div class="card collapse" id="rlTable">
              <div class="card-header">
                <h5 class="card-title">RELEASED DOCUMENTS</h5>
                <div class="card-body">
                  <?php
                  $user=$_SESSION['username'];
              include ("db_connection.php");
              $selectQuery = "SELECT * FROM release_docs where from_component='$user' ORDER BY docu_id ASC";
              $query_run = mysqli_query($dbcon,$selectQuery);
              ?>
                  <div class="table-responsive">
                  <table id="rldTable" class="table table-striped table-bordered">
                    <thead>
                      <tr class="text-center">
                        <th>ID</th>
                        <th>Date Released</th>
                        <th>Time Released</th>
                        <th>Component (Origin)</th>
                        <th>Component (Destination)</th>
                        <th>Released by:</th>
                        <th>Document Type</th>
                        <th>Particulars</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                                  <?php
              if($query_run) {
                foreach ($query_run as $row) {
                  ?>
                      <tr class="text-center">
                        <td><?php echo $row['docu_id']; ?></td>
                        <td><?php echo $row['date_release']; ?></td>
                        <td><?php echo $row['time_release']; ?></td>
                        <td><?php echo $row['from_component']; ?></td>
                        <td><?php echo $row['for_component']; ?></td>
                        <td><?php echo $row['released_by']; ?></td>
                        <td><?php echo $row['category']; ?></td>
                        <td><?php echo $row['particulars']; ?></td>
                        <td><?php echo $row['remarks']; ?></td>
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

<!--########################################################################################################################-->

    <!-- Modal Receive -->
    <div class="modal" id="ReceiveModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h5 class="modal-title">Receiving Documents</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form role="receiveForm" method="POST" action="dashboard.php" class="was-validated">
              <input type="hidden" name="rcDC" id="rcDC">
              <div class="row">
                <div class="col-md-4 pr-1">
                  <div class="form-group">
                    <label for="id"><strong>Document ID:</strong></label>
                    <input required type="text" id="rcDocID" name="rcDocID" readonly class="form-control is-valid">
                  </div>
                </div>

                <div class="col-md-4 px-1">
                  <div class="form-group">
                    <label for="date"><strong>Date:</strong></label>
                    <input required type="text" id="rdate" name="rdate" readonly class="form-control is-valid" >
                  </div>
                </div>
                <div class="col-md-4 pl-1">
                  <div class="form-group">
                    <label for="date"><strong>Time:</strong></label>
                    <input required type="text" id="rhour" name="rhour" readonly class="form-control is-valid" >
                  </div>
                </div>
              </div>
              <script>
                var date1 = new Date();
                document.getElementById("rdate").value = date1.getFullYear() + "-" + (date1.getMonth()<10?'0':'') + (date1.getMonth() + 1) + "-" + (date1.getDate()<10?'0':'') + date1.getDate();
                document.getElementById("rhour").value = (date1.getHours()<10?'0':'') + date1.getHours()  + ":" + (date1.getMinutes()<10?'0':'') + date1.getMinutes()+ ":" + (date1.getSeconds()<10?'0':'') + date1.getSeconds();
              </script> 
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label><strong>Component/Unit (Origin):</strong></label>
                    <input required readonly class="form-control is-valid" id="rcCompo" name="rcCompo">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <label for="docType"><strong>Document Type/Category:</strong></label>
                  <input required class="form-control is-valid" id="rcDocuT" name="rcDocuT" type="text">
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label><strong>Particulars:</strong></label>
                      <input required id="rcPart" name="rcPart"  readonly class="form-control is-valid textarea">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label><strong>Remarks/Action On Process:</strong></label>
                      <textarea required id="rcRem" name="rcRem" class="form-control is-valid textarea" placeholder="Enter Document Status.."></textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group">
                    <label for="fname"><strong>Received by:</strong></label>
                    <input required class="form-control is-valid" type="text" id="rcReceiver" name="rcReceiver" placeholder="Enter User Name..">
                  </div>
                </div>
              
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary"name="receiveDocs" id="receiveDocs">Submit</button>
            </div>
          </div>
        </div>
      </div>
      </form>

<!--########################################################################################################################-->

    <!-- Modal Complete -->
    <div class="modal" id="CompleteModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Completed Documents</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form role="form" method="POST" action="dashboard.php" class="was-validated">
              <div class="row">
                <div class="col-md-3 pr-1">
                  <div class="form-group">
                    <label for="date"><strong>Document ID:</strong></label>
                    <input required type="text" id="comDocID" name="comdocuID_no" readonly class="form-control is-valid">
                  </div>
                </div>
                <div class="col-md-3 px-1">
                  <div class="form-group">
                    <label for="date"><strong>Date Created:</strong></label>
                    <input required id="comDC" name="comDC" class="form-control is-valid" readonly>
                  </div>
                </div>
                <div class="col-md-3 pl-1">
                  <div class="form-group">
                    <label for="date"><strong>Date Completed:</strong></label>
                    <input required readonly id="comDate" name="comDate" class="form-control is-valid">
                  </div>
                </div>
                <div class="col-md-3 pl-1">
                  <div class="form-group">
                    <label for="date"><strong>Time Completed:</strong></label>
                    <input required type="text" readonly id="comHour" name="comHour" class="form-control is-valid">
                  </div>
                </div>
              </div>
              <script>
                var date2 = new Date();
                document.getElementById("comDate").value = date2.getFullYear() + "-" + (date2.getMonth()<10?'0':'') + (date2.getMonth() + 1) + "-" + (date2.getDate()<10?'0':'') + date2.getDate();
                document.getElementById("comHour").value = (date2.getHours()<10?'0':'') + date2.getHours()  + ":" + (date2.getMinutes()<10?'0':'') + date2.getMinutes()+ ":" + (date2.getSeconds()<10?'0':'') + date2.getSeconds();
              </script> 
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label><strong>Document Type/Categrory:</strong></label>
                    <input required type="text" readonly class="form-control is-valid" name="comCat" id="comDocuT">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label><strong>Particulars:</strong></label>
                    <input required type="text" readonly class="form-control is-valid" name="comPart" id="comPart">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label for="docType"><strong>Status:</strong></label>
                  <input required type="text" class="form-control is-valid" name="comStatus" id="comStatus">
                </div>
                <div class="col-md-6">
                  <label for="docType"><strong>No of Days:</strong></label>
                  <input required type="text" readonly class="form-control is-valid" id="daysNo" name="daysNo">
                </div>
              </div>

          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="submit"class="btn btn-primary" name="completeDocs" id="completeDocs">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
  </div>


<!--########################################################################################################################-->

<!-- Modal Update -->
    <div class="modal" id="UpdateModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h5 class="modal-title">Updating Documents</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form role="receiveForm" method="POST" action="dashboard.php" class="was-validated">
              <input type="hidden" name="upDC" id="upDC">
              <div class="row">
                <div class="col-md-4 pr-1">
                  <div class="form-group">
                    <label for="id"><strong>Document ID:</strong></label>
                    <input required type="text" id="upDocID" name="upDocID" readonly class="form-control is-valid">
                  </div>
                </div>

                <div class="col-md-4 px-1">
                  <div class="form-group">
                    <label for="date"><strong>Date:</strong></label>
                    <input required type="text" id="update" name="update" readonly class="form-control is-valid" >
                  </div>
                </div>
                <div class="col-md-4 pl-1">
                  <div class="form-group">
                    <label for="date"><strong>Time:</strong></label>
                    <input required type="text" id="uphour" name="uphour" readonly class="form-control is-valid" >
                  </div>
                </div>
              </div>
              <script>
                var date3 = new Date();
                document.getElementById("update").value = date3.getFullYear() + "-" + (date3.getMonth()<10?'0':'') + (date3.getMonth() + 1) + "-" + (date3.getDate()<10?'0':'') + date3.getDate();
                document.getElementById("uphour").value = (date3.getHours()<10?'0':'') + date3.getHours()  + ":" + (date3.getMinutes()<10?'0':'') + date3.getMinutes()+ ":" + (date3.getSeconds()<10?'0':'') + date3.getSeconds();
              </script> 
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label><strong>Component/Unit (Origin):</strong></label>
                    <input required readonly class="form-control is-valid" id="upCompo" name="upCompo">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <label for="docType"><strong>Document Type/Category:</strong></label>
                  <input required type="text" class="form-control is-valid" id="upDocuT" name="upDocuT">
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label><strong>Particulars:</strong></label>
                      <input required id="upPart" name="upPart"  readonly class="form-control is-valid textarea">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label><strong>Remarks/Action On Process:</strong></label>
                      <textarea required id="upRem" name="upRem" class="form-control is-valid textarea" placeholder="Enter Document Status.."></textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group">
                    <label for="fname"><strong>Received by:</strong></label>
                    <input required class="form-control is-valid" readonly type="text" id="upReceiver" name="upReceiver" placeholder="Enter User Name..">
                  </div>
                </div>
              
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary"name="updateDocs" id="updateDocs">Submit</button>
            </div>
          </div>
        </div>
      </div>
      </form>

<!--########################################################################################################################-->

   <!-- Modal Release -->
    <div class="modal" id="ReleaseModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h5 class="modal-title">Releasing Documents</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form role="receiveForm" method="POST" action="dashboard.php" class="was-validated">
              <input type="hidden" name="rlDC" id="rlDC">
              <div class="row">
                <div class="col-md-4 pr-1">
                  <div class="form-group">
                    <label for="id"><strong>Document ID:</strong></label>
                    <input required type="text" id="rlDocID" name="rlDocID" readonly class="form-control is-valid">
                  </div>
                </div>

                <div class="col-md-4 px-1">
                  <div class="form-group">
                    <label for="date"><strong>Date:</strong></label>
                    <input required type="text" id="rldate" name="rldate" readonly class="form-control is-valid" >
                  </div>
                </div>
                <div class="col-md-4 pl-1">
                  <div class="form-group">
                    <label for="date"><strong>Time:</strong></label>
                    <input required type="text" id="rlhour" name="rlhour" readonly class="form-control is-valid" >
                  </div>
                </div>
              </div>
              <script>
                var date4 = new Date();
                document.getElementById("rldate").value = date4.getFullYear() + "-" + (date4.getMonth()<10?'0':'') + (date4.getMonth() + 1) + "-" + (date4.getDate()<10?'0':'') + date4.getDate();
                document.getElementById("rlhour").value = (date4.getHours()<10?'0':'') + date4.getHours()  + ":" + (date4.getMinutes()<10?'0':'') + date4.getMinutes()+ ":" + (date4.getSeconds()<10?'0':'') + date4.getSeconds();
              </script> 
              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label><strong>Component/Unit (Origin):</strong></label>
                    <input required readonly class="form-control is-valid" id="userCompo" name="userCompo" value="<?php echo $_SESSION['username']?>">
                  </div>
                </div>
                 <div class="col-md-6 pl-1">
                    <div class="form-group">
                      <label><strong>Component/Unit(Destination):</strong></label>
                      <input required type="text" id="rlCompo2" name="rlCompo2" list="getCompo" class="form-control is-valid" placeholder="Enter Station Unit">
                      <datalist id="getCompo" name="getCompo">
                        <option value="OPD">OPD</option>
                        <option value="ODPD">ODPD</option>
                        <option value="IBUILD">IBUILD</option>
                        <option value="IREAP">IREAP</option>
                        <option value="IPLAN">IPLAN</option>
                        <option value="ADMIN">ADMIN</option>
                        <option value="BUDGET">BUDGET</option>
                        <option value="LGU-FINANCE">LGU-FINANCE</option>
                        <option value="ACCOUNTING">ACCOUNTING</option>
                        <option value="CASHIER">CASHIER</option>
                        <option value="PROCUREMENT">PROCUREMENT</option>
                        <option value="SES">SES</option>
                        <option value="GGU">GGU</option>
                        <option value="GEF">GEF</option>
                        <option value="M&E">M&E</option>
                        <option value="ECON">ECON</option>
                        <option value="I-ACE">INFO-ACE</option>
                      </datalist>
                    </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <label for="docType"><strong>Document Type/Category:</strong></label>
                  <input required type="text" class="form-control is-valid" id="rlDocuT" name="rlDocuT">
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label><strong>Particulars:</strong></label>
                      <input required id="rlPart" name="rlPart"  readonly class="form-control is-valid textarea">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label><strong>Remarks/Action On Process:</strong></label>
                      <textarea required id="rlRem" name="rlRem" class="form-control is-valid textarea" placeholder="Enter Document Status.."></textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group">
                    <label for="fname"><strong>Released by:</strong></label>
                    <input required class="form-control is-valid" readonly type="text" id="rlReleaser" name="rlReleaser" placeholder="Enter User Name..">
                  </div>
                </div>
              
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary"name="releaseDocs" id="releaseDocs">Submit</button>
            </div>
          </div>
        </div>
      </div>
      </form>

   

<!--########################################################################################################################-->



<!--########################################################################################################################-->

<!--Receiving Docs Script for Display to Modal-->
<script>
$(document).ready(function(){
  $(".btnReceive").click(function(){
    $("#ReceiveModal").modal("show");
    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function(){
      return $(this).text();
    }).get();
    console.log(data);
    $('#rcDocID').val(data[0]);
    $('#rcDC').val(data[1]);
    $('#rcCompo').val(data[2]);
    $('#rcCreator').val(data[3]);
    $('#rcDocuT').val(data[4]);
    $('#rcPart').val(data[5]);
    $('#rcStatus').val(data[6]);
  });
});
</script>

<!--Completed Docs Script for Display to Modal-->
<script>
$(document).ready(function(){
  $(".btnComplete").click(function(){
    $("#CompleteModal").modal("show");
    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function(){
      return $(this).text();
    }).get();
    console.log(data);
    $('#comDocID').val(data[0]);
    $('#comDC').val(data[1]);
    $('#comCompo').val(data[2]);
    $('#comCreator').val(data[3]);
    $('#comDocuT').val(data[4]);
    $('#comPart').val(data[5]);
    $('#comStatus').val(data[6]);
  });
});
</script>

<!--Updating Docs Script for Display to Modal-->
<script>
$(document).ready(function(){
  $(".btnUpdate").click(function(){
    $("#UpdateModal").modal("show");
    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function(){
      return $(this).text();
    }).get();
    console.log(data);
    $('#upDocID').val(data[0]);
    $('#upDC').val(data[1]);
    $('#upCompo').val(data[2]);
    $('#upReceiver').val(data[3]);
    $('#upDocuT').val(data[4]);
    $('#upPart').val(data[5]);
    $('#upStatus').val(data[6]);
  });
});
</script>

</script>

<!--Releasing Docs Script for Display to Modal-->
<script>
$(document).ready(function(){
  $(".btnRelease").click(function(){
    $("#ReleaseModal").modal("show");
    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function(){
      return $(this).text();
    }).get();
    console.log(data);
    $('#rlDocID').val(data[0]);
    $('#rlDC').val(data[1]);
    $('#rlCompo').val(data[2]);
    $('#rlReleaser').val(data[3]);
    $('#rlDocuT').val(data[4]);
    $('#rlPart').val(data[5]);
    $('#rlRem').val(data[6]);
  });
});
</script>


</body>
</html>

<!--################################################################################################################################################-->

<!--PHP Corner-->

<?php    
include("db_connection.php");//make connection here  
if(isset($_POST['receiveDocs'])) {
  $rcDC1=$_POST['rcDC'];
  $rcID=$_POST['rcDocID'];
  $rcCompo=$_POST['rcCompo'];
  $destination_component=$_SESSION['username'];
  $documentType=$_POST['rcDocuT'];//same
  $specifics_docu=$_POST['rcPart'];  
  $on_process=$_POST['rcRem']; 
  $receivedBy=$_POST['rcReceiver'];
  $dateReceive=$_POST['rdate']; 
  $timeReceive=$_POST['rhour'];
  $user=$_SESSION['username']; 
 
  //insert the user into the database.
  $receiveQuery="UPDATE document_logs SET remarks = '$on_process' where docu_id = '$rcID';

  INSERT INTO dummyquery (docu_id, from_component, personnel, category, particulars, date_received, time_received, date_released, time_released, status, for_component) VALUE ('$rcID', '$destination_component','$receivedBy','$documentType','$specifics_docu','$dateReceive','$timeReceive','?','?','$on_process', '$destination_component');

  INSERT INTO docu_query (docu_id, from_component, personnel, category, particulars, date_received, time_received, date_released, time_released, status, for_component) VALUE ('$rcID', '$destination_component','$receivedBy','$documentType','$specifics_docu','$dateReceive','$timeReceive','?','?','$on_process', '$destination_component');


  INSERT INTO received_docs (docu_id, date_created, from_component, for_component, received_by, date_received, time_received, category, particulars, remarks) VALUE ('$rcID','$rcDC1','$rcCompo','$destination_component','$receivedBy','$dateReceive','$timeReceive','$documentType','$specifics_docu','$on_process');

  DELETE from pending_docs where docu_id='$rcID'";

  if(mysqli_multi_query($dbcon,$receiveQuery))  {  
    echo"<script>window.open('dashboard.php','_self')</script>";  
  }
} 
?>
<!--########################################################################################################################-->

<?php  
  
include("db_connection.php");//make connection here  
if(isset($_POST['completeDocs'])) {
  $comdidNo=$_POST['comdocuID_no'];
  $comDateCreated=$_POST['comDC']; 
  $comDateCompleted=$_POST['comDate'];
  $user=$_SESSION['username'];
  $comCategory = $_POST['comCat'];
  $comParticulars=$_POST['comPart'];
  $comRemarks=$_POST['comStatus'];
  $duration=$_POST['daysNo'];
  $timeCompleted=$_POST['comHour'];
 
  //insert the user into the database.

  $comQuery="UPDATE document_logs SET remarks = '$comRemarks', date_completed = '$comDateCompleted', no_of_days='$duration' where docu_id = '$comdidNo';

  INSERT INTO completed_docs (docu_id, component, category, particulars, remarks, date_created, date_completed, no_of_days) VALUE ('$comdidNo','$user', '$comCategory','$comParticulars','$comRemarks','$comDateCreated','$comDateCompleted','$duration');

  UPDATE dummyquery SET date_released = '$comDateCompleted', time_released = '$timeCompleted', status='$comRemarks' where docu_id = '$comdidNo';

  DELETE from docu_query where docu_id='$comdidNo' and date_released='0000-00-00' and time_released='00:00:00';

  INSERT INTO docu_query (docu_id, from_component, personnel, category, particulars, date_received, time_received, date_released, time_released, status, for_component) SELECT * from dummyquery where docu_id='$comdidNo';

  DELETE from received_docs where docu_id='$comdidNo' and for_component='$user';

  DELETE from dummyquery where docu_id='$comdidNo' and for_component='$user'";

  if(mysqli_multi_query($dbcon,$comQuery))  {  
    echo"<script>window.open('dashboard.php','_self')</script>";  
  }
} 
?>

<!--########################################################################################################################-->

<?php  
  
include("db_connection.php");//make connection here  
if(isset($_POST['updateDocs'])) {
  $ipID = $_POST['upDocID'];
  $upCategory=$_POST['upDocuT'];
  $upDate = $_POST['update'];
  $upTime = $_POST['uphour'];
  $upStatus = $_POST['upRem'];
  $upCompo = $_SESSION['username'];
 
  //insert the user into the database.

  $upQuery="UPDATE document_logs SET category='$upCategory', remarks = '$upStatus' where docu_id = '$ipID';

  UPDATE dummyquery SET category='$upCategory', date_received = '$upDate', time_received = '$upTime', status='$upStatus'  where docu_id = '$ipID' and from_component='$upCompo';

  UPDATE docu_query SET category='$upCategory', date_received = '$upDate', time_received = '$upTime', status='$upStatus'  where docu_id = '$ipID' and from_component='$upCompo';


  UPDATE received_docs SET category='$upCategory', date_received = '$upDate', time_received = '$upTime', remarks='$upStatus' where docu_id = '$ipID' and for_component ='$upCompo'";

  if(mysqli_multi_query($dbcon,$upQuery))  {  
    echo"<script>window.open('dashboard.php','_self')</script>";  
  }
}

?>
<!--########################################################################################################################-->

<?php  
  
include("db_connection.php");//make connection here  
if(isset($_POST['releaseDocs'])) {
  $rlID=$_POST['rlDocID'];
  $rlDC=$_POST['rlDC']; 
  $rlDate=$_POST['rldate']; 
  $rlTime=$_POST['rlhour']; 
  $rlCompo1=$_SESSION['username'];
  $rlCompo2=$_POST['rlCompo2'];
  $rlCategory = $_POST['rlDocuT'];
  $rlPart=$_POST['rlPart'];
  $rlStatus=$_POST['rlRem'];
  $rlReleaser=$_POST['rlReleaser'];
 
  //insert the user into the database.

  $releaseQuery="UPDATE document_logs SET remarks = '$rlStatus', stationUnit='$rlCompo2' where docu_id = '$rlID';

  UPDATE dummyquery SET date_released = '$rlDate', time_released = '$rlTime', status='$rlStatus', for_component='$rlCompo2' where docu_id = '$rlID';

  DELETE from docu_query where docu_id='$rlID' and date_released='0000-00-00' and time_released='00:00:00';

  INSERT INTO pending_docs (docu_id, date_created, from_component, created_by, for_component, date_release, time_release, category, particulars, remarks) VALUE ('$rlID','$rlDC', '$rlCompo1','$rlReleaser','$rlCompo2','$rlDate','$rlTime','$rlCategory','$rlPart', '$rlStatus');

  INSERT INTO release_docs (docu_id, from_component, released_by, for_component, date_release, time_release, category, particulars, remarks) VALUE ('$rlID', '$rlCompo1','$rlReleaser','$rlCompo2','$rlDate','$rlTime','$rlCategory','$rlPart', '$rlStatus');

  DELETE from received_docs where docu_id='$rlID';

  INSERT INTO docu_query (docu_id, from_component, personnel, category, particulars, date_received, time_received, date_released, time_released, status, for_component) SELECT * from dummyquery where docu_id='$rlID';

  DELETE from dummyquery";

  if(mysqli_multi_query($dbcon,$releaseQuery))  {  
    echo"<script>window.open('dashboard.php','_self')</script>";  
  }
} 
?>
<!--########################################################################################################################-->

 <script>  
 $(document).ready(function(){  
      $('#rldTable').DataTable();  
 });  
 </script>

  <script>  
 $(document).ready(function(){  
      $('#rcTable').DataTable();  
 });  
 </script>

  <script>  
 $(document).ready(function(){  
      $('#pdTable').DataTable();  
 });  
 </script>

 <!--########################################################################################################################-->
 <?php
 include("db_connection.php");//make connection here  
if(isset($_POST['LO'])) {

}
?>