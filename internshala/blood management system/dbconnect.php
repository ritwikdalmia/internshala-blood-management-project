<?php
$server = "localhost"; // add your server credentials
$username = "root"; // server username
$password = ""; // server database password else leave blank 
$database = "internshala_bms"; // datbase name
$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn){
//     echo "success";
// }
// else{
    die("Error". mysqli_connect_error());
}

?>
