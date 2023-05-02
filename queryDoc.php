<?php
session_start();  
  
if(!$_SESSION['username'])  
{  
  
    header("Location: login.php");//redirect to the login page to secure the welcome page without login access.  
}
 $connect = mysqli_connect("localhost", "root", "", "dts_dbase");  
 $query ="SELECT * FROM document_logs ORDER BY docu_id DESC";  
 $result = mysqli_query($connect, $query);  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
        <title>PSOV-DTS Document Query</title>  
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

@media print {
    .modal {
        position: absolute;
        left: 0;
        top: 0;
        margin: 0;
        padding: 0;
        overflow: visible!important;
    }
}

@media print {
    /* on modal open bootstrap adds class "modal-open" to body, so you can handle that case and hide body */
    body.modal-open {
        visibility: hidden;
    }

    body.modal-open .modal .modal-header,
    body.modal-open .modal .modal-body {
        visibility: visible; /* make visible modal body and header */
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
        <a class="nav-link" href="dashboard.php">DASHBOARD</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="newDocs.php">NEW DOCUMENT</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="#queryDoc">DOCUMENT QUERY</a>
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
              <h5 class="card-title">Search Documents</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">  
                     <table id="searchTable" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>  
                                    <td>ID</td>  
                                    <td>Component</td>  
                                    <td>Category</td>  
                                    <td>Particulars</td>  
                                    <td>Status</td>
                                    <td>Station Unit</td>
                                    <td>Summary</td>  
                               </tr>  
                          </thead>  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  ?>
                                
                               <tr>  
                                    <td><?php echo $row["docu_id"]; ?></td>  
                                    <td><?php echo $row["component"]; ?></td>  
                                    <td><?php echo $row["category"]; ?></td>  
                                    <td><?php echo $row["particulars"]; ?></td>  
                                    <td><?php echo $row["remarks"]; ?></td>
                                    <td><?php echo $row["stationUnit"]; ?></td>
                                    <td><input type="button" name="view" value="view" id="<?php echo $row["docu_id"]; ?>" class="btn btn-info btn-xs view_data" /></td>  
                               </tr>  
                               <?php 
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
 



<!--##########################################################################################################################-->

<!-- Modal Complete -->
<div id="printThis">
    <div class="modal" id="VSModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">View Detailed Summary</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form role="form" method="POST" action="dashboard.php">
              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label for="date"><strong>Document ID:</strong></label>
                    <input type="text" id="vsDocID" name="vsDocID" readonly class="form-control">
                  </div>
                </div>
                <div class="col-md-6 px-1">
                  <div class="form-group">
                    <label for="date"><strong>Component/Unit:</strong></label>
                    <input id="vsCompo" name="vsCompo" class="form-control" readonly>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label><strong>Document Type/Categrory:</strong></label>
                    <input type="text" readonly class="form-control" name="vsCat" id="vsCat">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label><strong>Particulars:</strong></label>
                    <input type="text" readonly class="form-control" name="vsPart" id="vsPart">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label><strong>Document History:</strong></label>
                    <div class="modal-body" id="document_detail">
                      
                    </div>
                  </div>
                </div>
              </div> 
              <div class="row">
                <div class="col-md-6">
                  <label for="docType"><strong>Status:</strong></label>
                  <input type="text" class="form-control" name="vsStatus" id="vsStatus">
                </div>
                <div class="col-md-6">
                  <label for="docType"><strong>Station Unit:</strong></label>
                  <input type="text" readonly class="form-control" id="vsStUnit" name="vsStUnit">
                </div>
              </div>
              </form>
          </div>


          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button"class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            <button id="btnPrint" type="button" onclick="js:window.print()" class="btn btn-default btnPrint">Print</button>
            </div>
          </div>
          </div>
        </div>
      </div>




<!--##########################################################################################################################-->
<!-- Display to Modal-->
<script>
$(document).ready(function(){
  $(".view_data").click(function(){
    $("#VSModal").modal("show");
    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function(){
      return $(this).text();
    }).get();
    console.log(data);
    $('#vsDocID').val(data[0]);
    $('#vsCompo').val(data[1]);
    $('#vsCat').val(data[2]);
    $('#vsPart').val(data[3]);
    $('#vsStatus').val(data[4]);
    $('#vsStUnit').val(data[5]);
  });
});
</script>

 <script>  
 $(document).ready(function(){  
      $('.view_data').click(function(){  
           var document_id = $(this).attr("id");  
           $.ajax({  
                url:"select.php",  
                method:"post",  
                data:{document_id:document_id},  
                success:function(data){  
                     $('#document_detail').html(data);  
                     $('#VSModal').modal("show");  
                }  
           });  
      });  
 });  
 </script>

   <script>
    $(document).ready(function(){
      $('.btnPrint').click(function(){
        $("#printThis").printThis({ 
    debug: false,              
    importCSS: true,             
    importStyle: true,         
    printContainer: true,       
    loadCSS: "/queryDoc.php", 
    pageTitle: "VSModal",             
    removeInline: false,        
    printDelay: 333,            
    header: null,             
    formValues: true          
}); 
      })
    })
  </script>




</body>  
</html> 

 <script>  
 $(document).ready(function(){  
      $('#searchTable').DataTable();  
 });  
 </script>  