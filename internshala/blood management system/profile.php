<?php
 session_start();

$showAlert=false;
$showError=false;

 if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){ // if not logged in then redirect to login
	header("location:login.php");
     exit;
 }
 else{
    
 include "dbconnect.php";
 $login_username=$_SESSION['login_username'];// will be used to fetch the details only for the login order
 $select_display= "select login_username,full_name,email,Mno,age,gender,blood_group,address,state,city,zip from profile_internshala where login_username='$login_username'" ;
 $sql1 = mysqli_query($conn,$select_display);
 while($row1 = mysqli_fetch_array($sql1)){
	$login_username=$row1[0];
    $full_name=$row1[1];
	$email=$row1[2];
	$Mno=$row1[3];
	$age=$row1[4];
	$gender=$row1[5];
	$blood_group=$row1[6];
 	$address=$row1[7];
 	$state=$row1[8];
 	$city=$row1[9];
 	$zip=$row1[10];
 }
}

?>
<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
   $address=$_POST['address'];
   $state=$_POST['state'];
   $city=$_POST['city'];
   $zip=$_POST['zip'];
 


   //$email=$_POST['email'];
   $select= "select * from profile_internshala where login_username='$login_username'"; 
   $sql = mysqli_query($conn,$select);
   $row = mysqli_fetch_assoc($sql);
   
   
	$update = "update profile_internshala set address='$address',state='$state',city='$city',zip='$zip' where login_username='$login_username'"; //updating the details
		$sql2=mysqli_query($conn,$update);
  if($sql2)
		{ 
			$showAlert=true;
		   
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
            <strong>Profile Update Successfully!</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div> ';
        }
        if($showError){
            echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>profile cannot be edited please go to settings</strong> 
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
								<?php //profile pic will be changed on the basis of gender
								$avatarUrl = ($gender === 'male') ? 'https://bootdey.com/img/Content/avatar/avatar6.png' : 'https://bootdey.com/img/Content/avatar/avatar3.png';
								?>
   								<img src="<?php echo $avatarUrl; ?>" alt="User Avatar" class="rounded-circle p-1 bg-primary" width="110">
								<div class="mt-3">
		
									 <h4><?php echo $full_name?></h4>
									<p class="text-secondary mb-1"><?php echo $login_username?></p>
									<p class="text-muted font-size-sm"><?php echo $Mno?></p>
								
				
									
								</div>
							</div>
							
						</div>
					</div>
				</div>
				<div class="col-lg-8 box-lm box-km">
					<div class="card" style="width:100%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
-webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );">
						<div class="card-body">
							<form action="profile.php" method="post">

                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Login username</h6>  
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="<?php echo $login_username?>" name="login_username"id="login_username" disabled>	<!-- cannot be changed -->

								</div>
                                </div>

							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Full Name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="<?php echo $full_name?>" name="full_name"id="full_name" disabled> <!-- cannot be changed -->
								</div>
		
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Email</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="<?php echo $email?>" disabled> <!-- cannot be changed -->
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Mobile</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="<?php echo $Mno?>"  name="Mno" id="Mno" disabled> <!-- cannot be changed -->
								</div>
							</div>

							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Age</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="<?php echo $age?>" name="age" id="age" disabled> <!-- cannot be changed -->
								</div>
							</div>
							
							
	                        
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">gender</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="<?php echo $gender?>" name="gender" id="gender" disabled> <!-- cannot be changed -->
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Blood Group</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="<?php echo $blood_group?>" name="blood_group" id="blood_group" disabled> <!-- cannot be changed -->
								</div>
							</div>
					
							<?php 
							$sql_option3 = "
							SELECT address from profile_internshala where login_username='$login_username'";
						

$select_sql5 = mysqli_query($conn,$sql_option3);
while($row4 = mysqli_fetch_assoc($select_sql5)){
	$address =$row4['address'];
	
}
if ($address!='NULL'){// cannot be changed if exist
	
							echo "


<div class='row mb-3'>
<div class='col-sm-3'>
	<h6 class='mb-0'>Address</h6>
</div>
<div class='col-sm-9 text-secondary'>
	<input type='text' class='form-control' value=' $address' name='address' id='address' disabled> 
</div>
</div>";}
else{ //if empty then need to required
echo "
	<div class='row mb-3'>
								<div class='col-sm-3'>
									<h6 class='mb-0'>Address</h6>
								</div>
								<div class='col-sm-9 text-secondary'>
									<input type='text' class='form-control' placeholder='enter address' name='address' id='address'  required>
								</div>
							</div>";

}

							?>







							<?php 
							$sql_option3 = "
							SELECT state from profile_internshala where login_username='$login_username'";
						

$select_sql5 = mysqli_query($conn,$sql_option3);
while($row4 = mysqli_fetch_assoc($select_sql5)){
	$state =$row4['state'];
	
}
if ($state!='NULL'){ // cannot be changed if exist
	
							echo "


<div class='row mb-3'>
<div class='col-sm-3'>
	<h6 class='mb-0'>state</h6>
</div>
<div class='col-sm-9 text-secondary'>
	<input type='text' class='form-control' value=' $state' name='state' id='state' disabled>
</div>
</div>";}
else{ //if empty then need to required
echo "
	<div class='row mb-3'>
								<div class='col-sm-3'>
									<h6 class='mb-0'>state</h6>
								</div>
								<div class='col-sm-9 text-secondary'>
									<input type='text' class='form-control' placeholder='enter state' name='state' id='state'  required>
								</div>
							</div>";

}

							?>
							


							<?php 
							$sql_option3 = "
							SELECT city from profile_internshala where login_username='$login_username'";
						

$select_sql5 = mysqli_query($conn,$sql_option3);
while($row4 = mysqli_fetch_assoc($select_sql5)){
	$city =$row4['city'];
	
}
if ($city!='NULL'){ // cannot be changed if exist
	
							echo "


<div class='row mb-3'>
<div class='col-sm-3'>
	<h6 class='mb-0'>city</h6>
</div>
<div class='col-sm-9 text-secondary'>
	<input type='text' class='form-control' value=' $city' name='city' id='city' disabled>
</div>
</div>";
}
else{ //if empty then need to required
echo "
	<div class='row mb-3'>
								<div class='col-sm-3'>
									<h6 class='mb-0'>city</h6>
								</div>
								<div class='col-sm-9 text-secondary'>
									<input type='text' class='form-control' placeholder='enter city' name='city' id='city'  required>
								</div>
							</div>";

}

							?>
							

							<?php 
							$sql_option3 = "
							SELECT zip from profile_internshala where login_username='$login_username'";
						

$select_sql5 = mysqli_query($conn,$sql_option3);
while($row4 = mysqli_fetch_assoc($select_sql5)){
	$zip =$row4['zip'];
	
}
if ($zip!=0){ // cannot be changed if exist
	
							echo "


<div class='row mb-3'>
<div class='col-sm-3'>
	<h6 class='mb-0'>zip</h6>
</div>
<div class='col-sm-9 text-secondary'>
	<input type='text' class='form-control' value=' $zip' name='zip' id='zip' disabled>
</div>
</div>";}
else{ //if empty then need to required
echo "
	<div class='row mb-3'>
								<div class='col-sm-3'>
									<h6 class='mb-0'>zip</h6>
								</div>
								<div class='col-sm-9 text-secondary'>
									<input type='text' class='form-control' placeholder='enter zip' name='zip' id='zip' pattern='[0-9]{6}' title='Please enter a valid 6-digit zip number.'  required>
								</div>
							</div>";

}

							?>
							
							
                            
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" class="btn btn-primary px-4" value="Save Changes"  required>
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