
<?php
$login = false; //login false by default
$showError = false;//showerror false by default
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'dbconnect.php';//datbase connect and query will excute on the basis of connection
    $login_username = $_POST["login_username"]; // user entered the login username
    $password = $_POST["password"]; //encrypted password
	
	
    
    
     
   
    $sql = "Select * from users_internshala where  login_username='$login_username'"; //checking if the user is exist in the database
    $result = mysqli_query($conn, $sql); // execute 
    $num = mysqli_num_rows($result); //counting the number of rows returned 
    if ($num == 1){ //row  should be executed should return 1 
        while($row=mysqli_fetch_assoc($result)){ 
            if (password_verify($password, $row['password'])){ // password verify has been used to check the password entered by user have match or not from the database (Decrypting the password)
                $login = true;// if password match login set to true
                session_start(); // session start used to avoid re login while visiting other pages
                $_SESSION['loggedin'] = true; //session keyword used to check if session is started or not
                $_SESSION['login_username'] = $login_username; // username keyword will be used to dynmically fetch the details 
                header("location: welcome.php");//redirected to home page
                
            } 
            else{
                $showError = "Invalid Credentials"; // else invalid credentials
            }
        }
        
    } 
	


}
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
   
    <title>Student Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
</head>


<?php
    if($login){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You are logged in
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }
    if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $showError.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }

    
    ?>
<body>
<h1 class="mb-0" style="text-align: center;">LOGIN PAGE</h1>
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
									<p class="text-muted font-size-sm">Login In</p>
								
				
									
								</div>
							</div>
							
						</div>
					</div>
				</div>
				<div class="col-lg-8 box-lm">
					<div class="card" style="width:95%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
					-webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );">
						<div class="card-body">
							<form action="login.php" method="POST">
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">login_username</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="ritwik" name="login_username" id="login_username">
								</div>
							</div>
							
							
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">password</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="password" class="form-control"   name="password" id="password">
								</div>
							</div>
		
							
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" class="btn btn-primary px-4" value="login">
								</div>
							</div>
						</div>
						</form>
						<p class = "text-center">dont Have An Account?? <a href="signup.php">create Here</a></p>
					</div>
					
				</div>
			</div>
			<!--row ended-->
		</div>
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













