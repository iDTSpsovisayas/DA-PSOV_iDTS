<?php  
$dbcon=mysqli_connect("localhost","root","", "dts_dbase");  
mysqli_select_db($dbcon,"SELECT * from users,user_logs,document_logs,docu_query,pending_docs,received_docs,release_docs");  
?> 