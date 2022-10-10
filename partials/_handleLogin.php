<?php
$showError="false";
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        include '_dbconnect.php';
        $email=$_POST['loginEmail'];
        $pass=$_POST['loginPass'];

        //tocheck login details
        $sql= "SELECT * FROM `users` WHERE user_email='$email'";
        $result= mysqli_query($conn, $sql);// here we got details of email from USERS table
        $numRows=mysqli_num_rows($result);
        if($numRows==1){
             $row=mysqli_fetch_assoc($result);
             if(password_verify($pass, $row['user_pass'])){
               
                session_start();
                $_SESSION['loggedin']=true;
                $_SESSION['sno']= $row['sno'];//taking the sno in session[php 64 /20;00]
                $_SESSION['useremail']=$email;
                echo "logged in". $email; 
                
                //header("Location: /ak/index.php");
                if($result){
                    $showAlert=true;
                     header("Location: /ak/index.php?loginsuccess=true");//redirecting to home page
                       exit();//control exit when its true next code wont run as its succes
                   }
            }
           // header("Location: /ak/index.php");// we are redirecting  to index.php if logged in or not no mater
            // testing if -else for else condition for wrong pass
            else{
                $showError="unable to log in";
                //header("Location: /ak/index.php?loginsuccess=true"); 
            //  echo "unable to log in";                 
            }
        }    
        header("Location: /ak/index.php?loginsuccess=false&error=$showError"); 
    }

?>