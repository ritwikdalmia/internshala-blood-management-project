<?php
session_start(); //same as user signup page
$showAlert = false;
$showError = false;
$errors = array();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'dbconnect.php';
	$hospital_name = $_POST["hospital_name"];
    $admin_username = $_POST["admin_username"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $cpassword=$_POST["cpassword"];

   
        
       
    if($password != $cpassword){
        $errors['password'] = "Confirm password not matched!";
}

    //Check whether this email exists
	$sql_email_id = "SELECT * FROM `admin_internshala` WHERE email = '$email'";
    $sql_admin_username = "SELECT * FROM `admin_internshala` WHERE admin_username = '$admin_username'";
    $sql_hospital_name = "SELECT * FROM `admin_internshala` WHERE hospital_name = '$hospital_name'";
    $result_email_id=mysqli_query($conn, $sql_email_id) or die (mysqli_error($conn));
    $result_admin_username=mysqli_query($conn, $sql_admin_username) or die (mysqli_error($conn));
    $result_hospital_name=mysqli_query($conn, $sql_hospital_name) or die (mysqli_error($conn));
   
    $numExistRows = mysqli_num_rows($result_admin_username);
    $numExistRows1 = mysqli_num_rows($result_email_id);
    $numExistRows2 = mysqli_num_rows($result_hospital_name);
   
    
	if($numExistRows > 0){
        // $exists = true;
       $errors['admin_username'] = "Username  that you have entered is already exist!";
    }
    if($numExistRows1 > 0){
        // $exists = true;
        $errors['email'] = "Email that you have entered is already exist!";
    }
    if($numExistRows2 > 0){
        // $exists = true;
        $errors['hospital_name'] = "Hospital name that you have entered is already exist!";
    }
    
?>
           
                 
        
    <?php
   

   if (empty($errors)) {
        // $exists = false; 
        if(($password == $cpassword)){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            date_default_timezone_set('Asia/Kolkata');
            $timestamp = date("Y-m-d H:i:s");
            $sql = "INSERT INTO `admin_internshala` (`admin_username`,`hospital_name`,`email`,`password`, `creation_time`) VALUES ('$admin_username','$hospital_name','$email','$hash','$timestamp')";
                $result = mysqli_query($conn, $sql);
                 if ($result){
                
                              header('location:applied_successfully.html');
                            }
                            
                        
    
    
    
    
                    
            
           
     
        }
       
    
    }
    
}

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
   
    <title>user Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="pt-2 pl-3" style="background:wheatwhite">
<?php           
    include 'dbconnect.php';

                 
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
<?php
     
    if($showAlert){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success! Account created Sucessfully</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }

        
    ?>
    <h1 class="mb-0" style="text-align: center;">SIGNUP PAGE</h1>
    <br>

<div class="container">
		<div class="main-body">
			<div class="row">
				<div class="col-lg-4">
					<div class="card" style="width:95%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
			-webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
							<img src="images/logo.png" alt="Admin" class="rounded-circle bg-transparent"  height="200" width="200">
								<div class="mt-3">
		
									 <h4>Internshala Hospital </h4>
									<p class="text-secondary mb-1">Administration</p>
									<p class="text-muted font-size-sm">Sign Up</p>
								
				
									
								</div>
							</div>
							
						</div>
					</div>
				</div>
				<div class="col-lg-8 box-lm">
					<div class="card" style="width:95%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
					-webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );">
						<div class="card-body">
							<form action="signup.php" method="POST">


                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Admin UserName</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" placeholder="enter login username" name="admin_username" id="admin_username" required>
								</div>
							</div>



							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Hospital Name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" placeholder="enter Hospital Name" name="hospital_name" id="hospital_name" required>
								</div>
							</div>
							
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Email</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="email" class="form-control" name="email" id="email" placeholder="example@gmail.com">
								</div>
							</div>
                            
                           

                           
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">password</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="password" class="form-control" name="password" id="password" pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[^\w\s]).{8,}" title="Please enter one uppercase,one digit,one symbol with minmun length 8" >
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">confirm password</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="password" class="form-control" name="cpassword" id="cpassword" pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[^\w\s]).{8,}" title="Please enter one uppercase,one digit,one symbol with minmun length 8">
								</div>
							</div>
                            

                          

							
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" class="btn btn-primary px-4" value="Sign Up">
								</div>
							</div>
						</div>
						</form>
						<p class = "text-center">Already Have An Account?? <a href="login.php">login Here</a></p>
					</div>
					
				</div>
			</div>
			<!--row ended-->
		</div>
	</div>

<br><br>

<style type="text/css">
body{

    margin-top:20px;
}


	@media (max-width: 768px) {
		.box-lm{
			margin-top:5% !important
		}
}
</style>


<script type="text/javascript">

</script>
</body>
</html>