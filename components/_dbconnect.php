<?php
$server="localhost";
$username="root";
$password= "";
$database="securestep";
$conn=mysqli_connect($server,$username,$password,$database);
if(!$conn){
//     echo "Successfully connected<br>";
// }
// else{
    die("Error!! ".mysqli_connect_error()."<br>");
}
?>