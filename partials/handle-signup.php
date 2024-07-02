<?php
$showError=false;
$showAlert=false;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include "../_dbconn2.php"
    $user_name = $POST['username'];
    $user_email = $POST['email'];
    $user_password = $POST['password'];
    $user_password_confirm = $POST['password-confirm'];

    // Echkng For Already Exitance
    $existSql = "SELECT * FROM users WHERE user_email = $user_email";
    $result = musqli_query($conn,$existSql);
    $count = mysqli_num_rows($result);
    if($count > 0){
        $showError = "User Name Already Is In Use!";
    }else{
        if($user_password == $user_password_confirm){
            $hash = password_hash($user_password,PASSSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_name`, `user_email`, `user_pass`, `timestamp`) VALUES ('$user_name', '$user_email', '$hash', current_timestamp());"
            $result = mysqli_query($conn,$sql);
            if($result){
                $showAlert = "User Added Successfully!";
                header("location: ../index.php?signupsuccess=true");
            }else{
                $showError = "Something Went Wrong!";
                header("location: ../index.php?signupsuccess=false&error=".$showError);
            }
        }
        else
        {
            $showError = "Password Not Matched!";
        }
        }
    }
    
    header("location: ../index.php?signupsuccess=false&error=".$showError);

?>