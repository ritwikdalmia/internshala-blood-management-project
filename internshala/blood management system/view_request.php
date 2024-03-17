<?php
 session_start();
 $errors = array();

$showAlert=false;
$showError=false;

 if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
     header("location:login.php");
     exit;
 }
 else{
    
 include "dbconnect.php";
 
 $login_username=$_SESSION['login_username'];
 if (isset($_GET['blood_id']) && !empty($_GET['blood_id'])) { // only return blood_id when the requested
    $blood_id_requested = $_GET['blood_id'];
}


 $select_display= "select * from users_internshala where login_username='$login_username'" ;
 $select_sql1 = mysqli_query($conn,$select_display);
 while($row1 = mysqli_fetch_array($select_sql1)){
 $login_username=$row1[1];
 
 }

 $select_display= "select gender from profile_internshala where login_username='$login_username'" ;
 $sql1 = mysqli_query($conn,$select_display);
 while($row1 = mysqli_fetch_array($sql1)){
	$gender=$row1[0];
    $avatarUrl = ($gender === 'male') ? 'https://bootdey.com/img/Content/avatar/avatar6.png' : 'https://bootdey.com/img/Content/avatar/avatar3.png';


 }

 // Checking if the profile is completed or not 
 $select_profile= "select email,Mno,full_name,address,state,city,zip from profile_internshala where login_username='$login_username'" ;
    $sql_profile = mysqli_query($conn,$select_profile);
    while($row2 = mysqli_fetch_array($sql_profile)){
     
    $email=$row2[0];
    $Mno=$row2[1];
    $full_name=$row2[2];
    $address=$row2[3];
    $state=$row2[4];
    $city=$row2[5];
    $zip=$row2[6];
    if (empty($state) || empty($city) || empty($zip) || empty($address)) {
        // Display an error message or log the error
        $errors['profile'] = "profile is not completed!";
    }
}

if (isset($_GET['blood_id']) && !empty($_GET['blood_id'])) {// only return blood_id when the requested (not necessary*)
    $blood_id_requested = $_GET['blood_id'];


$select_display2="SELECT * from blood_type where blood_id='$blood_id_requested'"; //fetching the details
$sql3 = mysqli_query($conn,$select_display2);
while($row=mysqli_fetch_assoc($sql3)){
   
    
    
    $blood_id=$row['blood_id'];
    $blood_type=$row['blood_type'];
    $hospital_name=$row['hospital_name'];  
    $quantity=$row['quantity'];
    $timestamp=$row['timestamp'];


    $sql_blood_type = "SELECT * FROM `application_request` WHERE blood_type = '$blood_type' and permission!=0 and login_username='$login_username'"; //checking if the same blood type requested from different hospital  application is already in pending or in process 
$sql_hospital_name = "SELECT * FROM `application_request` WHERE hospital_name = '$hospital_name'and permission!=0 and login_username='$login_username'"; //checking if the blood  requested from the same hospital if  application is already in pending or in process 

$result_blood_type=mysqli_query($conn, $sql_blood_type) or die (mysqli_error($conn));
$result_hospital_name=mysqli_query($conn, $sql_hospital_name) or die (mysqli_error($conn));


$numExistRows = mysqli_num_rows($result_blood_type);
$numExistRows1 = mysqli_num_rows($result_hospital_name);


if($numExistRows > 0){
    // $exists = true;
    $errors['blood_type'] = "You already requested the blood type!";
    header("location:blood_type_error.html");

}
if($numExistRows1 > 0){
    // $exists = true;
    $errors['hospital_name'] = "You already requested the blood from same hospital!";
    header("location:hospital_name_error.html");

}


if (empty($errors)) { // if all conditions work then it will work
    date_default_timezone_set('Asia/Kolkata');
            $timestamp1 = date("Y-m-d");


$insert ="INSERT INTO `application_request` (`blood_id`,`login_username`,`full_name`,`blood_type`,`hospital_name`,`quantity`,`application_time`) VALUES ('$blood_id','$login_username','$full_name','$blood_type','$hospital_name','1','$timestamp1')";


  $sql3=mysqli_query($conn,$insert);
if($sql3)
  { 
      $showAlert=true;
      header("location:view_application_request.php");
  
     
  }
}
}

}

 

 
 }
 

?>

	

<!DOCTYPE html>
<html lang="en">

<body> 

    
    
<br><br><br>
<div class="wrapper">
<?php
if(count($errors) == 1){
                     ?>
                     <div class="alert alert-danger text-center">
                         <?php
                         foreach($errors as $showerror){
                             echo $showerror;
                         }
                         ?>
                     </div>
                     <?php
                 }elseif(count($errors) > 1){
                     ?>
                     <div class="alert alert-danger">
                         <?php
                         foreach($errors as $showerror){
                             ?>
                             <li><?php echo $showerror; ?></li>
                             <?php
                         }
                         ?>
                     </div>
                     <?php
                 }
                 ?>

<?php include 'nav.php';?>
    <div class="container">
		<div class="main-body">
            <!--list product-->

			<div class="row">
                
					<!--card form-->
					
						
						
						
							<p style="color:red;"><b>Blood sample availble </b></p> <!--blood that are available -->
					</div>
					
				

            <div class='row'>
                <!--fetch product-->
                <?php
 if (empty($errors)) {

    $select_display2="SELECT blood_type.blood_id,blood_type.blood_type,blood_type.hospital_name,blood_type.quantity,blood_type.timestamp,application_request.application_request_id 
    FROM blood_type
    LEFT JOIN application_request ON blood_type.blood_id = application_request.blood_id
    WHERE application_request.blood_id IS NULL and blood_type.quantity>0";
    $sql3 = mysqli_query($conn,$select_display2);
    while($row=mysqli_fetch_assoc($sql3)){
       
        
        
        $blood_id=$row['blood_id'];
        $blood_type=$row['blood_type'];
        $hospital_name=$row['hospital_name'];  
        $quantity=$row['quantity'];
        $timestamp=$row['timestamp'];
        
                  
        echo "
                        <div class='col-lg-4'>
                    
                        <div class='card' style='width:100%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
                        -webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );'>
                            <div class='card-body' >
                                <div class='d-flex flex-column align-items-center text-center'>
                                    <img src='$avatarUrl' alt='Admin' class='rounded-circle p-1 bg-primary' width='110'>
                                    <div class='mt-3'>
                                    <table>
                                    
                                <tr>
                                    <th>Blood Id:</th> 
                                    <td>$blood_id</td>

                                </tr>

                                <tr>
                                <th>Blood Type:</th> 
                                <td>$blood_type</td>

                            </tr>

                            <tr>
                            <th>Hospital Name</th> 
                            <td>$hospital_name</td>

                        </tr>
                                <tr>
                                    <th>Quantity:</th> 
                                    <td>$quantity</td>
                                    
                                </tr>
                                <tr>
                                <th>Availbility Time:</th> 
                                <td>$timestamp</td>
                                
                            </tr>

                        
                               

                                </table>
                                <div><br><br></div>
                                <a class='btn btn-success' href='view_request.php?blood_id=$blood_id' >Request</a>
            
                                        
                                      
                                   
                                        
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    ";


                }
            
            
                ?>
                </div>
				
				
		</div>




        <!-- okie -->


        <div class="row">
                
                <!--card form-->
                
                    
                    
                    
                        <p style="color:red;"><b>Blood Sample Requested Already</b></p>  <!--blood that are requested -->
                </div>
                
            

        <div class='row'>
            <!--fetch product-->
            <?php

$select_display2="SELECT distinct blood_type.blood_id,blood_type.blood_type,blood_type.hospital_name,blood_type.quantity,application_request.application_time 
    FROM blood_type
    LEFT JOIN application_request ON blood_type.blood_id = application_request.blood_id
    WHERE application_request.permission!=0";
        $sql3 = mysqli_query($conn,$select_display2);
    while($row=mysqli_fetch_assoc($sql3)){
       
        
         
       
        
        $blood_id=$row['blood_id'];
        $blood_type=$row['blood_type'];
        $hospital_name=$row['hospital_name'];  
        $quantity=$row['quantity'];
        $timestamp=$row['application_time'];
        
                  
              
    echo "
                    <div class='col-lg-4'>
                
                    <div class='card'  style='width:100%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
                    -webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );'>
                        <div class='card-body'>
                            <div class='d-flex flex-column align-items-center text-center'>
                            <img src='$avatarUrl' alt='Admin' class='rounded-circle p-1 bg-primary' width='110'>
                            <div class='mt-3'>
                                <table>
                                
                                     
                                <tr>
                                    <th>Blood Id:</th> 
                                    <td>$blood_id</td>

                                </tr>

                                <tr>
                                <th>Blood Type:</th> 
                                <td>$blood_type</td>

                            </tr>

                            <tr>
                            <th>Hospital Name</th> 
                            <td>$hospital_name</td>

                        </tr>
                                <tr>
                                    <th>Quantity Requested:</th> 
                                    <td>1</td>
                                    
                                </tr>
                                <tr>
                                <th>Availbility Time:</th> 
                                <td>$timestamp</td>
                                
                            </tr>


                            </table>
                            <div><br><br></div>
                            <a class='btn btn-secondary' href='request_pending_user.php' >Already Requested</a>
        
                                    
                                  
                               
                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                ";


            }
        
            ?>
            </div>
            
            



        <!-- okie -->
        <div class="row">
                
                <!--card form-->
                
                    
                    
                    
                        <p style="color:red;"><b>Requests Again</b></p> <!--blood that are requested earlier  -->
                </div>
                
            

        <div class='row'>
            <!--fetch product-->
            <?php

$select_display2="SELECT DISTINCT blood_type.blood_id, blood_type.blood_type, blood_type.hospital_name, blood_type.quantity, ar.application_time
FROM blood_type
INNER JOIN application_request AS ar ON blood_type.blood_id = ar.blood_id
WHERE ar.permission IS NULL OR (ar.permission = 0 AND NOT EXISTS (
    SELECT 1
    FROM application_request AS ar_inner
    WHERE ar_inner.blood_id = blood_type.blood_id
    AND ar_inner.permission != 0
))";

        $sql3 = mysqli_query($conn,$select_display2);
    while($row=mysqli_fetch_assoc($sql3)){
       
        
         
       
        
        $blood_id=$row['blood_id'];
        $blood_type=$row['blood_type'];
        $hospital_name=$row['hospital_name'];  
        $quantity=$row['quantity'];
        $timestamp=$row['application_time'];
        
                  
              
    echo "
                    <div class='col-lg-4'>
                
                    <div class='card'  style='width:100%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
                    -webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );'>
                        <div class='card-body'>
                            <div class='d-flex flex-column align-items-center text-center'>
                            <img src='$avatarUrl' alt='Admin' class='rounded-circle p-1 bg-primary' width='110'>
                            <div class='mt-3'>
                                <table>
                                
                                     
                                <tr>
                                    <th>Blood Id:</th> 
                                    <td>$blood_id</td>

                                </tr>

                                <tr>
                                <th>Blood Type:</th> 
                                <td>$blood_type</td>

                            </tr>

                            <tr>
                            <th>Hospital Name</th> 
                            <td>$hospital_name</td>

                        </tr>
                                <tr>
                                    <th>Quantity:</th> 
                                    <td>$quantity</td>
                                    
                                </tr>
                                <tr>
                                <th>Last requested:</th> 
                                <td>$timestamp</td>
                                
                            </tr>


                            </table>
                            <div><br><br></div>
                            <a class='btn btn-success' href='request_sample.php?blood_id=$blood_id' >Request</a>
        
                                    
                                  
                               
                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                ";


            }
        }
        else{
            echo "<p style='color:red;'><b>First Update the profile</b></p>
            ";
        }
        
            ?>
            </div>

        
			

        <!-- okie -->
	 </div>
    </div>
    </div>



    



<style type="text/css">
body{
    background: #f7f7ff;
    margin-top:20px;
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid transparent;
    border-radius: .25rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
}
.table{
    border: 1px solid black;
    
}
td,th{
text-align: left;
  padding: 8px;
  
}
.me-2 {
    margin-right: .5rem!important;
}
</style>




   
<!-- jQuery CDN - Slim version (=without AJAX) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
</body>
</html>