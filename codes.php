

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="./resources/css/user.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./resources/img/PRDP-LOGO.png">
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="./resources/css/bootstrap.min.css" rel="stylesheet" />
  <link href="./resources/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />

                    <?php
                  include ("db_connection.php");
                  $selectQuery = "SELECT * FROM document_logs";
                  $query_run = mysqli_query($dbcon,$selectQuery);
                      if($query_run) {
                        foreach ($query_run as $row) {
                      ?>
                        <tr class='text-center'>
                          <td><?php echo $row['docu_id']; ?></td>
                          <td><?php echo $row['component'];?></td>
                          <td><?php echo $row['category'];?></td>
                          <td><?php echo $row['particulars'];?></td>
                          <td><?php echo $row['remarks'];?></td>
                          <td><?php echo $row['stationUnit'];?></td>
                                                <?php
                    }
                  } else {
                    echo "No Records Found";
                  }
                  ?>

                                <form role="search" method="GET" action="queryDoc.php">
                <div class="row">
                  <div class="col-md- pr-1">
                    <div class="form-group">
                      <input onkeyup="myFunction()" type="text" id="dcSearch" name="dcSearch" class="form-control" placeholder="Enter Document ID">
                    </div>
                  </div>
                  <div class="col-md-2 pl-1">
                    <div class="form-group">
                      <label></label>
                      <input class="btn btn-primary btn-round" value="Search" id="didSearchbtn" name="didSearchbtn" data-bs-toggle="modal" data-bs-target="#SearchModal">
                    </div>
                  </div>
                </div>
              </form>

                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">


                              <form role="search" method="GET" action="queryDoc.php">
                <div class="row">
                  <div class="col-md-8 pr-1">
                    <div class="form-group">
                      <label for="date">Document ID:</label>
                      <input onkeyup="myFunction()" type="text" id="txt_searchall" name="txt_searchall" class="form-control" placeholder="Enter Document ID">
                    </div>
                  </div>

                  <div class="col-md-2 pl-1">
                    <div class="form-group">
                      <label></label>
                      <input class="btn btn-primary btn-round" value="Search" id="didSearchbtn" name="didSearchbtn" data-bs-toggle="modal" data-bs-target="#SearchModal">
                    </div>
                  </div>
                </div>
              </form>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>


<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>





  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="./resources/css/user.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./resources/img/PRDP-LOGO.png">
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="./resources/css/bootstrap.min.css" rel="stylesheet" />
  <link href="./resources/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />

  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
  <script type="text/javascript" src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>


<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>


table.dataTable thead .sorting:after,
table.dataTable thead .sorting:before,
table.dataTable thead .sorting_asc:after,
table.dataTable thead .sorting_asc:before,
table.dataTable thead .sorting_asc_disabled:after,
table.dataTable thead .sorting_asc_disabled:before,
table.dataTable thead .sorting_desc:after,
table.dataTable thead .sorting_desc:before,
table.dataTable thead .sorting_desc_disabled:after,
table.dataTable thead .sorting_desc_disabled:before {
  bottom: .5em;
}

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<script>
     $(document).ready(function(){
          $('tr').each(function(){
               var totmarks=0;
               $(this).find('.subjects').each(function(){
                    var marks=$(this).text();
                    if(marks.length!=0){
                         totmarks+=parseFloat(marks);
                    }
               });
               $(this).find('#TotMarks').html('='+totmarks);
          });
     });
</script>
<?php  
 if(isset($_POST["employee_id"]))  
 {  
      $output = '';  
      $connect = mysqli_connect("localhost", "root", "", "dts_dbase");  
      $query = "SELECT * FROM docu_query WHERE docu_id = '".$_POST["employee_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">
                           <tr> 
                     <td><label>Component</label></td>
                     <td><label>Remarks/Actions Taken</label></td>
                     <td><label>Date Received</label></td>
                     <td><label>Time Received</label></td>
                     <td><label>Date Released</label></td>
                     <td><label>Time Released</label></td>
                     <td><label>Duration</label></td>
               </tr>  ';
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  

               <tr>
                     <td>'.$row["from_component"].'</td> 

                     <td>'.$row["status"].'</td>  

                     <td>'.$row["date_received"].'</td>  
 
                     <td>'.$row["time_received"].'</td>  
  
                     <td>'.$row["date_released"].'</td>  

                     <td>'.$row["time_released"].'</td>

                     <td id="TotMarks"></td>  
                </tr>  
                ';  
      }  
      $output .= "</table></div>";  
      echo $output;  
 }  
 ?>


 <script>
     $(document).ready(function(){
          $('tr').each(function(){
               var totmarks=0;
               $(this).find('.subjects').each(function(){
                    var marks=$(this).text();
                    if(marks.length!=0){
                         totmarks+=parseFloat(marks);
                    }
               });
               $(this).find('#TotMarks').html('='+totmarks);
          });
     });
</script>
<?php  
 if(isset($_POST["employee_id"]))  
 {  
      $output = '';  
      $connect = mysqli_connect("localhost", "root", "", "dts_dbase");  
      $query = "SELECT * FROM docu_query WHERE docu_id = '".$_POST["employee_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">
                           <tr> 
                     <td><label>Component</label></td>
                     <td><label>Remarks/Actions Taken</label></td>
                     <td><label>Date Received</label></td>
                     <td><label>Time Received</label></td>
                     <td><label>Date Released</label></td>
                     <td><label>Time Released</label></td>
                     <td><label>Duration</label></td>
               </tr>  ';
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  

               <tr>
                     <td class="subjects">10</td> 

                     <td class="subjects">20</td>  

                     <td class="subjects">30</td>  
 
                     <td class="subjects">40</td>  
  
                     <td class="subjects">50</td>  

                     <td class="subjects">60</td>

                     <td id="TotMarks"></td>  
                </tr>  
                ';  
      }  
      $output .= "</table></div>";  
      echo $output;  
 }  
 ?>

