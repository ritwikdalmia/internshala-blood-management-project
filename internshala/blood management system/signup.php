<?php

$showAlert = false;
$showError = false;
$errors = array();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'dbconnect.php';
	$login_username=$_POST["login_username"];// sending the data
    $full_name = $_POST["full_name"];// sending the data
    $email=$_POST["email"];// sending the data
    $Mno=$_POST["Mno"];// sending the data
    $age=$_POST["age"];// sending the data
    $gender=$_POST["gender"];// sending the data
    $blood_group=$_POST["blood_group"];// sending the data

    $password=$_POST["password"];// sending the data
    $cpassword = $_POST["cpassword"];// sending the data

   
        
       
    if($password != $cpassword){// checking if password not match 
        $errors['password'] = "Confirm password not matched!";
}

    //Check whether this email exists
    $sql_email_id = "SELECT * FROM `users_internshala` WHERE email = '$email'";
    $sql_Mno = "SELECT * FROM `users_internshala` WHERE Mno = '$Mno'"; //Check whether this Mno exists
    $sql_username = "SELECT * FROM `users_internshala` WHERE login_username = '$login_username'";//Check whether this username exists
    
    $result_email_id=mysqli_query($conn, $sql_email_id) or die (mysqli_error($conn));
    $result_Mno=mysqli_query($conn, $sql_Mno) or die (mysqli_error($conn));
    $result_username=mysqli_query($conn, $sql_username) or die (mysqli_error($conn));

   
    $numExistRows = mysqli_num_rows($result_email_id);
    $numExistRows1 = mysqli_num_rows($result_Mno);
    $numExistRows2 = mysqli_num_rows($result_username);
   
    
    if($numExistRows > 0){
        // $exists = true;
        $errors['email'] = "Email that you have entered is already exist!";
    }
    if($numExistRows1 > 0){
        // $exists = true;
        $errors['Mno'] = "Mobile Number that you have entered is already exist!";
    }
    if($numExistRows2>0){
        $errors['username'] = "Login username that you have entered is already exist!";


    }
   
    
?>
           
                 
        
    <?php
   

   if (empty($errors)) {
        // $exists = false; 
        if(($password == $cpassword)){ //if password matched then proceed
            $hash = password_hash($password, PASSWORD_DEFAULT); //password hashed 
            date_default_timezone_set('Asia/Kolkata'); //set the default date timezone
            $timestamp = date("Y-m-d H:i:s"); // set the date format
            $sql = "INSERT INTO `users_internshala` (`login_username`,`full_name`, `email`,`Mno`,`age`,`gender`,`blood_group`,`password`, `creation_time`) VALUES ('$login_username','$full_name','$email','$Mno','$age','$gender','$blood_group','$hash','$timestamp')"; //insert the data into user table
                $result = mysqli_query($conn, $sql);
                 if ($result){
                    $sql_profile ="INSERT INTO profile_internshala (`login_username`,`full_name`, `email`,`Mno`,`age`,`gender`,`blood_group`) SELECT `login_username`,`full_name`,`email`,`Mno`,`age`,`gender`,`blood_group` from users_internshala WHERE NOT EXISTS (SELECT `email` FROM profile_internshala WHERE profile_internshala.email= users_internshala.email) LIMIT 1"; // copying the data to profile table
                    $result_profile = mysqli_query($conn, $sql_profile);
                 }
                    if($result_profile){


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
									<p class="text-secondary mb-1">User</p>
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
									<h6 class="mb-0">Login UserName</h6> <!--user input-->
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" placeholder="enter login username" name="login_username" id="login_username" required>
								</div>
							</div>



							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Full Name</h6> <!--user input-->
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" placeholder="enter full name" name="full_name" id="full_name" required>
								</div>
							</div>
							
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Email</h6> <!--user input-->
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="email" class="form-control" name="email" id="email" placeholder="example@gmail.com">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Mobile Number</h6> <!--user input-->
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" name="Mno" id="Mno" placeholder="enter your number" pattern="[0-9]{10}" title="Please enter a valid 10-digit mobile number." required  >
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Age</h6> <!--user input-->
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" name="age" id="age" placeholder="enter your age" pattern="[0-9]{2}" required  >
								</div>
							</div>

                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Gender </h6> <!--user input-->
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" name="gender" id="gender" placeholder="enter your gender" pattern="male|female" title="Please enter either 'male' or 'female'"  required  >
								</div>
							</div>

                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Blood Group</h6> <!--user input-->
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" name="blood_group" id="blood_group" max-length="3" placeholder="blood group:-A+" required>
								</div>
							</div>


							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">password</h6> <!--user input-->
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="password" class="form-control" name="password" id="password" pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[^\w\s]).{8,}" title="Please enter one uppercase,one digit,one symbol with minmun length 8" >
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">confirm password</h6> <!--user input-->
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