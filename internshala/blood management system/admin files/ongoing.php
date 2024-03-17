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
	
   
    // if requested application accepted then quantity will be decreased by 1 or updated in the database 

  
   $sql_update = "SELECT * FROM application_request INNER JOIN admin_internshala ON application_request.hospital_name = admin_internshala.hospital_name
   where application_request.application_request_id='$application_request_id'";
   	$result_update=mysqli_query($conn, $sql_update) or die (mysqli_error($conn));
	

  
   if($result_update){
	$update1 = "UPDATE application_request SET permission=0,acceptance='Accepted' where application_request_id='$application_request_id'";
	$sql2=mysqli_query($conn,$update1);

    if($sql2){
        $sql_update = "SELECT application_request.blood_id FROM application_request INNER JOIN admin_internshala ON application_request.hospital_name = admin_internshala.hospital_name
   where application_request.application_request_id='$application_request_id'";
   	$result_update=mysqli_query($conn, $sql_update) or die (mysqli_error($conn));
       while($row1 = mysqli_fetch_assoc($result_update)){
        $blood_id1=$row1['blood_id'];
        
        }

    $select_display= "select blood_type.quantity,blood_type.blood_id from blood_type inner join application_request on application_request.blood_id=blood_type.blood_id where blood_type.blood_id='$blood_id1' and application_request_id='$application_request_id'" ;
 $sql2 = mysqli_query($conn,$select_display);
 while($row1 = mysqli_fetch_array($sql2)){
    $quantity=$row1[4];
    
 
 }
  $update_quantity="UPDATE blood_type SET quantity=quantity-1 where blood_id='$blood_id1'";


	  $sql3=mysqli_query($conn,$update_quantity);
if($sql3)
	  { 
		  $showAlert=true;
      header('location:manage_blood_type.php');
		 
	  }
    }


	

   

	

   }

	  
	 


}
   





?>
	
