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
 
 $admin_username1=$_SESSION['admin_username'];

 $select_display= "select * from admin_internshala where admin_username='$admin_username1'" ;
 $select_sql1 = mysqli_query($conn,$select_display);
 while($row1 = mysqli_fetch_array($select_sql1)){
 $admin_username=$row1[1];
 $hospital_name=$row1[2];
 
 }

 
 }
 

?>


	

<!DOCTYPE html>
<html lang="en">
<title>manage application request</title>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
<body> 

    
    
<br><br><br>
<div class="wrapper">
<?php include 'nav.php';?>
    <div class="container">
	

		   
        <div class="row">
                
                <!--card form-->
                
                    
                    
                    
                        <p style="color:red;"><b>Pending Requests</b></p>
                </div>
                
            

        <div class='row'>
            <!--fetch product-->
            <?php
$itemsPerPage = 3;

// Get the current page number from the query string
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset to fetch the relevant data for the current page
$offset = ($current_page - 1) * $itemsPerPage;






 // fetching the pending applications

$select_display="select * from application_request where permission=2 and hospital_name='$hospital_name' order by application_time LIMIT $offset, $itemsPerPage" ;
$sql1 = mysqli_query($conn,$select_display);
$num=mysqli_num_rows($sql1);
if($num>0){
while($row=mysqli_fetch_assoc($sql1)){
    
 
    $application_request_id=$row['application_request_id'];
    $blood_id=$row['blood_id'];
    $full_name =$row['full_name'];
    $login_username=$row['login_username'];
    $blood_type=$row['blood_type']; 
    $hospital_name=$row['hospital_name'];    
    $quantity =$row['quantity'];
    $application_time=$row['application_time'];
    $permission=$row['permission'];
    

    
     
     echo "
     <div class='col-lg-4'>
 
     
     <div class='card' style='width:100%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
     -webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );'>
         <div class='card-body' >
         <div class='d-flex flex-column align-items-center text-center'>
         <img src='https://bootdey.com/img/Content/avatar/avatar6.png' alt='Admin' class='rounded-circle p-1 bg-primary' width='110'>

         <div class='mt-3'>
         <table>
         <tr>
         <th>application Id:</th> 
         <td>$application_request_id</td>
         
     </tr>
     <tr>
         <th>full name:</th> 
         <td>$full_name</td>
         
     </tr>
     <tr>
         <th>login username:</th> 
         <td>$login_username</td>
     </tr>
     <tr>
     <th>blood Id:</th> 
     <td>$blood_id</td>
 </tr>
     <tr>
         <th>blood type:</th> 
         <td>$blood_type</td>
     </tr>
     <tr>
         <th>Hospital name:</th> 
         <td>$hospital_name</td>
     </tr>
     <tr>
         <th>Quantity:</th> 
         <td>$quantity</td>
     </tr>


     
     <tr>
         <th>application  time:</th> 
         <td>$application_time</td>
     </tr>
     

           </table>
           <div><br></div>
";
                   
                  
if($permission=='2'){
    echo" <a class='btn btn-secondary' href='pending.php?application_request_id=$application_request_id'>Pending</a>
 ";}
 else if($permission=='1'){
     echo" <a class='btn btn-success' href='ongoing.php?application_request_id=$application_request_id'>Ongoing</a>
  ";
 }
 else{
    echo" <a class='btn btn-primary' href=''>accepted</a>
     ";}

             echo"   
                 
              
                   
               </div>
             </div>
             
         </div>
     </div>
 </div>
 ";


}}

else{
        echo "<b><div> No pending cases today</b></div>";
        
          

}


$totalRowsQueryCompleted = "SELECT COUNT(*) as total FROM application_request WHERE permission=2 and hospital_name='$hospital_name'";
$totalRowsResultCompleted = mysqli_query($conn, $totalRowsQueryCompleted);
$totalRowsDataCompleted = mysqli_fetch_assoc($totalRowsResultCompleted);
$totalRowsCompleted = $totalRowsDataCompleted['total'];
$totalPages = ceil($totalRowsCompleted / $itemsPerPage);

if ($totalPages > 1) {

// Display pagination links

echo "<nav aria-label='...'>";
echo "<ul class='pagination'>";

// Previous Button
echo "<li class='page-item disabled'>";
echo "<a class='page-link' href='#' tabindex='-1'>Pages</a>";
echo "</li>";

// Pagination Links for Pending category
for ($i = 1; $i <= ceil($totalRowsCompleted  / $itemsPerPage); $i++) {
    echo "<li class='page-item'>";
    echo "<a class='page-link' href='?page=$i&category=pending'>$i</a>";
    echo "</li>";
}

// Next Button


echo "</ul>";
echo "</nav>";    
  }


    
        
            ?>
            </div>
            
            



        <!-- okie -->


<br>
        
			<div class="row">
                
               
                
                    
                    
                    
                        <p style="color:red;"><b> Ongoing </b></p>  <!--ongoing process-->
                </div>
                
            

        <div class='row'>
            <!--fetch product-->
            <?php



$itemsPerPage = 3;

// Get the current page number from the query string
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset to fetch the relevant data for the current page
$offset = ($current_page - 1) * $itemsPerPage;




$select_display="select * from application_request where permission=1 and hospital_name='$hospital_name'  order by application_time LIMIT $offset, $itemsPerPage" ;
$sql1 = mysqli_query($conn,$select_display);
$num=mysqli_num_rows($sql1);
if($num>0){
  while($row=mysqli_fetch_assoc($sql1)){
   
   
    $application_request_id=$row['application_request_id'];
    $blood_id=$row['blood_id'];
    $full_name =$row['full_name'];
    $login_username=$row['login_username'];
    $blood_type=$row['blood_type']; 
    $hospital_name=$row['hospital_name'];    
    $quantity =$row['quantity'];
    $application_time=$row['application_time'];
    $permission=$row['permission'];
    

   
    
       echo "
       <div class='col-lg-4'>
   
       <div class='card' style='width:100%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
                        -webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );'>
                            <div class='card-body' >
           <div class='d-flex flex-column align-items-center text-center'>
           <img src='https://bootdey.com/img/Content/avatar/avatar6.png' alt='Admin' class='rounded-circle p-1 bg-primary' width='110'>

           <div class='mt-3'>
           <table>
           <tr>
           <th>application Id:</th> 
           <td>$application_request_id</td>
           
       </tr>
       <tr>
           <th>full name:</th> 
           <td>$full_name</td>
           
       </tr>
       <tr>
           <th>login username:</th> 
           <td>$login_username</td>
       </tr>
       <tr>
       <th>blood Id:</th> 
       <td>$blood_id</td>
   </tr>
       <tr>
           <th>blood type:</th> 
           <td>$blood_type</td>
       </tr>
       <tr>
           <th>Hospital name:</th> 
           <td>$hospital_name</td>
       </tr>
       <tr>
           <th>Quantity:</th> 
           <td>$quantity</td>
       </tr>
  
  
      
       <tr>
           <th>application  time:</th> 
           <td>$application_time</td>
       </tr>
       
             </table>
             <div><br><br></div>
             ";
                                
                                       

             if($permission=='2'){
                echo" <a class='btn btn-secondary' href='pending.php?application_request_id=$application_request_id'>Pending</a>
             ";}
             else if($permission=='1' ){//approve the request
                 echo" <a class='btn btn-success' href='ongoing.php?application_request_id=$application_request_id'>Approved</a> 
              ";//decline the request
              echo" <a class='btn btn-danger' href='rejected.php?application_request_id=$application_request_id'>Reject</a>
              ";
             }
             else{
                echo" <a class='btn btn-primary' href=''>accepted</a>
                 ";}
 
                          echo"   
                              
                     
                   
                
                     
                 </div>
               </div>
               
           </div>
       </div>
   </div>
   ";


}
}
else{
    echo "<div><b> No ongoing cases today</b></div>";
    
      


  }

$totalRowsQueryCompleted = "SELECT COUNT(*) as total FROM application_request WHERE permission = 1 and hospital_name='$hospital_name'";
$totalRowsResultCompleted = mysqli_query($conn, $totalRowsQueryCompleted);
$totalRowsDataCompleted = mysqli_fetch_assoc($totalRowsResultCompleted);
$totalRowsCompleted = $totalRowsDataCompleted['total'];
$totalPages = ceil($totalRowsCompleted / $itemsPerPage);

if ($totalPages > 1) {

// Display pagination links

echo "<nav aria-label='...'>";
echo "<ul class='pagination'>";

// Previous Button
echo "<li class='page-item disabled'>";
echo "<a class='page-link' href='#' tabindex='-1'>Pages</a>";
echo "</li>";

// Pagination Links for Pending category
for ($i = 1; $i <= ceil($totalRowsCompleted  / $itemsPerPage); $i++) {
echo "<li class='page-item'>";
echo "<a class='page-link' href='?page=$i&category=pending'>$i</a>";
echo "</li>";
}

// Next Button


echo "</ul>";
echo "</nav>";    
}
  


        
            ?>
            </div>
            
            <div class="row">
                
                <!--card form-->
                
                    
                    
                    
                        <p style="color:red;"><b> Approved</b></p> <!--request approved-->
                </div>
                
            

        <div class='row'>
            <!--fetch product-->
            <?php



$itemsPerPage = 3;

// Get the current page number from the query string
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset to fetch the relevant data for the current page
$offset = ($current_page - 1) * $itemsPerPage;
$select_display="select * from application_request where permission=0 and hospital_name='$hospital_name'order by application_time LIMIT $offset, $itemsPerPage" ;
$sql1 = mysqli_query($conn,$select_display);
$num=mysqli_num_rows($sql1);
if($num>0){
   

  while($row=mysqli_fetch_assoc($sql1)){
   

    $application_request_id=$row['application_request_id'];
    $blood_id=$row['blood_id'];
    $full_name =$row['full_name'];
    $login_username=$row['login_username'];
    $blood_type=$row['blood_type']; 
    $hospital_name=$row['hospital_name'];    
    $quantity =$row['quantity'];
    $application_time=$row['application_time'];
    $permission=$row['permission'];
    $acceptance=$row['acceptance'];

    

       echo "
       <div class='col-lg-4'>
   
       <div class='card' style='width:100%; background: rgba( 255, 255, 255, 0.25 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 4px );
                        -webkit-backdrop-filter: blur( 40px );border-radius: 10px;border: 1px solid rgba( 255, 255, 255, 0.18 );'>
                            <div class='card-body' >
           <div class='d-flex flex-column align-items-center text-center'>
           <img src='https://bootdey.com/img/Content/avatar/avatar6.png' alt='Admin' class='rounded-circle p-1 bg-primary' width='110'>

                   <div class='mt-3'>
                   <table>
                   <tr>
           <th>application Id:</th> 
           <td>$application_request_id</td>
           
       </tr>
       <tr>
           <th>full name:</th> 
           <td>$full_name</td>
           
       </tr>
       <tr>
           <th>login username:</th> 
           <td>$login_username</td>
       </tr>
       <tr>
       <th>blood Id:</th> 
       <td>$blood_id</td>
   </tr>
       <tr>
           <th>blood type:</th> 
           <td>$blood_type</td>
       </tr>
       <tr>
           <th>Hospital name:</th> 
           <td>$hospital_name</td>
       </tr>
       <tr>
           <th>Quantity:</th> 
           <td>$quantity</td>
       </tr>
  
  
      
       <tr>
           <th>application  time:</th> 
           <td>$application_time</td>
       </tr>
               </table>
               <div><br><br></div>
               ";
                                  
               if($permission=='2'){
                echo" <a class='btn btn-secondary' href='pending.php?application_request_id=$application_request_id'>Pending</a>
             ";}
             else if($permission=='1'){
                 echo" <a class='btn btn-success' href='ongoing.php?application_request_id=$application_request_id'>Ongoing</a>
              ";
             }
             else{
                echo" <a class='btn btn-warning' href=''>$acceptance</a>
                 ";}
                        
                            echo"   
                                
                       
                       
                     
                  
                       
                   </div>
               </div>
               
           </div>
       </div>
   </div>
   ";


}
}
else{
    echo "<div><b> No completed cases today</b></div>";
    
      

}
  
$totalRowsQueryCompleted = "SELECT COUNT(*) as total FROM application_request WHERE permission = 0 and hospital_name='$hospital_name'";
$totalRowsResultCompleted = mysqli_query($conn, $totalRowsQueryCompleted);
$totalRowsDataCompleted = mysqli_fetch_assoc($totalRowsResultCompleted);
$totalRowsCompleted = $totalRowsDataCompleted['total'];
$totalPages = ceil($totalRowsCompleted / $itemsPerPage);

if ($totalPages > 1) {

// Display pagination links

echo "<nav aria-label='...'>";
echo "<ul class='pagination'>";

// Previous Button
echo "<li class='page-item disabled'>";
echo "<a class='page-link' href='#' tabindex='-1'>Pages</a>";
echo "</li>";

// Pagination Links for Pending category
for ($i = 1; $i <= ceil($totalRowsCompleted  / $itemsPerPage); $i++) {
echo "<li class='page-item'>";
echo "<a class='page-link' href='?page=$i&category=pending'>$i</a>";
echo "</li>";
}

// Next Button


echo "</ul>";
echo "</nav>";    
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
  font-size:15px;
  
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