<?php
session_start();

    echo ' 
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="/ak2">my-forum</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/ak2">Home</a>
            </li>
            
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categories
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';

            #fetching the top categories data from db 
              $sql= "SELECT categories_name, categories_id  FROM `categories` LIMIT 3";
              $result=mysqli_query($conn, $sql);
              while($row= mysqli_fetch_assoc($result)){
              
                  //display the categories 
                  echo '<a class="dropdown-item" href="threadlist.php?catid='.$row['categories_id'].'">'.$row['categories_name'].'</a>';

              #<a class="dropdown-item" href="#">Another action</a>          
              #<a class="dropdown-item" href="#">Something else here</a>
              }
            
              echo '</ul>

          </li>
          <li class="nav-item">
              <a class="nav-link" href="contact.php">Contact</a>
            </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">About</a>
          </li>
        </ul>
        <div class="mx-2">';
         if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true ){ //this is condition which will be true if we are logged in same goes forr signup too at last the condition code is written for the same 
            echo '<form class="d-flex" method="get" action="search.php">
                    <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-success" type="submit">Search</button><p class="text-light my-0 mx-2">Welcome ' .$_SESSION['useremail'].'</p>
                    <a href="partials\_logout.php"class="btn btn-outline-success ml-2">Logout</a>
                    </form>';
          }else{
                 echo '
                 
                      <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group me-2" role="group" aria-label="First group">

                        <button class="btn btn-outline-success ml-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>

                        </div>
                        <div class="btn-group me-2" role="group" aria-label="Second group">
                          
                        <button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#signupModal" >Signup</button>
                        </div>
                        
                      </div>


                  ';        
                }
        echo '</div>
      </div>
    </nav>';

    include 'partials\_loginmodal.php';
    include 'partials\_signupmodal.php';
  // to checkif its signd in and to print sign up is success
    if (isset($_GET['signupsuccess'])&& $_GET['signupsuccess']==true ){
      //echo "yes";
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>success</strong> signed up successfully!!!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    
?>