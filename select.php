<?php  
 if(isset($_POST["document_id"]))  
 {  
      $output = '';  
      $connect = mysqli_connect("localhost", "root", "", "dts_dbase");  
      $query = "SELECT * FROM docu_query WHERE docu_id = '".$_POST["document_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $output .= '  
      <div class="table">  
           <table class="table table-bordered">
                           <tr> 
                     <td><label>Component</label></td>
                     <td><label>Remarks/Actions Taken</label></td>
                     <td><label>Date Received</label></td>
                     <td><label>Time Received</label></td>
                     <td><label>Date Released</label></td>
                     <td><label>Time Released</label></td>
                     <td><label>No of Days</label></td>
               </tr>  ';
      while($row = mysqli_fetch_array($result))  
      {  
           $date1 = $row["date_received"];
           $date2 = $row["date_released"];
           $strDate = strtotime($date1);
           $endDate = strtotime($date2);
           $dateDiff = $endDate-$strDate;
           $diff = abs(floor($dateDiff/(60*60*24)));
           if($date1=="0000-00-00"){
               $diff = abs(floor($dateDiff*0));
           }
           
           $output .= '  

               <tr class="text-center">
                     <td>'.$row["from_component"].'</td> 

                     <td>'.$row["status"].'</td>  

                     <td>'.$row["date_received"].'</td>  
 
                     <td>'.$row["time_received"].'</td>  
  
                     <td>'.$row["date_released"].'</td>  

                     <td>'.$row["time_released"].'</td>

                     <td>'.$diff.'</td>  
                </tr>  
                ';  
      }  
      $output .= "</table></div>";  
      echo $output;  
 }  
 ?>
