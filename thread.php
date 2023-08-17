<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDiscuss-Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
    <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
    </script>
</head>
<body>
    <?php include 'partials/dbconnect.php';?>   
    <?php include 'partials/header.php';?>
    
    <?php
    $id=$_GET['threadid']; 
    $sql="SELECT * FROM `threads` where `thread_id`=$id";
    $result=mysqli_query($connect,$sql);
    while ($data = mysqli_fetch_assoc($result)) {
        $thread_Uid=$data['user_id'];
        $threadTitle=$data['thread_title'];
        $threadDesc=$data['thread_desc'];
        $sql2="SELECT `U_email` FROM `userdata` WHERE `U_id`='$thread_Uid'";
        $result2=mysqli_query($connect,$sql2);
        $data=mysqli_fetch_assoc($result2);
        $authorEmail=$data["U_email"];
    }
    ?>
    <div class="container my-4 ">
        <div class="jumbotron">
            <h1 class="display-4"> <?php  echo $threadTitle ?> </h1>
            <p class="lead"><?php echo $threadDesc  ?></p>
            <p>Posted by: <em><?php  echo $authorEmail; ?></em></p>
            <hr class="my-4">
            <h5><strong>Rules of Forum</strong></h5>
            <p>1. No Spam / Advertising / Self-promote in the forums<br></p>
            <p>2. Do not post copyright-infringing material<br></p>
            <p>3. Do not post “offensive” posts, links or images<br></p>
            <p>4. Remain respectful of other members at all times<br></p>
        </div>
    </div>
    <?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $comment=$_POST['c_desc'];
        $comment=str_replace("<","&lt","$comment");
        $comment=str_replace(">","&gt","$comment");
        $srno=$_POST['srno'];
        $sql="INSERT INTO `comments` (`comment_text`, `comment_threadid`, `comment_by`, `comment_time`) VALUES ('$comment','$id', '$srno', current_timestamp())";
        $result=mysqli_query($connect,$sql);
        $showAlert=true;
        if ($showAlert){
            echo "<script> alert('Your comments is been added😊, Proud to help someone')</script>";
        }
    }    
    ?>
    <?php
    if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true){
        echo  '<div class="container">
        <h3>Post Comment</h3>
        <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
            <div class="mb-3">
                <label for="textarea" class="form-label">Add a Comment</label>
                <textarea class="form-control" name="c_desc" id="c_desc" rows="3"></textarea>
                <input type="hidden" name="srno" value="'.$_SESSION['srno'].'">
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>';
    }else{
        echo '<div class="container">
        <h3>Post Comment</h3>
        <p class="lead">You have to Login to post a Comment</p>
        </div>';
    }
    ?>

    <div class="container mb-5">
        <h2 class="py-2"> Discussion</h2>
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Sr. No.</th>
                    <th scope="col">Description</th>
                    <th scope="col">User</th>
                    <th scope="col">Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $id=$_GET['threadid'];
                $sql="SELECT * FROM `comments` WHERE `comment_threadid`=$id ";
                $result=mysqli_query($connect,$sql);
                $noResult=true;
                $no=0;
                while($data=mysqli_fetch_assoc($result)){
                    $noResult=False;
                    $commentId=$data['comment_id'];
                    $commentDesc=$data['comment_text'];
                    $commentTime=new DateTime($data['comment_time']);
                    $threadUid=$data['comment_by'];
                    $sql2="SELECT `U_email` FROM `userdata` WHERE `U_id`='$threadUid'";
                    $result2=mysqli_query($connect,$sql2);
                    $data=mysqli_fetch_assoc($result2);
                    $no +=1;
                    echo '<tr>
                        <th scope="row">'.$no.'</th>
                        <td>'.$commentDesc.'</td>
                        <td>'.$data['U_email'].'</td>
                        <td>'.$commentTime->format('d/m/y H:i:s').'</td>
                    </tr>';
                }
                if($noResult){
                    echo '<div class="jumbotron jumbotron-fluid">
                            <div class="container">
                                <h1 class="display-4">There are no comments</h1>
                                <p class="lead"><b>Be the First person to write a Comments</b></p>
                            </div>
                        </div>';
                }
            ?>
            </tbody>
        </table>
    </div>
<!-- 
    <div class="container mb-5">
        <h2 class="py-2"> Discussion</h2>
        <?php
        $id=$_GET['threadid'];
        $sql="SELECT * FROM `comments` WHERE `comment_threadid`=$id ";
        $result=mysqli_query($connect,$sql);
        $noResult=true;
        while($data=mysqli_fetch_assoc($result)){
            $noResult=False;
            $commentId=$data['comment_id'];
            $commentDesc=$data['comment_text'];
            $commentTime=new DateTime($data['comment_time']);
            $threadUid=$data['comment_by'];
            $sql2="SELECT `U_email` FROM `userdata` WHERE `U_id`='$threadUid'";
            $result2=mysqli_query($connect,$sql2);
            $data=mysqli_fetch_assoc($result2);
            echo '<div class="media my-4">
                <i class="fa fa-user mr-4 my-4"></i>
                <div class="media-body my-3">
                <p class="font-weight-bold my-0">'.$data['U_email'].' at '.$commentTime->format('d/m/y H:i:s').'</p>
                '.$commentDesc.'
            </div>
        </div>';
        }
        if($noResult){
            echo '<div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h2 class="display-4">There are no comments</h2>
              <p class="lead"><b>Be the First person to write a Comments</b></p>
            </div>
          </div>';  
        }
        ?>
    </div> -->
    <?php include 'partials/footer.php';?>
</body>
</html>