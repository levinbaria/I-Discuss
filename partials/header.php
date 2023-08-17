<?php
session_start();
echo '<nav class="navbar navbar-expand-lg bg-body-tertiary" >
<div class="container-fluid">
  <a class="navbar-brand" href="/idiscuss">iDiscuss-Forum</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarScroll">
    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Categories
        </a>
        <ul class="dropdown-menu">';

          $sql="SELECT `Category_name`,`Category_id` FROM `categories`LIMIT 3";
          $result=mysqli_query($connect,$sql);
          while($data=mysqli_fetch_assoc($result)){
          echo '<a class="dropdown-item" href="threadlist.php?catid='.$data['Category_id'].'">'.$data['Category_name'].'</a>';
          }
        echo   '</ul>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="contact.php">Contact</a>
          </li>
    </ul>
    <div class="row mx-2">';
    if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true){
      echo '<form class="d-flex"  action="search.php" method="get">
        <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        <p class="text-dark my-0 mx-2">Welcome '.$_SESSION['email'].'</p>
        <a href="partials/logout.php" class="btn btn-outline-success ml-2">Logout</a>
        <form>';
    }
    else{
       echo '<form class="d-flex" action="search.php" method="get">
        <input class="form-control me-2"name="search" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
        <div class="btn btn-success mx-2" data-bs-toggle="modal" data-bs-target="#loginModal" >Login</div>
        <div class="btn btn-success" data-bs-toggle="modal" data-bs-target="#signupModal">SignUp</div>
    </form>';
  }
    echo'</div>
  </div>
</div>
</nav>';
include "login.php";
include "signup.php";
if(isset($_GET['signupsuccess'])&& $_GET['signupsuccess']=="true"){
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success</strong> You can now login.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if(isset($_GET['signupsuccess']) &&$_GET['signupsuccess']=="false" &&  isset($_GET['error'])){
  $error=$_GET['error'];
  echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  <strong>Error!!!!!</strong> '.$error.'
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if(isset($_GET['loginsuccess'])&& $_GET['loginsuccess']=="true"){
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success</strong> You have Logged in to the i-Discuss.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if(isset($_GET['loginsuccess']) &&$_GET['loginsuccess']=="false" &&  isset($_GET['error'])){
  $error=$_GET['error'];
  echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  <strong>Error!!!!!</strong> '.$error.'
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
?>