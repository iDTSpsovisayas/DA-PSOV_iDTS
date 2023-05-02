<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management - PRDP-PSO Visayas Cluster Document Tracking System (DTS)</title>
    <link rel="stylesheet" href="./resources/css/management.css">
    <!--Time Script Start-->
    <script type="text/javascript">
        function startTime()
        {
        var today=new Date();
        var h=today.getHours();
        var min=today.getMinutes();
        var s=today.getSeconds();
        var dt = new Date()
        
        // add a zero in front of numbers<10
        min=checkTime(min);
        s=checkTime(s);
        document.getElementById('txt').innerHTML=h+":"+min+":"+s+" | "+(("0"+(dt.getMonth()+1)).slice(-2)) +"/"+ (("0"+dt.getDate()).slice(-2)) +"/"+ (dt.getFullYear());
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
    <!--Time Script End-->
</head>
<body onload="startTime()">
    <div class="banner">
        <img class="prdp_logo" src="./resources/images/Web-Banner.png" alt="">
    </div>
    
    
    <!--NavBar Section-->
    <nav class="navbar">
        <ul>    
            <li><a href="./user.html">Dashboard</a></li>
            <li><a href="./ND.html">New Document</a></li>
            <li><a href="./DQ.html">Document Query</a></li>
            <li><a class="active" href="">Management</a></li>
            <li style="float: right"><a id="txt"></a></li>
        </ul>
    </nav>
    
    <!--User Section-->
    <div class="UserSearch">
        <span id="User-search">Search User:</span>
        <input class="input" type="text" id="UserID" name="UserID">
        <button class="btn" type="submit">Search</button>
        <button class="btn" type="submit">Add New +</button>
    </div>

     <form action="">
     <div class="db_Table">
     <table id="dashboard-table">
         <tr>
             <th>User ID</th>
             <th>Component / Unit</th>
             <th>Username</th>
             <th>password</th>
             <th>Action</th>
         </tr>
         <?php

         $conn = mysqli_connect("localhost","root","","dts_table");
         if ($conn-> connect_error) {
             die ("Connection failed:".$conn-> connect_error);
         }

         $sql = "Select user_id, component_unit, username, password from user_table";
         $result = $conn-> query($sql);

         if ($result-> num_rows > 0) {
             while ($row = $result-> fetch_assoc()) {
                 echo "<tr><td>". $row["user_id"]."</td><td>".$row["component_unit"]."</td><td>".$row["username"]."</td><td>".$row["password"]."</td></tr>";
             }
             echo "0 result";
         }

         $conn-> close();
         ?>
         <tr>
            <td>PSOV-UID-001</td>
            <td>ODPD</td>
            <td>ODPD</td>
            <td>ODPD</td>
            <td id="action">
                <input class="btn" type="submit" value="Update"><br><br>
                 <input class="btn" type="submit" value="Delete">
            </td>
        </tr>
     </table>
    </div>
    </form>

        <!--Docs Section-->
        <div class="DocsSearch">
            <span id="Docs-search">Search Documents Logs:</span>
            <input class="input" type="text" id="DocID" name="DocID">
            <button class="btn" type="submit">Search</button>
            <button class="btn" type="submit">Print Report</button>
        </div>
    
         
         <div class="db_Table">
         <table id="dashboard-table">
             <tr>
                 <th>DID No:</th>
                 <th>Document Type</th>
                 <th>Component/Unit</th>
                 <th>Creation Date & Time</th>
                 <th>Completion Date & Time</th>
                 <th>No. of Days Processed</th>
             </tr>
             <tr>
                <td>PSOV-DID-21-001</td>
                <td>Purchase Request</td>
                <td>IBUILD Unit</td>
                <td>08/27/21 09:32:06</td>
                <td>08/30/21 02:40:26</td>
                <td>3</td>
            </tr>
         </table>
        </div>

        <!--User Logs Section-->
        <div class="ULSearch">
            <span id="UL-search">Search User Logs:</span>
            <input class="input" type="text" id="UserID" name="UserID">
            <button class="btn" type="submit">Search</button>
            <button class="btn" type="submit">Print Report</button>
        </div>
    
         
         <div class="db_Table">
         <table id="dashboard-table">
             <tr>
                 <th>User ID No:</th>
                 <th>Component/Unit</th>
                 <th>Log In Date & Time</th>
                 <th>Duration (hrs)</th>
             </tr>
             <tr>
                <td>PSOV-UID-002</td>
                <td>IBUILD Unit</td>
                <td>08/27/21 09:32:06</td>
                <td>5</td>
            </tr>
         </table>
        </div>
</body>
</html>