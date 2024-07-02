<?php
$showError=false;
$showAlert=false;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include "../_dbconn2.php"
    $user_email = $POST['email'];
    $user_password = $POST['password'];
    // Echkng For Already Exitance
    $loginSql = "SELECT * FROM users WHERE user_email = $user_email";
    $result = musqli_query($conn,$loginSql);
    $count = mysqli_num_rows($result);
    if($count == 1){
       $row = mysqli_fetch_assoc($result);
       if(password_verify($user_password,$row['user_pass'])){
        session_start();
        $_SESSION['username']=$row['user_name'];
        $_SESSION['useremail']=$row['user_email'];
        $_SESSION['loggedIn']=true;
        header("location: ../index.php");
        exit();
       }else{
        header("location: ../index.php");
       }
    }else{
        
        }
    }
    
    header("location: ../index.php?signupsuccess=false&error=".$showError);

?>