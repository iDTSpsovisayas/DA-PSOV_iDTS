<?php  
session_start();  
  
if(!$_SESSION['username']) {  
  header("Location: login.php");//redirect to the login page to secure the welcome page without login access.  
}

$user=$_SESSION['username'];
$conn = mysqli_connect("localhost", "root", "", "dts_dbase");
if ($conn->connect_error) {
  die("Connection failed:" . $conn->connect_error);
}

$sql="SELECT * from document_logs WHERE docu_id=(SELECT MAX(docu_id) from document_logs)";
$result = $conn->query($sql);
if($result->num_rows==0){
  $docuID="PSOV-". DATE("y")."-"."0001";
}
elseif ($result->num_rows>=0) {
  while($rowval = mysqli_fetch_array($result)) {

    $eID=substr($rowval['docu_id'],9,4)+1;
    $str_length=4;
    $str = substr("0000{$eID}", -$str_length);
    $docuID="PSOV-". DATE("y")."-".$str;
    $user=$_SESSION['username'];
  }
} else {
  mysqli_close($con);
}
?>  
  
<!DOCTYPE html>
<html lang="en">
<head>
  <title>PSOV-DTS New Document</title>
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
        function startTime()
        {
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
        function checkTime(i)
        {
        if (i<10)
        {
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
      <div class="col-sm-9"><img class="img-fluid" src="./resources/images/Web-Banner.png" alt="prdp-logo" height="300" width="600">
      </div>
      <div class="col-sm-3"><h4 name="date_time" id="txt"></h4></div>
    </div>
  </div>

  <!--NavBar Section-->
  <div class="container p-2 border">
    <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item">
        <a class="nav-link" href="dashboard.php">DASHBOARD</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="#newDocs">NEW DOCUMENT</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="queryDoc.PHP">DOCUMENT QUERY</a>
      </li>
      <li class="nav-item">
        <a type="text" id="user_name" name="user_name" class="nav-link" data-bs-toggle="dropdown"><?php echo $_SESSION['username']; ?></a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="logout.php" name="LO" id="LO">Logout</a>
          </li>
        </ul>
      </li> 
    </ul>

    <!-- Tab panes-->
    <div id="newDocs" class="container tab-pane active">

      <!--New Document-->
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title">Input Parameters</h5>
            </div>
            <div class="card-body">
              <form role="form" method="POST" action="newDocs.php" class="was-validated">
                <div class="row">
                  <div class="col-md-4 pr-1">
                    <div class="form-group">
                      <label for="date"><strong>Document ID:</strong></label>
                      <input required readonly value="<?php echo $docuID; ?>" type="text" id="ndID" name="ndID" class="form-control is-valid is-valid">
                    </div>
                  </div>
                  <div class="col-md-4 px-1">
                    <div class="form-group">
                      <label for="date"><strong>Date:</strong></label>
                      <input required type="text" id="nddate" name="nddate" class="form-control is-valid" readonly>
                    </div>
                  </div>
                  <div class="col-md-4 pl-1">
                    <div class="form-group">
                      <label for="date"><strong>Time:</strong></label>
                      <input required type="text" id="ndhour" name="ndhour" class="form-control is-valid" readonly>
                    </div>
                  </div>
                </div>
                <script>
                  var date = new Date();
                  document.getElementById("nddate").value = date.getFullYear() + "-" + (date.getMonth()<10?'0':'') + (date.getMonth() + 1) + "-" + (date.getDate()<10?'0':'') + date.getDate();
                  document.getElementById("ndhour").value = (date.getHours()<10?'0':'') + date.getHours()  + ":" + (date.getMinutes()<10?'0':'') + date.getMinutes()+ ":" + (date.getSeconds()<10?'0':'') + date.getSeconds();
                </script> 
                <div class="row">
                  <div class="col-md-6 pr-1">
                    <div class="form-group">
                      <label><strong>Component/Unit(Origin):</strong></label>
                      <input required type="text" readonly value="<?php echo $user; ?>" id="ndCompoFrom" name="ndCompoFrom" class="form-control is-valid">
                    </div>
                  </div>
                  <div class="col-md-6 pl-1">
                    <div class="form-group">
                      <label><strong>Component/Unit(Destination):</strong></label>
                      <input required type="text" name="ndCompoTo" list="ndComponentTo" class="form-control is-valid" placeholder="Enter Component/Unit">
                      <datalist id="ndComponentTo" name="ndComponentTo">
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
                    <input required type="text" name="ndCat" list="ndCategory" class="form-control is-valid" placeholder="Enter Document Type/Category">
                  <datalist id="ndCategory" name="ndCat">
                    <option value="Memorandum">Memorandum</option>
                    <option value="Memorandum Order">Memorandum Order</option>
                    <option value="IBUILD Documents">IBUILD Documents</option>
                    <option value="IREAP DOcuments">IREAP Documents</option>
                    <option value="IPLAN Documents">IPLAN Documents</option>
                    <option value="Travel Order">Travel Order</option>
                    <option value="Purchase Order">Purchase Order</option>
                    <option value="Purchase Request">Purchase Request</option>
                    <option value="Financial Documents">Financial Documents</option>
                    <option value="Letter/Communication">Letter/Communication</option>
                    <option value="Procurement Documents">Procurement Documents</option>
                    <option value="No Objection Letter 1">No Objection Letter 1(NOL1)</option>
                    <option value="No Objection Letter 2">No Objection Letter 2(NOL2)</option>
                    <option value="Clearance Routing">Clearance Routing</option>
                    <option value="Admin Documents">Admin Documents</option>
                    <option value="Legal Documents">Legal Documents</option>
                    <option value="Activity Design with PR">Activity Design with PR</option>
                  </datalist>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label><strong>Particulars:</strong></label>
                    <textarea required id="ndPart" name="ndPart" class="form-control is-valid textarea" placeholder="Enter Document Data"></textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label><strong>Remarks/Action Requested:</strong></label>
                    <textarea required id="ndRem" name="ndRem" class="form-control is-valid textarea" placeholder="Enter Action Request"></textarea>
                </div>
              </div>
            </div>
              <div class="row">
                <div class="form-group">    
                  <label for="fname"><strong>Created by:</strong></label>
                  <input required class="form-control is-valid" type="text" id="ndCreator" name="ndCreator" placeholder="Enter User Name">
                </div>
              </div>
              <div class="row">
                 <div class="update ml-auto mr-auto">
                <button class="btn btn-primary btn-round" type="submit" value="Submit" id="new_docs" name="new_docs" value="submit">Submit</button>
              </div>
              </div>
            </form>
          </div> 
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>    

<!--PHP Corner-->
<?php  
  
include("db_connection.php");//make connection here  
if(isset($_POST['new_docs'])) {
  $ndID=$_POST['ndID'];
  $ndDate=$_POST['nddate']; 
  $ndTime=$_POST['ndhour'];
  $ndCompo1=$_POST['ndCompoFrom'];
  $ndCompo2=$_POST['ndCompoTo'];
  $ndCat=$_POST['ndCat'];
  $ndPart=$_POST['ndPart'];
  $ndRem=$_POST['ndRem']; 
  $ndCreator=$_POST['ndCreator'];

  //insert the user into the database.  
  $new_entry="INSERT INTO document_logs (docu_id, component, category, particulars, remarks, date_created, date_completed, no_of_days, stationUnit) VALUE ('$ndID', '$ndCompo1','$ndCat','$ndPart', '$ndRem', '$ndDate','?','?', '$ndCompo2');

  INSERT INTO docu_query (docu_id, from_component, personnel, category, particulars, date_received, time_received, date_released, time_released, status, for_component) VALUE ('$ndID', '$ndCompo1', '$ndCreator', '$ndCat', '$ndPart', '?', '?', '$ndDate', '$ndTime', '$ndRem', '$ndCompo2');

  INSERT INTO pending_docs (docu_id, date_created, from_component, created_by, for_component, date_release, time_release, category, particulars, remarks) VALUE ('$ndID','$ndDate', '$ndCompo1', '$ndCreator', '$ndCompo2', '$ndDate', '$ndTime', '$ndCat', '$ndPart', '$ndRem');


  INSERT INTO release_docs (docu_id, from_component, released_by, for_component, date_release, time_release, category, particulars, remarks) VALUE ('$ndID', '$ndCompo1', '$ndCreator', '$ndCompo2', '$ndDate','$ndTime', '$ndCat','$ndPart','$ndRem')";

  if(mysqli_multi_query($dbcon,$new_entry))  {  
    echo"<script>window.open('dashboard.php','_self')</script>";  
  }
} 
?>