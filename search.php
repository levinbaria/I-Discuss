<!Doctype html>
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

</head>

<body>
    <?php include 'partials/dbconnect.php';?>
    <?php include 'partials/header.php';?>
    <div class="container my-3">
        <h1 class="py-3"> Search Result for <em> "<?php  echo $_GET['search']?>"</em></h1>
        <?php
            $query=$_GET['search'];
            $sql="SELECT * FROM threads where match(`thread_title`,`thread_desc`) against('$query')";
            $result=mysqli_query($connect,$sql);
            $rows=mysqli_num_rows($result);
            if($rows>0){
                while ($data = mysqli_fetch_assoc($result)) {
                    $thread_id=$data['thread_id'];
                    $thread_title=$data['thread_title'];
                    $thread_desc=$data['thread_desc'];
                    $url="thread.php?threadid=".$thread_id;

                    echo '<div class="result">
                        <h2> <a href="'.$url.'" class="text-dark"> '.$thread_title.'</a></h2>
                        <p>'.$thread_desc.'</p>
                    </div>';
                }
            }else{
                    echo '<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                      <h2 class="display-4">No Result Found</h2>
                      <p class="lead"><b>Please Search for another Result</b></p>
                    </div>
                  </div>';  
                
            }
        ?>
        <?php include 'partials/footer.php';?>
</body>

</html>