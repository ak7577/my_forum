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

    <style>
    /* OPTIONAL  
        a:visited, , a:focus,  a:hover
        */
    #maincontainer {
        min-height: 100vh;
    }

    .a {
        text-decoration: none !important;
    }
    </style>

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

    <!--search results starts -->
    <div class="container my-3" id="maincontainer">
        <h1>Search result for <em>"<?php echo $_GET['search']; ?>"</em> </h1>

        <?php 
            $noresult=true;
            $query= $_GET['search'];         
            $sql="SELECT * FROM `threads` WHERE MATCH(thread_title, thread_description) AGAINST ('$query')";
            $result=mysqli_query($conn, $sql);     
            while($row= mysqli_fetch_assoc($result))
            {
                $title= $row['thread_title'];
                $desc = $row['thread_description'];
                $thread_id=$row['thread_id'];
                $url="thread.php?threadid=".$thread_id;
                $noresult=false;

                echo '
                <div class="result">
                    <h3><a href="'.$url.'" class="text-dark text-decoration-none"> '.$title.'</a></h3>
                    <p> '.$desc.'</p>
                </div>';
            }
            if($noresult){
                echo '
                <div class="jumbotron bg-light jumbotron-fluid">
                    <div class="container">
                        <h1 class="display-6">No Results Found</h1>
                            <p class="lead">
                            Your search - Search result for <b><em>"'.$_GET["search"].'"</em></b> did not match any documents.</br> 
                            Suggestions:
                            <ul>
                                <li>Make sure that all words are spelled correctly. </li>
                                <li>Try different keywords. </li>
                                <li>Try more general keywords. </li> 
                            </ul>                           
                            </p>
                    </div>
                </div>';
            }
        ?>


    </div>
    <!--search results ends -->

    <!--footer-->
    <?php include 'partials\_footer.php';?>
</body>

</html>