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
 
 $login_username=$_SESSION['login_username'];

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

 
 }
 

?>

	

<!DOCTYPE html>
<html lang="en">

<body> 

    
    
<br><br><br>
<div class="wrapper">
<?php include 'nav.php';?>
    <div class="container">
		<div class="main-body">
            <!--list product-->

			<div class="row">
                
					<!--card form-->
					
						
						
						
							<p style="color:red;"><b>Pending Requests</b></p> <!--pending request-->
					</div>
					
				

            <div class='row'>
                <!--fetch product-->
                <?php


    $select_display2="select * from application_request where login_username='$login_username' and permission=2" ;
    $sql3 = mysqli_query($conn,$select_display2);
    while($row=mysqli_fetch_assoc($sql3)){
       
        
        $application_request_id=$row['application_request_id'];
        $blood_id=$row['blood_id'];
        $blood_type=$row['blood_type'];
        $hospital_name=$row['hospital_name'];  
        $quantity=$row['quantity'];
        $application_time=$row['application_time'];
        $permission=$row['permission'];
        if($permission==0){
            $permission='accepted';
        }
        else if($permission==1){

            $permission='process';
        }
        else{
            $permission='Pending';
        }
                  
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
                                    <th>Application request Id:</th> 
                                    <td>$application_request_id</td>
                                    
                                </tr>
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
                                <th>Request Time:</th> 
                                <td>$application_time</td>
                                
                            </tr>
                                <tr>
                                <th>permission:</th> 
                                <td>$permission</td>
                                
                            </tr>

                                </table>
                                <div><br><br></div>
                                <a class='btn btn-secondary' href='request_pending_user.php' >Pending</a>
            
                                        
                                      
                                   
                                        
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
                
                    
                    
                    
                        <p style="color:red;"><b>process Requests</b></p>  <!--In process-->
                </div>
                
            

        <div class='row'>
            <!--fetch product-->
            <?php

$select_display2="select * from application_request where login_username='$login_username' and permission=1" ;
    $sql3 = mysqli_query($conn,$select_display2);
    while($row=mysqli_fetch_assoc($sql3)){
       
        
         
       
        $application_request_id=$row['application_request_id'];
        $blood_id=$row['blood_id'];
        $blood_type=$row['blood_type'];
        $hospital_name=$row['hospital_name'];  
        $quantity=$row['quantity'];
        $application_time=$row['application_time'];
        $permission=$row['permission'];
        if($permission==0){
            $permission='accepted';
        }
        else if($permission==1){

            $permission='process';
        }
        else{
            $permission='Pending';
        }
                  
              
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
                                    <th>Application request Id:</th> 
                                    <td>$application_request_id</td>
                                    
                                </tr>
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
                                <th>Request Time:</th> 
                                <td>$application_time</td>
                                
                            </tr>
                                <tr>
                                <th>permission:</th> 
                                <td>$permission</td>
                                
                            </tr>


                            </table>
                            <div><br><br></div>
                            <a class='btn btn-success' href='request_process_user.php' >Know more</a>
        
                                    
                                  
                               
                                    
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
                
                    
                    
                    
                        <p style="color:red;"><b>Completed</b></p>  <!--completed-->
                </div>
                
            

        <div class='row'>
            <!--fetch product-->
            <?php


$select_display2="select * from application_request where login_username='$login_username' and permission=0" ;
    $sql3 = mysqli_query($conn,$select_display2);
    while($row=mysqli_fetch_assoc($sql3)){
       
         
         
        $application_request_id=$row['application_request_id'];
        $blood_id=$row['blood_id'];
        $blood_type=$row['blood_type'];
        $hospital_name=$row['hospital_name'];  
        $quantity=$row['quantity'];
        $application_time=$row['application_time'];
        $permission=$row['permission'];
        $acceptance=$row['acceptance'];

        if($permission==0){
            $permission='accepted';
        }
        else if($permission==1){

            $permission='process';
        }
        else{
            $permission='Pending';
        }
                  
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
                                <th>Application request Id:</th> 
                                <td>$application_request_id</td>
                                
                            </tr>
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
                            <th>Request Time:</th> 
                            <td>$application_time</td>
                            
                        </tr>
                            <tr>
                            <th>Acceptance:</th> 
                            <td>$acceptance</td>
                            
                        </tr>


                            </table>
                            <div><br><br></div>
                            <a class='btn btn-primary' href='' >$acceptance</a>";

                            
                          
        
                                    
                                  
                               
                                    echo "
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