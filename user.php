<?php
session_start();  
  
if(!$_SESSION['username'])  
{  
  
    header("Location: login.php");//redirect to the login page to secure the welcome page without login access.  
}
 $connect = mysqli_connect("localhost", "root", "", "dts_dbase");  
 $query ="SELECT * FROM users ORDER BY user_id DESC";  
 $result = mysqli_query($connect, $query);  
 ?>  
 <!DOCTYPE html>  
 <html>  
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
        <a class="nav-link" href="mgt_dashboard.php">DASHBOARD</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="user.php">USERS</a>
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
              <h5 class="card-title">End User Profile</h5>
            </div>
            <a href="print_pdf.php" class="btn btn-success pull-right"><span class="glyphicon glyphicon-print"></span> PDF</a>
            <div class="card-body">
                <div class="table">  
                     <table id="searchTable" class="table table-striped table-bordered text-center	">  
                          <thead>  
                               <tr>  
                                    <td>ID</td>  
                                    <td>Component</td>
                                    <td>Username</td>
                                    <td>Password</td>
                                    <td>Action</td>
                               </tr>  
                          </thead>  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  ?>
                                
                               <tr>  
                                    <td><?php echo $row["user_id"]; ?></td>  
                                    <td><?php echo $row["component"]; ?></td>
                                    <td><?php echo $row["compoUsername"]; ?></td>
                                    <td><?php echo $row["password"]; ?></td>  
                                    <td><div class="btn-group-vertical">
                          <button type="button" class="btn btn-primary btnEdit"><span class='glyphicon glyphicon-edit'></span> Edit</button>
                        <button type="button" class="btn btn-danger  btnDelete"><span class='glyphicon glyphicon-trash'> Delete</button></div> </td>
                               </tr>  
                               <?php 
                          }  
                          ?>  
                     </table>  
                </div>  
           </div>  



<!--##########################################################################################################################-->

<!-- Modal Edit -->
    <div class="modal" id="EditModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Edit User Profile</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form role="form" method="POST" action="user.php">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="date"><strong>User ID:</strong></label>
                    <input type="text" id="uID" name="uID" readonly class="form-control">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="date"><strong>Component/Unit:</strong></label>
                    <input id="uCompo" name="uCompo" class="form-control">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label><strong>Username:</strong></label>
                    <input type="text" class="form-control" name="uUsername" id="uUsername">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label><strong>Password:</strong></label>
                    <input type="text" class="form-control" name="uPassword" id="uPassword">
                  </div>
                </div>
              </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="btnSave" id="btnSave">Save</button>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
  </div>


  <!--##########################################################################################################################-->

<!-- Modal Delete -->
    <div class="modal" id="DeleteModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Delete User</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form role="form" method="POST" action="user.php">
              <p class="text-center">Are you sure to delete this User?
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="date"><strong>User ID:</strong></label>
                    <input type="text" id="delID" name="delID" disabled class="form-control">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="date"><strong>Component/Unit:</strong></label>
                    <input id="delCompo" name="delCompo" disabled class="form-control">
                  </div>
                </div>
              </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-danger" name="btnDelete" id="btnDelete">Delete</button>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
  </div>



<!--##########################################################################################################################-->
<!-- Display to Modal-->
<script>
$(document).ready(function(){
  $(".btnEdit").click(function(){
    $("#EditModal").modal("show");
    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function(){
      return $(this).text();
    }).get();
    console.log(data);
    $('#uID').val(data[0]);
    $('#uCompo').val(data[1]);
    $('#uUsername').val(data[2]);
    $('#uPassword').val(data[3]);
  });
});
</script>

<script>
$(document).ready(function(){
  $(".btnDelete").click(function(){
    $("#DeleteModal").modal("show");
    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function(){
      return $(this).text();
    }).get();
    console.log(data);
    $('#delID').val(data[0]);
    $('#delCompo').val(data[1]);
    $('#delUsername').val(data[2]);
    $('#delPassword').val(data[3]);
  });
});
</script>


</body>  
</html> 

 <script>  
 $(document).ready(function(){  
      $('#searchTable').DataTable();  
 });  
 </script>

 <?php  
  
include("db_connection.php");//make connection here  
if(isset($_POST['btnSave'])) {
  $userID = $_POST['uID'];
  $userCompo = $_POST['uCompo'];
  $uUser = $_POST['uUsername'];
  $uPass = $_POST['uPassword'];

  //insert the user into the database.  
  $editUser="UPDATE users SET component = '$userCompo', compoUsername = '$uUser', password = '$uPass' where user_id = '$userID'";

  if(mysqli_multi_query($dbcon,$editUser))  {  
    echo"<script>window.open('user.php','_self')</script>";  
  }
}

if(isset($_POST['btnDelete'])) {
  $delUserID = $_POST['delID'];

  //insert the user into the database.  
  $delUser="DELETE from users where user_id = '$delUserID'";

  if(mysqli_multi_query($dbcon,$delUser))  {  
    echo"<script>window.open('user.php','_self')</script>";  
  }
}
?>

