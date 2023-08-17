<?php
$servername="localhost";
$username="root";
$password="";
$dbname="idiscuss";
$connect=mysqli_connect($servername,$username,$password,$dbname);
if(!$connect){
    die("Connection Not Established".mysqli_connect_error());
}
?>