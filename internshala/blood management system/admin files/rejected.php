<?php
$showAlert=false;
$showError=false;
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location:login.php");
    exit;
}
else{
    include 'dbconnect.php';


    $application_request_id=$_GET['application_request_id'];
    
   $display="select * from  application_request where application_request_id='$application_request_id'"; //if application is rejected


   $sql_display=mysqli_query($conn,$display);
   while($row=mysqli_fetch_assoc($sql_display)){

    $application_request_id=$row['application_request_id'];
    $blood_id=$row['blood_id'];
    $full_name =$row['full_name'];
    $login_username=$row['login_username'];
    $blood_type=$row['blood_type']; 
    $hospital_name=$row['hospital_name'];    
   
    $quantity =$row['quantity'];
    $application_time=$row['application_time'];
    $acceptance =$row['acceptance'];

   $update_application="update application_request  SET acceptance='Rejected',permission=0 where application_request_id='$application_request_id'";


	  $sql3=mysqli_query($conn,$update_application);

        $select_available="select * from blood_type where blood_id='$blood_id'";
        echo $blood_id;
        $select_display_blood=mysqli_query($conn,$select_available);
        while($row2=mysqli_fetch_assoc($select_display_blood)){
            $quantity=$row2['quantity'];
            $new_quantity=$quantity;
        
            $update_blood="update blood_type  SET quantity=$new_quantity where blood_id='$blood_id'";


            $sql_blood=mysqli_query($conn,$update_blood);
            header('location:manage_blood_type.php');
            
        }


	  
	 
}


}
?>
<?php
if($showAlert){
                echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Account disabled successfully</strong> '. $showAlert.'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> ';
                }
				?>