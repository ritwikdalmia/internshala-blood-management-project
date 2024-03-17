<?php
$server = "localhost"; //server 
$username = "root";//server username
$password = ""; //password if set by default ""
$database = "internshala_bms"; // server database
$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn){
//     echo "success";
// }
// else{
    die("Error". mysqli_connect_error());
}

?>
