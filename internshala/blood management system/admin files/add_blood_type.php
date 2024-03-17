<?php
 session_start();

$showAlert=false;
$showError=false;

 if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
	header("location:login.php");
     exit;
 }
 else{
    
 include "dbconnect.php";
 $admin_username=$_SESSION['admin_username'];
 $select_display= "select * from admin_internshala where admin_username='$admin_username'" ;
 $sql1 = mysqli_query($conn,$select_display);
 while($row1 = mysqli_fetch_array($sql1)){

 $admin_username=$row1[1];
 $hospital_name=$row1[2];
 $email=$row1[3];
 }
}

?>
<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$admin_username=$_SESSION['admin_username'];
	$blood_type=$_POST['blood_type'];
	$blood_id=$_POST['blood_id'];
	$quantity=$_POST['quantity'];
	$hospital_name=$_POST['hospital_name'];
 
	$sql_blood_type = "SELECT * FROM `blood_type` WHERE admin_username = '$admin_username' and blood_type='$blood_type'"; //checking the blood group is exist or not in the same hospital
    
    $result_blood_type=mysqli_query($conn, $sql_blood_type) or die (mysqli_error($conn));
   
    $numExistRows = mysqli_num_rows($result_blood_type);
   
	if($numExistRows > 0){
		$showError="Blood group already exist";      
    }
	if (empty($showError)) {


   $select= "select * from admin_internshala where admin_username='$admin_username'";
   $sql = mysqli_query($conn,$select);
   $row = mysqli_fetch_assoc($sql);
   $res= $row['admin_username'];
   if($res === $admin_username)
   
   {
   
   
	date_default_timezone_set('Asia/Kolkata');
	$timestamp = date("Y-m-d H:i:s");
	$blood ="INSERT INTO `blood_type` ( `blood_id`,`blood_type`,`quantity`,`hospital_name`,`admin_username`,`timestamp`) VALUES ('$blood_id','$blood_type','$quantity','$hospital_name','$admin_username','$timestamp')"; //hospital admin can enter the new blood group if not exist
 	 $sql3=mysqli_query($conn,$blood); 
  if($sql3)
		{ 
			$showAlert=true;
		   
		}
		
   
}
}
}
?>
	

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>profile </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<div class="wrapper">
<?php require 'nav.php' ?>

<?php
    

    if($showAlert){
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong> Updated Successfully!</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div> ';
        }
        if($showError){
            echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>'. $showError.'</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> ';
            }
         
    ?>
    
<br><br><br>

<div class="container">
		<div class="main-body">
			<div class="row">
				<div class="col-lg-4 box-km">
					<div class="card" style="width:100%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
-webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
								<?php
								?>
                                    <img src='images/blood_group.png' alt='Admin' class='rounded-circle bg-transparent' height='100' width='100'>
								<div class="mt-3">
		
									 <h4><?php echo $hospital_name?></h4>
									<p class="text-secondary mb-1"><?php echo $email?></p>
									<p class="text-muted font-size-sm"><?php echo $admin_username?></p>
								
				
									
								</div>
							</div>
							
						</div>
					</div>
				</div>
				<div class="col-lg-8 box-lm box-km">
					<div class="card" style="width:100%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
-webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );">
						<div class="card-body">
							<form action="add_blood_type.php" method="post">

                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0" >Blood id</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                    <?php $blood_id= rand(999999, 111111);?>
									<input type="text" class="form-control" value="<?php echo $blood_id?>" name="blood_id"id="blood_id" readonly>
								</div>
		
							</div>

							

                            
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">hospital name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                	<?php 
									$sql_option="select * from admin_internshala where admin_username='$admin_username' ";
									$select_sql2 = mysqli_query($conn,$sql_option);
									while($row5 = mysqli_fetch_assoc($select_sql2)){
									 $hospital_name=$row5['hospital_name'];
                                     ?>
									<input type="text" class="form-control" value="<?php echo $hospital_name?>" name="hospital_name"id="hospital_name" readonly>
									
									<?php
									}
									?>
								
         							</select>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">blood type</h6>
								</div>
							<div class="col-sm-9 text-secondary">
                            <input type="text" class="form-control" name="blood_type" id="blood_type" required>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Quantity</h6>
								</div>
							<div class="col-sm-9 text-secondary">
                            <input type="number" class="form-control" name="quantity" id="quantity" pattern="[0-9]" required>
								</div>
							</div>

							
							
							
	                       
					
							
							
							
                            
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" class="btn btn-primary px-4" value="Add Blood Group"  required>
								</div>
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br><br>
		</div>

<style type="text/css">
body{
    background: #f7f7ff !important;
   
}

.me-2 {
    margin-right: .5rem!important;
}

@media (max-width: 768px) {
		.box-lm{
			margin-top:5% !important;
		}
}

@media (max-width: 350px) {
		.box-km{
			padding-left:0px !important;
			padding-right:0px !important;
		}
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