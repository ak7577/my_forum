 <?php
    $showError="false";
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        include '_dbconnect.php';
        $user_name=$_POST['userName'];
        $user_email=$_POST['signupEmail'];        
        $pass=$_POST['signupPassword'];
        $cpass=$_POST['signupcPassword'];
        

        //tocheck wheter the email exists 
        $existSql= "SELECT * FROM `users` WHERE user_email='$user_email'";
        $result= mysqli_query($conn, $existSql);
        $numRows=mysqli_num_rows($result);
        if($numRows>0){
            $showError= "Email already in use";
        }
    //confirm the pass and sign up
    else{
        if($pass==$cpass){
            $hash=password_hash($pass, PASSWORD_DEFAULT);
            $sql="INSERT INTO `users` ( `user_names`,`user_email`, `user_pass`) 
            VALUES ('$user_name','$user_email', '$hash')";
             $result= mysqli_query($conn, $sql);
             if($result){
                 $showAlert=true;
                  header("Location: /ak/index.php?signupsuccess=true");//redirecting to home page
                    exit();//control exit when its true next code wont run as its succes
                }
                
        }
        else{
           $showError="Password do not match";
           
        }
    }
    header("Location: /ak/index.php?signupsuccess=false&error=$showError");
}
 ?>
 