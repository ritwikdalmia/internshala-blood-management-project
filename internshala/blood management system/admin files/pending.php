<?php
$showAlert=false;
$showError=false;
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location:login.php");
    exit;
}
else{
    include "dbconnect.php";
 
    $admin_username=$_SESSION['admin_username'];
	$application_request_id=$_GET['application_request_id'];

   
    $select_display= "select * from admin_internshala where admin_username='$admin_username'" ;
    $select_sql1 = mysqli_query($conn,$select_display);
    while($row1 = mysqli_fetch_array($select_sql1)){
    $admin_username=$row1[1];
    
    }
	
   
    

  
   $sql_update = "SELECT * FROM application_request INNER JOIN admin_internshala ON application_request.hospital_name = admin_internshala.hospital_name
   where application_request.application_request_id='$application_request_id'";
   	$result_update=mysqli_query($conn, $sql_update) or die (mysqli_error($conn));
	

  
   if($result_update){
	$update1 = "UPDATE application_request SET permission=1 where application_request_id='$application_request_id'";
	$sql2=mysqli_query($conn,$update1);
    header("location:manage_request.php");


	

   

	

   }

	  
	 


}
   





?>
	
