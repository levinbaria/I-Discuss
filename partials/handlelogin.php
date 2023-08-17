<?php
$login=false;
if($_SERVER['REQUEST_METHOD']=='POST'){
    include 'dbconnect.php';
    $email=$_POST['email'];
    $password=$_POST['pass'];
    $sql="SELECT * FROM `userdata` WHERE `U_email`='$email'";
    $result=mysqli_query($connect,$sql);
    $row=mysqli_num_rows($result);
    if($row==1){
        while ($data = mysqli_fetch_assoc($result)) {
            if(password_verify($password,$data['U_password'])){
                $login=true;
                session_start();
                $_SESSION['loggedin']=true;
                $_SESSION['srno']=$data['U_id'];
                $_SESSION['email']=$email;
                header("location: /idiscuss/index.php?loginsuccess=true");
                exit();
            }else{
                $showError="Password Doesn not match";
                header("location: /idiscuss/index.php?loginsuccess=false&error=$showError");
                exit();
            }
        }
    }else{
        $showError="Invalid Email";
        header("location: /idiscuss/index.php?loginsuccess=false&error=$showError");
        exit();
    }
}
?>