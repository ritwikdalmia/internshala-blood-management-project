
	
<?php 
    include 'dbconnect.php';//datbase connect and query will excute on the basis of connection
    ?>
<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>

<body> 

    
    
<br><br><br>


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

    $select_display2="SELECT blood_type.blood_id,blood_type.blood_type,blood_type.hospital_name,blood_type.quantity,blood_type.timestamp  FROM blood_type
    WHERE blood_type.quantity>0";
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
                                    <img src='admin files/images/blood_group.png' alt='Admin' class='rounded-circle p-1 bg-primary' width='110'>
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
            </div>




      

        
			

        <!-- okie -->
   



    



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