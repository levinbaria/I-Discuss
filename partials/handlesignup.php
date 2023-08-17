<?php
$showAlert=false;
if($_SERVER['REQUEST_METHOD']=='POST'){
    include "dbconnect.php";
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['u_email'];
    $password=$_POST['u_pass'];
    $cpassword=$_POST['uc_pass'];
    $existsEmail="SELECT * FROM `userdata` WHERE `U_email`='$email'";
    $existsResult=mysqli_query($connect,$existsEmail);
    $existsRow=mysqli_num_rows($existsResult);
    if($existsRow>0){
        $showError="EmailAlready Exist";
        header("location: /idiscuss/index.php?signupsuccess=false&error=$showError");
        exit();
    }
    else{
        if($password==$cpassword){
            $hash=password_hash($password,PASSWORD_DEFAULT);
            $sql="INSERT INTO `userdata` (`U_fname`, `U_lname`, `U_email`,`U_password`, `Time`) VALUES ('$fname', '$lname', '$email','$hash', current_timestamp())";
            $result=mysqli_query($connect,$sql);
            if($result){
                $showAlert=true;
                header("location: /idiscuss/index.php?signupsuccess=true");
                exit();
            }
        }else{
            $showError='Password does not match';
            header("location: /idiscuss/index.php?signupsuccess=false&error=$showError");
            exit();
        }
    }  
}