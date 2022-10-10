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

<!-- style="background-color:#747474;" -->

<body>
    <!--header-->
    <?php include 'partials\_dbconnect.php';?>
    <?php include 'partials\_header.php';?>

    <!--slider starts-->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <!-- <img src="https://source.unsplash.com/1200x300/?code,javascript" class="d-block w-100" alt="..."> -->
                <img src="images\news-story-banner-v3.png" width=1800 height=500 class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images\cover-image.jpeg" width=1800 height=500 class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images\what-is-coding (1).png" width=1800 height=500 class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!--slider ends-->


    <!--categories starts -->
    <hr>
    <h2 class=text-center>Categories</h2>
    <hr>
    <div class="container my-3">    
    
        <div class="row">
            <!--inside row use for loop for categories-->
            <!-- fetch  all the categories -->

            <?php
              $sql="SELECT * FROM categories";
              $result=mysqli_query($conn, $sql);
              while($row= mysqli_fetch_assoc($result)){
                //echo $row['categories_id'];
                  $id= $row['categories_id'];
                  $cat= $row['categories_name'];
                  $desc=$row['categories_description'];

                echo '
                <div class="col-md-4 my-2">
                    <div class="card" >
                        <img src="https://source.unsplash.com/200x150/?'.$cat.',code" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><a style=" text-decoration: none" href="threadlist.php?catid='.$id.'">'.$cat.'</a></h5>
                            <p class="card-text">'.substr($desc,0,50).'...</p>
                            <a href="threadlist.php?catid='.$id.'" class="btn btn-primary">View Threads</a>
                        </div>
                    </div>
                </div>';
         
              }
            ?>

            <!--inside row use for loop for categories-->
        </div>
    </div>
    
    <!--categories ends here -->

    <!--footer-->
    <?php include 'partials\_footer.php';?>
</body>

</html>