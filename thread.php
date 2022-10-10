<!doctype html>
<html lang="en">

<head>
    <!--favicon
     <link rel="shortcut icon" type="image/png" href="images\favicon.ico">
    -->
    <link rel="apple-touch-icon" sizes="180x180" href="images\fav\/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images\fav\/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images\fav\/favicon-16x16.png">
    <link rel="manifest" href="images\fav\/site.webmanifest">


    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
    <title>my-forum</title>
</head>

<body>
    <!--header-->
    <?php include 'partials\_dbconnect.php';?>
    <?php include 'partials\_header.php';?>


    <?php 
    $id= $_GET['threadid'];
         $sql="SELECT * FROM threads WHERE thread_id=$id";
         $result=mysqli_query($conn, $sql);
         while($row= mysqli_fetch_assoc($result)){
            $title= $row['thread_title'];
            $desc= $row['thread_description'];
            $thread_user_id=$row['thread_user_id'];
            //fetching the data from users table to print thread Posted by- userName
            $sql3="SELECT user_names FROM `users` WHERE sno='$thread_user_id'";
                $result2=mysqli_query($conn, $sql3);
                $row2= mysqli_fetch_assoc($result2);
                $posted_by= $row2['user_names'];
        }
    ?>

    <?php
    $showAlert=false;
        //to detect request type in php 
        $method=$_SERVER['REQUEST_METHOD'];
        //echo $method;
        if($method=='POST'){
            //insert into commnet db
            $comment=$_POST['comment'];
            $comment=str_replace("<", "&lt;", $comment);
            $comment=str_replace(">", "&gt;", $comment);
            $sno=$_POST['sno'];
            $sql="INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) 
            VALUES ('$comment', '$id', '$sno', current_timestamp());";
            //adding the $result is neccesary or will not able to insert the data
            $result=mysqli_query($conn, $sql);
            $showAlert=true;

            if($showAlert){

             echo   '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>success</strong> Thread has been added successfully!!!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            }
        }
    ?>

    <div class="container my-3">
        <div class="jumbotron bg-light" style="padding: 20px">
            <h1 class="display-4"><?php echo $title; ?></h1>
            <p class="lead"><?php echo $desc; ?></p>
            <hr class="my-4">
            <h3>Forum Policy</h3>
            <p>1. Be polite and courteous<br>
                2. Do not spam in the forums.<br>
                3. Please ensure your thread is in the right forum.<br>
                4. Keep discussions in the one thread: do not spread a topic across multiple threads.<br>
            </p>
            <!--<p>Posted by:<b> Ak</b></p>-->
            <p>Posted by: <b><?php echo $posted_by; ?> </b></p>
        </div>
    </div>

    <!--addng this as to avoid access to everyone /ony logged in user can start Discussions-->
    <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true ){
            echo '<div class="container">
                <h1>Post a comment</h1>
                <form action="'.$_SERVER["REQUEST_URI"].'"  method="post">
                    <div class="mb-3">
                         <label for="exampleFormControlTextarea1" class="form-label">Type your comment</label>
                         <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                         <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
                     </div>
                    <button type="submit" class="btn btn-success">Post comment</button>
                </form>
            </div>';
        }else{
            echo '<div class="container">
                    <h1>Post a comment</h1>
                    <p class="lead">You are not logged in please Post a comment. </p> 
                </div>';
        }
    ?>


    <div class="container my-4">
        <h2>Discussions</h2>
        <?php 
        $id = $_GET['threadid'];
            $sql="SELECT * FROM `comments` WHERE thread_id=$id";
            $result=mysqli_query($conn, $sql);
            $noResult=true;
           // echo var_dump($result);
            while($row= mysqli_fetch_assoc($result))
            {
                $noResult=false;
                $id=$row['comment_id'];
                $content= $row['comment_content']; 
                $comment_time= $row['comment_time']; 
                //adding here this to pull usernames
                $thread_user_id= $row['comment_by'];
                $sql3="SELECT user_names FROM `users` WHERE sno='$thread_user_id'";
                $result2=mysqli_query($conn, $sql3);
                $row2= mysqli_fetch_assoc($result2);

                echo '

                    
                <div class="jumbotron bg-light">
                <div class="container">

                        <div class="d-flex">
                                
                            <!-- Image -->
                            <img
                                src="images\user default image.jpg"
                                alt="John Doe"
                                class="me-3 border rounded-circle"
                                style="width: 60px; height: 60px;"
                            />
                            <!-- Body -->
                            <div>
                                
                                <h6 class="fw-bold">
                                '.$row2['user_names'].'
                                <small class="text-muted">||'.$comment_time.'</small>
                                </h6>
                                <h6>
                                    '.$content.'
                                </h6>
                            </div>
                        </div>
                </div>   
                </div>
            ';
             }
    //echo var_dump($noResult);
    if($noResult){
        echo '<div class="jumbotron bg-light jumbotron-fluid">
            <div class="container">
          <h1 class="display-6">No Comments Found</h1>
          <p class="lead">Be the first person to ask a question.</p>
        </div>
      </div>';
    }
    ?>
    </div>

    <!--footer-->
    <?php include 'partials\_footer.php';?>
</body>

</html>