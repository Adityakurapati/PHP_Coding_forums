<!doctype html>
<html lang="en">

<head>
          <!-- Bootstrap CSS -->
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
                    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"
                    crossorigin="anonymous">

          <link rel="stylesheet" href="../middlewares/bootstrap.min.css">
          <link rel="stylesheet" href="../middlewares/style.css">
          <title>Authentiation</title>
          <style>
          body {
                    height: 100vh;
          }

          .container {
                    background: #6c28db;
                    filter: drop-shadow(0 0 0.5rem #000);
                    border-radius: 1rem;
                    padding: 2rem;
                    width: 50vw;
          }
          </style>
</head>

<?php include '_dbconn.php' ?>
<?php
$showalert=false;
$showerror=false;
$showpasserror=false;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpass = $_POST['cpassword'];

    $exist=false;
    $sql = "SELECT * FROM `clients` WHERE `clients`.`client_name` = '$username';";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) > 0){
        $showerror = "Username Already Exists";
        $exist=true;
    }
    else{
        if(($password == $cpass) && $exist==false){
            $epassword = password_hash($password, PASSWORD_DEFAULT );// One Way Function , WE Get Hash From Password Not Vise

            $sql = "INSERT INTO `clients` (`id`, `client_name`, `client_email`, `client_password`, `dor`) VALUES (NULL, '$username', '$email', '$epassword', current_timestamp());";
            $result = mysqli_query($conn,$sql);
            if($result){
            //    $showalert = 'User Created ! Now You Can Login';
                header('Location: ./login.php');
            }else{
                // $showerror = "Unable To Create User";
            }
            }
    }
}else{
    $showpasserror =true;
}
?>

<body>
          <?php include './partials/_navbar.php' ?>
          <?php 
    if($showerror){
        echo '<div class="alert alert-dismissible alert-warning">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <h4 class="alert-heading">Warning!</h4>
        <p class="mb-0">'.$showerror.'</p>
      </div>';
    }
    if($showalert){
        echo '<div class="alert alert-dismissible alert-success">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <h4 class="alert-heading">Warning!</h4>
        <p class="mb-0">'.$showalert.'</p>
      </div>';
    }
    if($showpasserror){
        echo '<div class="alert alert-dismissible alert-danger">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <h4 class="alert-heading">Warning!</h4>
        <p class="mb-0">Wrong Confirm Password!</p>
      </div>';
    }
        ?>
          <div class=" container my-4">
                    <form method="POST" action="./sign_up.php">
                              <div class="form-group my-3">
                                        <label for="exampleInputEmail1">Username</label>
                                        <input type="text" name="username" class="form-control"
                                                  id="exampleInputUsername1" aria-describedby="emailHelp">
                              </div>
                              <div class="form-group my-2">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                                  aria-describedby="emailHelp">
                              </div>
                              <div class="form-group my-2">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" name="password" class="form-control"
                                                  id="exampleInputPassword1">
                              </div>
                              <div class="form-group my-2">
                                        <label for="exampleInputPassword1">Confirm Password</label>
                                        <input type="password" name="cpassword" class="form-control"
                                                  id="exampleInputCPassword1">
                              </div>
                              <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1" required>Confirmed</label>
                              </div>
                              <button type="submit" class="btn btn-primary">Sign Up</button>
                    </form>
          </div>
          <?php include './partials/_footer.php' ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
          integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
</script>

</html>